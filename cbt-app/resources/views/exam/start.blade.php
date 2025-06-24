@extends('layouts.dashboard')

@section('content')
    <div class="container mt-8">
        <h1 class="exam-title">Exam - {{ $subject }} - {{ $year }} ({{ $exam_type }})</h1>

        <div class="timer-container float-end">
            <div id="timer" class="text-danger text-2xl">Time Left: <span id="time" class="timer"></span></div>
            <!-- Question Navigation Panel -->
            <div class="question-navigation">
                @foreach ($questions as $index => $question)
                    <div class="question-box" id="question-box-{{ $question->id }}"
                        onclick="goToQuestion({{ $index }})">
                        {{ $index + 1 }}
                    </div>
                @endforeach
            </div>
        </div>

        <form id="examForm" method="POST" action="{{ route('exam.submit') }}" onsubmit="return confirmSubmission()">
            @csrf


            <!-- Hidden inputs to pass exam context -->
            <input type="hidden" name="subject" value="{{ $subject }}">
            <input type="hidden" name="year" value="{{ $year }}">
            <input type="hidden" name="exam_type" value="{{ $exam_type }}">
            <input type="hidden" name="subject_id" value="{{ $subject_id }}">
            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
            <input type="hidden" name="subject_id" value="{{ $subject_id }}">
            {{-- end --}}
            @php
                $questionsPerPage = 5;
                $totalPages = ceil(count($questions) / $questionsPerPage);
            @endphp

            @for ($page = 0; $page < $totalPages; $page++)
                <div class="question-page" id="question-page-{{ $page }}"
                    style="{{ $page > 0 ? 'display:none;' : '' }}">
                    @for ($i = $page * $questionsPerPage; $i < min(($page + 1) * $questionsPerPage, count($questions)); $i++)
                        @php $question = $questions[$i]; @endphp

                        <Article class="question-container" id="question-{{ $i }}">


                            <h4>Question {{ $i + 1 }}</h4>
                            <h5>{{ $question->question }}</h5>

                            <section class="cont">
                                <div>
                                    @foreach (['A', 'B', 'C', 'D', 'E'] as $option)
                                        @if (!empty($question['option_' . strtolower($option)]))
                                            <div>
                                                <label class="answer-option">
                                                    <input type="radio" name="answers[{{ $question->id }}]"
                                                        value="{{ $option }}"
                                                        onchange="markAnswered({{ $question->id }})">
                                                    {{ $option }}. {{ $question['option_' . strtolower($option)] }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="speaker-review">
                                    <!-- Speaker -->
                                    <button type="button" class="btn btn-sm btn-info read-aloud"
                                        data-question="{{ $question->question }}">
                                        🔊 Read Aloud
                                    </button>

                                    <!-- Review Later -->
                                    <label class="review-checkbox">
                                        <input type="checkbox" id="review-{{ $question->id }}"
                                            onclick="markReviewLater({{ $question->id }})">
                                        Review Later
                                    </label>
                                </div>
                            </section>
                        </Article>
                    @endfor

                    <div class="mt-3 text-center">
                        <button type="button" class="btn btn-secondary" onclick="prevQuestion()">Previous</button>
                        <button type="button" class="btn btn-primary" onclick="nextQuestion()">Next</button>
                        <button type="submit" class="btn btn-success submit-btn" style="display: none;">Submit
                            Exam</button>
                    </div>
                </div>
            @endfor
        </form>
    </div>

    <script>
        let timeLeft = 5400;
        let currentPage = 0;
        const totalPages = {{ $totalPages }};

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

        function showPage(index) {
            document.querySelectorAll('.question-page').forEach((page, i) => {
                page.style.display = i === index ? 'block' : 'none';
            });

            // Update buttons
            document.querySelectorAll('.submit-btn').forEach(btn => btn.style.display = 'none');
            if (index === totalPages - 1) {
                document.querySelector(`#question-page-${index} .submit-btn`).style.display = 'inline';
            }
        }

        function nextQuestion() {
            if (currentPage < totalPages - 1) {
                currentPage++;
                showPage(currentPage);
            }
        }

        function prevQuestion() {
            if (currentPage > 0) {
                currentPage--;
                showPage(currentPage);
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            showPage(currentPage);

            document.querySelectorAll('.read-aloud').forEach(button => {
                button.addEventListener('click', function() {
                    let text = this.getAttribute('data-question');
                    let speech = new SpeechSynthesisUtterance(text);
                    speech.lang = "en-US";
                    speech.rate = 1;
                    speech.volume = 1;
                    window.speechSynthesis.cancel();
                    window.speechSynthesis.speak(speech);
                });
            });
        });

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
            let pageIndex = Math.floor(index / {{ $questionsPerPage }});
            currentPage = pageIndex;
            showPage(pageIndex);
        }

        function confirmSubmission() {
            let reviewLaterQuestions = document.querySelectorAll('.question-box.review-later');
            if (reviewLaterQuestions.length > 0) {
                return confirm("You have questions marked for review. Are you sure you want to submit?");
            }
            return true;
        }
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
            border-radius: 50%;
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
            color: black;
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

        .timer,
        #timer {
            font-weight: 600;
            font-size: 25px;
            margin-bottom: 5px;
        }

        .exam-title {
            margin-bottom: 10px;
            text-align: center;
        }

        .cont {
            display: flex;
        }
        .speaker-review{
margin-left:50px;
        }
    </style>
@endsection
