@extends('layouts.dashboard')

@section('content')
    <h1 class="mt-4">📊 Student Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Student Dashboard</li>
    </ol>

    {{-- Student/Normal User Stats --}}
    <div class="container mt-4">
        <div class="row g-4 py-4">
            {{-- @if (empty($userData)) --}}
                <div class="col-md-4">
                    <div class="card shadow-sm bg-primary text-white border-0">
                        <div class="card-body text-center">
                            <h5 class="card-title">📚 Subjects</h5>
                            <p class="fs-3 fw-bold">{{ $userData['totalSubjects'] ?? 0  }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm bg-info text-white border-0">
                        <div class="card-body text-center">
                            <h5 class="card-title">❓ Questions</h5>
                            <p class="fs-3 fw-bold">{{ $userData['totalQuestions'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm bg-warning text-white border-0">
                        <div class="card-body text-center">
                            <h5 class="card-title">✅ Answered</h5>
                            <p class="fs-3 fw-bold">{{ $userData['answeredQuestions'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm bg-success text-white border-0">
                        <div class="card-body text-center">
                            <h5 class="card-title">✔️ Correct</h5>
                            <p class="fs-3 fw-bold">{{ $userData['correctAnswers'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm bg-danger text-white border-0">
                        <div class="card-body text-center">
                            <h5 class="card-title">❌ Failed</h5>
                            <p class="fs-3 fw-bold">{{ $userData['failedAnswers'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            {{-- @else --}}
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        No exam data available for this student.
                    </div>
                </div>
            {{-- @endif --}}
        </div>
    </div>





    {{-- CHARTTING --}}
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Correct/Failed Chart
                </div>
                {{-- <canvas id="correctFailedChart" width="400" height="400"></canvas> --}}

                <div class="card-body"><canvas id="correctFailedChart" width="100%" height="300"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Students performance Chart
                </div>
                {{-- <canvas id="performanceChart" width="600" height="300"></canvas> --}}
                <div class="card-body"><canvas id="performanceChart" width="100%" height="300"></canvas></div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Candidate Name</th>
                        <th>Subject</th>
                        <th>Exam Type</th>
                        <th>Year</th>
                        <th>Score</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Candidate Name</th>
                        <th>Subject</th>
                        <th>Exam Type</th>
                        <th>Year</th>
                        <th>Score</th>
                        <th>Date</th>
                    </tr>
                </tfoot>
                <tbody>
                    {{-- @foreach ($results as $history)
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
                    @endforeach --}}


                    <td>Colleen Hurst</td>
                    <td>Javascript Developer</td>
                    <td>San Francisco</td>
                    <td>39</td>
                    <td>2009/09/15</td>
                    <td>$205,500</td>



                </tbody>
            </table>
        </div>
    </div>

    {{-- JAVASCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/    chart.min.js"></script> --}}

    <script>
        const correctFailedCtx = document.getElementById('correctFailedChart')?.getContext('2d');
        const performanceCtx = document.getElementById('performanceChart')?.getContext('2d');
        const performanceCtx = document.getElementById('performanceChart')?.getContext('2d');

        @php
            $isAdmin = Auth::user()->role == 1;

            $correct = $isAdmin ? $adminData['correctAnswers'] ?? 0 : (isset($userData['correctAnswers']) ? $userData['correctAnswers'] : 0);

            $failed = $isAdmin ? $adminData['failedAnswers'] ?? 0 : (isset($userData['failedAnswers']) ? $userData['failedAnswers'] : 0);
        @endphp

        if (correctFailedCtx) {
            new Chart(correctFailedCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Correct', 'Failed'],
                    datasets: [{
                        data: [{{ $correct }}, {{ $failed }}],
                        backgroundColor: ['#28a745', '#dc3545'],
                        borderWidth: 1
                    }]
                }
            });
        }

        if (performanceCtx) {
            new Chart(performanceCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($performanceDates ?? []) !!},
                    datasets: [{
                        label: 'Score (%)',
                        data: {!! json_encode($performanceScores ?? []) !!},
                        fill: false,
                        borderColor: '#007bff',
                        tension: 0.3
                    }]
                }
            });
        }
    </script>
@endsection
