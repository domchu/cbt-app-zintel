@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">📄 My Exam History</h4>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($results->isEmpty())
                <div class="alert alert-info text-center">No exam results available.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>👤 Candidate Name</th>
                                <th>📘 Subject</th>
                                <th>📅 Year</th>
                                <th>✅ Score</th>
                                <th>❓ Total Questions</th>
                                <th>📊 Percentage</th>
                                <th>🕒 Date Completed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $history)
                                <tr>
                                    <td>{{ $history->name }}</td>
                                    <td>{{ $history->subject }}</td>
                                    <td>{{ $history->year }}</td>
                                    <td class="text-success fw-bold">{{ $history->score }}</td>
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
            @endif
        </div>
    </div>
</div>


@endsection
