@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Exam - {{ $subject->name }}</h2>
        <div id="timer" class="text-center text-danger font-weight-bold">Time Left: <span id="time"></span></div>

        <form id="examForm" method="POST" action="{{ route('exam.submit') }}">
            @csrf
            <input type="hidden" name="exam_id" value="{{ $exam->id }}">

            @foreach ($questions as $index => $question)
                <div class="question-block" id="question{{ $index }}"
                    style="display: {{ $index == 0 ? 'block' : 'none' }};">
                    <p><strong>Q{{ $index + 1 }}:</strong> {{ $question->question }}</p> <span
                        class="question-text">{{ $question->question }}</span></p>
                    {{-- SPEECH --}}
                    <button type="button" class="btn btn-sm btn-info read-aloud" data-question="{{ $question->question }}">
                        🔊 Read Aloud
                    </button>
                    {{-- END SPEECH --}}
                    @foreach ($question->options as $option)
                        <div>
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->label }}"
                                required>
                            <label>{{ $option->label }}. {{ $option->option }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <div class="mt-3 text-center">
                <button type="button" id="prevBtn" class="btn btn-secondary" onclick="prevQuestion()">Previous</button>
                <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextQuestion()">Next</button>
                <button type="submit" id="submitBtn" class="btn btn-success" style="display: none;">Submit Exam</button>
            </div>
        </form>
    </div>

    <script>
        let timeLeft = 1800; // 30 minutes
        let currentQuestion = 0;
        const totalQuestions = {{ count($questions) }};

        function updateTimer() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            document.getElementById('time').textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            if (timeLeft === 0) document.getElementById('examForm').submit();
            timeLeft--;
        }
        setInterval(updateTimer, 1000);

        function nextQuestion() {
            document.getElementById(`question${currentQuestion}`).style.display = 'none';
            currentQuestion++;
            document.getElementById(`question${currentQuestion}`).style.display = 'block';
            document.getElementById('prevBtn').style.display = currentQuestion > 0 ? 'inline' : 'none';
            document.getElementById('nextBtn').style.display = currentQuestion < totalQuestions - 1 ? 'inline' : 'none';
            document.getElementById('submitBtn').style.display = currentQuestion === totalQuestions - 1 ? 'inline' : 'none';
        }

        function prevQuestion() {
            document.getElementById(`question${currentQuestion}`).style.display = 'none';
            currentQuestion--;
            document.getElementById(`question${currentQuestion}`).style.display = 'block';
            document.getElementById('prevBtn').style.display = currentQuestion > 0 ? 'inline' : 'none';
            document.getElementById('nextBtn').style.display = currentQuestion < totalQuestions - 1 ? 'inline' : 'none';
            document.getElementById('submitBtn').style.display = currentQuestion === totalQuestions - 1 ? 'inline' : 'none';
        }

        // Text-to-Speech Functionality
        document.querySelectorAll('.read-aloud').forEach(button => {
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
    </script>
@endsection
