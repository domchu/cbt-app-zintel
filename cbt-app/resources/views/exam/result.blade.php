@extends('layouts.app')

@section('content')
<div id="resultCard" class="text-center p-4 rounded shadow-sm bg-white text-dark dark-mode-container border">
    <h2 class="mb-4 fw-bold fs-4">🎓 Exam Result Summary</h2>

    <div class="mx-auto text-start" style="max-width: 600px;">
        <p><strong>👤 Candidate:</strong> {{ $latestResult->name }}</p>
        <p><strong>📘 Subject:</strong> {{ $latestResult->subject }}</p>
        <p><strong>📅 Year:</strong> {{ $latestResult->year }}</p>
        <p><strong>📝 Exam Type:</strong> {{ $latestResult->exam_type }}</p>
        <hr class="my-4 border-secondary" id="resultDivider">
        <p><strong>✅ Score:</strong> {{ $latestResult->score }} / {{ $latestResult->total }}</p>
        <p><strong>📊 Percentage:</strong> 
            {{ $latestResult->total > 0 ? round(($latestResult->score / $latestResult->total) * 100, 2) : 0 }}%
        </p>
    </div>

    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary mt-4">🔙 Back to Dashboard</a>
</div>
@endsection
