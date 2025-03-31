@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Select Year & Subject</h2>

    <form action="{{ route('exam.start') }}" method="GET">
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

        <button type="submit" class="btn btn-primary">Start Exam</button>
    </form>
</div>
@endsection
