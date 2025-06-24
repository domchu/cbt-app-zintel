
@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="text-center m-8">Select Subject, Year & Exam Type</h2>
    <form action="{{ route('exam.start') }}" method="POST">
        @csrf
    

        <label for="subject" class="">Subject:</label>
        <select name="subject" class="btn btn-secondary" required>
            @foreach($subjects as $subject)
                <option value="{{ $subject }}"  >{{ $subject }}</option>
            @endforeach
        </select>
    
        <label for="year">Year</label>
        <select name="year" class="btn btn-secondary" required>
            @foreach($years as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>
    
        <label for="exam_type">Exam Type</label>
        <select name="exam_type" class="btn btn-secondary mx-30 my-8" required>
            @foreach($examTypes as $type)
                <option value="{{ $type }}">{{ $type }}</option>
            @endforeach
        </select>
        <br>
    
        <button type="submit" class="btn btn-primary">Start Exam</button>
    </form>
    


</div>
@endsection