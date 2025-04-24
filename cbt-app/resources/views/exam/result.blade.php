<h1>Results</h1>
  <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>

{{-- @extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Exam Results</h2>
    <p><strong>Score:</strong> {{ $score }}/{{ $totalQuestions }}</p>
    <p><strong>Percentage:</strong> {{ round(($score / $totalQuestions) * 100, 2) }}%</p>
    
    <h3>Review Answers</h3>
    @foreach($userAnswers as $answer)
    <div class="card mb-3 p-3">
        <p><strong>Q:</strong> {{ $answer->question->question }}</p>
        <p><strong>Your Answer:</strong> {{ $answer->user_answer }} 
            @if($answer->is_correct)
            ✅
            @else
            ❌ (Correct: {{ $answer->question->correct_answer }})
            @endif
        </p>
    </div>
    @endforeach --}}

{{-- USER SUBMITTED BEFORE COMPLETED --}}
 {{-- <h2>Exam Results</h2>
    <p>Your Score: {{ $examAttempt->score }} / {{ count(json_decode($examAttempt->answers, true)) }}</p>
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
</div>
@endsection --}}
