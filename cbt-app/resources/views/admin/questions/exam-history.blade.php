@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0 text-center">📋 All Students' Exam Results</h4>
        </div>

        <div class="card-body">

            <!-- Filter Form -->
            <form method="GET" class="row g-3 mb-3">
                <div class="col-md-4">
                    <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Search by name">
                </div>
                <div class="col-md-3">
                    <select name="subject" class="form-select">
                        <option value="">All Subjects</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject }}" {{ request('subject') == $subject ? 'selected' : '' }}>
                                {{ $subject }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="year" class="form-select">
                        <option value="">All Years</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">🔍 Filter</button>
                </div>
            </form>

            <!-- Print Button -->
            <div class="text-end mb-3">
                <button class="btn btn-secondary" onclick="window.print()">🖨️ Print</button>
            </div>

            <!-- Results Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Candidate Name</th>
                            <th>Subject</th>
                            <th>Year</th>
                            <th>Score</th>
                            <th>Total</th>
                            <th>%</th>
                            <th>Exam Type</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($results as $index => $result)
                            <tr>
                                <td>{{ $loop->iteration + ($results->currentPage() - 1) * $results->perPage() }}</td>
                                <td>{{ $result->name }}</td>
                                <td>{{ $result->subject }}</td>
                                <td>{{ $result->year }}</td>
                                <td class="text-success fw-bold">{{ $result->score }}</td>
                                <td>{{ $result->total }}</td>
                                <td>{{ $result->total > 0 ? round(($result->score / $result->total) * 100, 2) : 0 }}%</td>
                                <td>{{ $result->exam_type }}</td>
                                <td>{{ ucfirst($result->status) }}</td>
                                <td>{{ \Carbon\Carbon::parse($result->created_at)->format('d M Y, h:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">No exam records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $results->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
