@extends('layouts.admin-dashboard')

@section('content')
    <h1 class="mt-4">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin Dashboard</li>
    </ol>
    <div class="container mt-4">
        <div class="row g-4 py-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-primary">
                    <div class="card-body text-center">
                        <h5 class="card-title">📚 Subjects</h5>
                        <p class="fs-4 fw-bold">{{ $adminData['totalSubjects'] }}</p>
                    </div>
                </div>
            </div>

            @if (auth()->user()->is_admin)
                <div class="col-md-4">
                    <div class="card shadow-sm border-success">
                        <div class="card-body text-center">
                            <h5 class="card-title">👥 Students</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['totalUsers'] }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-4">
                <div class="card shadow-sm border-info">
                    <div class="card-body text-center">
                        <h5 class="card-title">❓ Questions</h5>
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
            Students DataTable
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
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
