@php
    $questionsPerPage = 5;
    $totalPages = ceil(count($questions) / $questionsPerPage);
@endphp

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-8">
        {{-- <h2 class="text-center">Exam - {{ $subject }}</h2> --}}
        <h1>Exam - {{ $subject }} - {{ $year }} ({{ $exam_type }})</h1>
        <div class="timer-container float-end">
            <div id="timer" class="text-danger text-2xl">Time Left: <span id="time"></span></div>


            <!-- Question Navigation Panel -->
            <div class="question-navigation">
                @foreach ($questions as $index => $question)
                    <div class="question-box" id="question-box-{{ $question->id }}"
                        onclick="goToQuestion({{ $index }})">
                        {{ $index + 1 }}
                    </div>
                @endforeach
            </div>
            <!--End Navigation Panel -->
        </div>

        <form id="examForm" method="POST" action="{{ route('exam.submit') }}" onsubmit="return confirmSubmission()">
            @csrf
            {{-- <input type="hidden" name="exam_id" value="{{ $exam->id }}"> --}}

            <!-- Display Questions -->
            @if (!empty($questions) && count($questions))
                @foreach ($questions as $index => $question)
                    <div class="question-container" id="question-{{ $index }}"
                        style="{{ $index > 0 ? 'display:none;' : '' }}">
                        <h4>Question {{ $index + 1 }}</h4>
                        <p>{{ $question->question }}</p>

                        @php
                            $options = ['A', 'B', 'C', 'D', 'E'];
                        @endphp

                        @foreach ($options as $option)
                            @php
                                $optionText = $question->{'option_' . strtolower($option)};
                            @endphp

                            @if ($optionText)
                                <div>
                                    <label class="answer-option">
                                        <input type="radio" name="answers[{{ $question->id }}]"
                                            value="{{ $option }}" onchange="markAnswered({{ $question->id }})">
                                        {{ $option }}. {{ $optionText }}
                                    </label>
                                </div>
                            @endif
                        @endforeach


                        {{-- SPEAKER --}}
                        <button type="button" class="btn btn-sm btn-info read-aloud"
                            data-question="{{ $question->question }}">
                            🔊 Read Aloud
                        </button>
                        <!-- Review Later Checkbox -->
                        <label class="review-checkbox">
                            <input type="checkbox" id="review-{{ $question->id }}"
                                onclick="markReviewLater({{ $question->id }})">
                            Review Later
                        </label>
                    </div>
                @endforeach
            @else
                <p>No questions available for this exam.</p>
            @endif


            <div class="mt-3 text-center">
                <button type="button" id="prevBtn" class="btn btn-secondary" onclick="prevQuestion()">Previous</button>
                <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextQuestion()">Next</button>
                <button type="submit" id="submitBtn" class="btn btn-success" style="display: none;">Submit Exam</button>
            </div>
        </form>
    </div>



    <script>
        let timeLeft = 5400; //1:30 minutes
        let currentQuestion = 0;
        const totalQuestions = {{ count($questions) }};

        function updateTimer() {
            let hours = Math.floor(timeLeft / 3600);
            let minutes = Math.floor((timeLeft % 3600) / 60);
            let seconds = timeLeft % 60;
            document.getElementById('time').textContent =
                `${hours}:${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            if (timeLeft === 0) document.getElementById('examForm').submit();
            timeLeft--;
        }
        setInterval(updateTimer, 1000);

        function nextQuestion() {
            document.getElementById(`question-${currentQuestion}`).style.display = 'none';
            currentQuestion++;
            document.getElementById(`question-${currentQuestion}`).style.display = 'block';
            document.getElementById('prevBtn').style.display = currentQuestion > 0 ? 'inline' : 'none';
            document.getElementById('nextBtn').style.display = currentQuestion < totalQuestions - 1 ? 'inline' : 'none';
            document.getElementById('submitBtn').style.display = currentQuestion === totalQuestions - 1 ? 'inline' : 'none';
        }

        function prevQuestion() {
            document.getElementById(`question-${currentQuestion}`).style.display = 'none';
            currentQuestion--;
            document.getElementById(`question-${currentQuestion}`).style.display = 'block';
            document.getElementById('prevBtn').style.display = currentQuestion > 0 ? 'inline' : 'none';
            document.getElementById('nextBtn').style.display = currentQuestion < totalQuestions - 1 ? 'inline' : 'none';
            document.getElementById('submitBtn').style.display = currentQuestion === totalQuestions - 1 ? 'inline' : 'none';
        }



        document.querySelectorAll('.read-aloud').forEach(button => { // Text-to-Speech Functionality
            button.addEventListener('click', function() {
                let text = this.getAttribute('data-question');
                let speech = new SpeechSynthesisUtterance(text);
                speech.lang = "en-US";
                speech.rate = 1; // Adjust speed if necessary
                speech.volume = 1;
                window.speechSynthesis.cancel();
                window.speechSynthesis.speak(speech);
            });
        });



        // REVIEW LATER
        function markAnswered(questionId) {
            let box = document.getElementById("question-box-" + questionId);
            box.classList.remove("review-later");
            box.classList.add("answered");
        }

        function markReviewLater(questionId) {
            let box = document.getElementById("question-box-" + questionId);
            let checkbox = document.getElementById("review-" + questionId);

            if (checkbox.checked) {
                box.classList.add("review-later");
            } else {
                box.classList.remove("review-later");
            }
        }

        function goToQuestion(index) {
            let allQuestions = document.querySelectorAll('.question-container');
            allQuestions.forEach(q => q.style.display = 'none');

            document.getElementById("question-" + index).style.display = 'block';
        }

        function confirmSubmission() {
            let reviewLaterQuestions = document.querySelectorAll('.question-box.review-later');
            if (reviewLaterQuestions.length > 0) {
                return confirm("You have questions marked for review. Are you sure you want to submit?");
            }
            return true;
        }

        document.getElementById('prevBtn').style.display = currentQuestion === 0 ? 'none' : 'inline';
        document.getElementById('nextBtn').style.display = totalQuestions > 1 ? 'inline' : 'none';
        document.getElementById('submitBtn').style.display = totalQuestions === 1 ? 'inline' : 'none';
    </script>

    <style>
        .question-navigation {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .question-box {
            width: 40px;
            height: 40px;
            border-radius:5px;
            margin: 5px;
            text-align: center;
            line-height: 40px;
            border: 2px solid #ccc;
            cursor: pointer;
            font-weight: bold;
        }

        .question-box.answered {
            background-color: green;
            color: white;
        }

        .question-box.review-later {
            background-color: yellow;
        }

        .question-container {
            margin-bottom: 20px;
        }

        .answer-option {
            display: block;
            margin: 5px 0;
        }

        .review-checkbox {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
@endsection
