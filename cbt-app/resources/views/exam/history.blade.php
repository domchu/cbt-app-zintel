<h1>Exam History</h1>

{{-- 
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">My Exam History</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Year</th>
                <th>Score</th>
                <th>Total Questions</th>
                <th>Date Completed</th>
            </tr>
        </thead>
        <tbody>
            @foreach($examHistories as $history)
            <tr>
                <td>{{ $history->subject->name }}</td>
                <td>{{ $history->year }}</td>
                <td>{{ $history->score }}</td>
                <td>{{ $history->total_questions }}</td>
                <td>{{ $history->completed_at->format('d M Y, h:i A') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}
