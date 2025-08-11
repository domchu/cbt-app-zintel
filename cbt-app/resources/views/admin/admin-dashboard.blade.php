@extends('layouts.admin-dashboard')

@section('content')
    <h1 class="mt-4">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin Dashboard</li>
    </ol>
    {{-- DATA --}}
    <div class="container mt-4">
        <div class="row g-4 py-4">

            @if (!empty($userData))
                <div class="col-md-4">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body text-center">
                            <h5 class="card-title">📚 Total Subjects</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['totalSubjects'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-success">
                        <div class="card-body text-center">
                            <h5 class="card-title">👥Total Students</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['totalUsers'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-info">
                        <div class="card-body text-center">
                            <h5 class="card-title">❓Total Questions</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['totalQuestions'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-warning">
                        <div class="card-body text-center">
                            <h5 class="card-title">✅ Answered</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['answeredQuestions'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-success">
                        <div class="card-body text-center">
                            <h5 class="card-title">✔️ Correct</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['correctAnswers'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-danger">
                        <div class="card-body text-center">
                            <h5 class="card-title">❌ Failed</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['failedAnswers'] }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        No Exam Data Available for this student.
                    </div>
                </div>
            @endif
        </div>

    </div>

    {{-- CHARTING --}}
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Correct/Failed Chart
                </div>
                <div class="card-body"><canvas id="correctFailedChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Students performance Chart
                </div>
                <div class="card-body"><canvas id="performanceChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>
    {{-- TABLE --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <h4 class="mb-3">📊 All Students' Exam History</h4>
        </div>
        <div class="card-body">
            @if ($results->isEmpty())
                <div class="alert alert-info">No exam results found.</div>
            @else
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Candidate Name</th>
                        <th>Subjects</th>
                        <th>Exam Type</th>
                        <th>Years</th>
                        <th>Score</th>
                        <th>Percentage</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                              <th>Candidate Name</th>
                        <th>Subjects</th>
                        <th>Exam Type</th>
                        <th>Years</th>
                        <th>Score</th>
                        <th>Percentage</th>
                        </tr>
                    </tfoot>
                    <tbody>
                         @foreach ($results as $history)
                        <tr>
                            <td>{{ $history->name }}</td>
                            <td>{{ $history->subject }}</td>
                            <td>{{ $history->exam_type }}</td>
                            <td> {{ $history->year }}</td>
                            <td>{{ $history->score }} / {{ $history->total }}</td>
                            <td>
                                {{ $history->total > 0 ? round(($history->score / $history->total) * 100, 2) : 0 }}%
                            </td>
                            <td>{{ $history->created_at->format('d M Y, h:i A') }}</td> 
                        </tr>
                    @endforeach
                        <tr>
                            <td>Colleen Hurst</td>
                            <td>Javascript Developer</td>
                            <td>San Francisco</td>
                            <td>39</td>
                            <td>2009/09/15</td>
                            <td>$205,500</td>
                        </tr>
                    </tbody>
                </table>
        </div>
    </div>



    {{-- JAVASCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const correctFailedCtx = document.getElementById('correctFailedChart').getContext('2d');
        new Chart(correctFailedCtx, {
            type: 'doughnut',
            data: {
                labels: ['Correct', 'Failed'],
                datasets: [{
                    data: [{{ $correctAnswers }}, {{ $failedAnswers }}],
                    backgroundColor: ['#28a745', '#dc3545'],
                    borderWidth: 1
                }]
            }
        });

        const performanceCtx = document.getElementById('performanceChart').getContext('2d');
        new Chart(performanceCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($performanceDates) !!}, // e.g., ['May', 'June', 'July']
                datasets: [{
                    label: 'Score (%)',
                    data: {!! json_encode($performanceScores) !!}, // e.g., [50, 80, 60]
                    fill: false,
                    borderColor: '#007bff',
                    tension: 0.1
                }]
            }
        });
    </script>
@endsection


{{-- <center><span><?php echo date("Y");?> &copy;Copyright Zintel Academy | All Right Reserved</span></center>  --}}