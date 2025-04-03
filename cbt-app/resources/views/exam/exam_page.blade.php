@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Exam for {{ $year }}</h2>
    
    <form action="{{ route('exam.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="year" value="{{ $year }}">

        @foreach($questions as $index => $question)
        <div class="card mb-3 p-3 question-block" id="question{{ $index }}">>
            <p><strong>Q{{ $index + 1 }}:</strong> {{ $question->question }}</p>   
            @foreach(['A', 'B', 'C', 'D', 'E'] as $option)
            <div>
                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}" required>
                 @if(isset($examHistory->user_answers[$question->id]) && $examHistory->user_answers[$question->id] === $option) checked @endif>
                <label>{{ $option }}. {{ $question->{'option_' . strtolower($option)} }}</label>
                
            </div>
            @endforeach
        </div>
        @endforeach

        <button type="submit" class="btn btn-success">Submit Exam</button>
        <button type="button" class="btn btn-info save-progress" data-question="{{ $question->id }}">Save Progress</button>
    </form>
</div>
@endsection

{{-- javascript --}}
<script>
    document.querySelectorAll('.save-progress').forEach(button => {
        button.addEventListener('click', function () {
            let questionId = this.getAttribute('data-question');
            let selectedAnswer = document.querySelector(`input[name="answers[${questionId}]"]:checked`);
            if (!selectedAnswer) return alert('Please select an answer before saving progress.');

            fetch('{{ route("exam.saveProgress") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    question_id: questionId,
                    selected_answer: selectedAnswer.value,
                    subject_id: '{{ $examHistory->subject_id }}',
                    year: '{{ $examHistory->year }}',
                    total_questions: '{{ count($questions) }}'
                })
            }).then(response => response.json()).then(data => {
                alert(data.message);
            }).catch(error => console.error('Error:', error));
        });
    });
