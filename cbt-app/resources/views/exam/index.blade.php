
@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="text-center">Select Year & Subject</h2>
    <form action="{{ route('exam.start') }}" method="POST">
        @csrf
    
        <label for="subject">Subject</label>
        <select name="subject" required>
            @foreach($subjects as $subject)
                <option value="{{ $subject }}">{{ $subject }}</option>
            @endforeach
        </select>
    
        <label for="year">Year</label>
        <select name="year" required>
            @foreach($years as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>
    
        <label for="exam_type">Exam Type</label>
        <select name="exam_type" required>
            @foreach($examTypes as $type)
                <option value="{{ $type }}">{{ $type }}</option>
            @endforeach
        </select>
    
        <button type="submit">Start Exam</button>
    </form>
    


</div>
@endsection