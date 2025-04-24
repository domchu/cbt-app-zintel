<h1>WRONG Exam PAGE</h1>
<a href="{{ url('exam/result') }}" class="btn btn-primary">Submit Exam</a>




{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Exam - {{ $exam->title }} ({{ $year }})</h2>
    
    <!-- Question Navigation Panel -->
    <div class="question-navigation">
        @foreach ($questions as $index => $question)
            <div class="question-box" id="question-box-{{ $question->id }}" onclick="goToQuestion({{ $index }})">
                {{ $index + 1 }}
            </div>
        @endforeach
    </div>

        <form id="examForm" action="{{ route('exam.submit') }}" method="POST" onsubmit="return confirmSubmission()">
        @csrf

        <!-- Display Questions -->
        @foreach ($questions as $index => $question)
        <div class="question-container" id="question-{{ $index }}" style="{{ $index > 0 ? 'display:none;' : '' }}">
            <h4>Question {{ $index + 1 }}</h4>
            <p>{{ $question->question }}</p>

            @php
                $options = ['A', 'B', 'C', 'D', 'E'];
            @endphp

            @foreach ($options as $option)
                <label class="answer-option">
                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}" 
                        onchange="markAnswered({{ $question->id }})">
                    {{ $option }}. {{ $question["option_".strtolower($option)] }}
                </label>
            @endforeach

               <!-- Review Later Checkbox -->
             <label class="review-checkbox">
                <input type="checkbox" id="review-{{ $question->id }}" onclick="markReviewLater({{ $question->id }})">
                Review Later
            </label>
        </div>
        @endforeach

        <button type="submit" class="btn btn-success">Submit Exam</button>
    </form>
</div>

<script>
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

@endsection --}}
