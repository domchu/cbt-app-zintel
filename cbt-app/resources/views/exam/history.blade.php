@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">My Exam History</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Candidate Name</th>
                    <th>Subject</th>
                    <th>Year</th>
                    <th>Score</th>
                    <th>Total Questions</th>
                    <th>Percentage</th>
                    <th>Date Completed</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $history)
                    <tr>
                        <td>{{ $history->name }}</td>
                        <td>{{ $history->subject }}</td>
                        <td>{{ $history->year }}</td>
                        <td>{{ $history->score }}</td>
                        <td>{{ $history->total }}</td>
                        <td>
                            {{ $history->total > 0 ? round(($history->score / $history->total) * 100, 2) : 0 }}%
                        </td>
                        <td>{{ $history->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
