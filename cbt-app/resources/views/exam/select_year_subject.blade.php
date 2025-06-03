{{-- <h1>take exam page</h1>
 <a href="{{ url('exam/questions') }}" class="btn btn-primary">Start Exam</a> --}}


@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Select Year & Subject</h2>

    <form action="{{ route('exam.questions') }}" method="GET">
        @csrf
        <div class="form-group">
            <label for="subject">Select Subject:</label>
            <select name="subject" id="subject" class="form-control" required>
                <option value="">-- Choose Subject --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="year">Select Year:</label>
            <select name="year" id="year" class="form-control" required>
                <option value="">-- Choose Year --</option>
                @for ($i = now()->year; $i >= now()->year - 5; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="exam_type">Select Exam Type:</label>
            <select name="exam_type" id="exam_type" class="form-control" required>
                <option value="">-- Choose Exam Type --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Start Exam</button>
    </form>
</div>
@endsection
