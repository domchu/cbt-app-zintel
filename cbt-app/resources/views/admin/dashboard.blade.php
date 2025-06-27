@extends('layouts.dashboard')

@section('content')
    <h1 class="mt-4"> Student Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Student Dashboard</li>
    </ol>
    
    <div class="container mt-4">
        <div class="row g-4 py-4">
            {{-- Student/Normal User Stats --}}
            @if (empty($userData))
                <div class="col-md-4">
                    {{-- <div class="card shadow-sm border-primary">
                        <div class="card-body text-center">
                            <h5 class="card-title">📚 Subjects</h5>
                            <p class="fs-4 fw-bold">{{ $userData['totalSubjects'] ?? 0 }}</p>
                        </div>
                    </div> --}}
                    <div class="card shadow-sm border-0 bg-primary text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">📚 Subjects</h5>
                            <p class="fs-3 fw-bold">{{ $userData['totalSubjects'] ?? 0 }}</p>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-info bg-info text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">❓ Questions</h5>
                            <p class="fs-4 fw-bold">{{ $userData['totalQuestions'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-warning bg-warning text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">✅ Answered</h5>
                            <p class="fs-4 fw-bold">{{ $userData['answeredQuestions'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-success bg-success text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">✔️ Correct</h5>
                            <p class="fs-4 fw-bold">{{ $userData['correctAnswers'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-danger bg-danger text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">❌ Failed</h5>
                            <p class="fs-4 fw-bold">{{ $userData['failedAnswers'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Admin Stats --}}
            @if (!empty($adminData))
                <div class="col-md-4">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body text-center">
                            <h5 class="card-title">👨‍🎓 Total Students</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['totalStudents'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-info">
                        <div class="card-body text-center">
                            <h5 class="card-title">👥 All Users (non-admin)</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['totalUsers'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-warning">
                        <div class="card-body text-center">
                            <h5 class="card-title">❓ Total Questions</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['totalQuestions'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-success">
                        <div class="card-body text-center">
                            <h5 class="card-title">✅ Correct Answers</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['correctAnswers'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-danger">
                        <div class="card-body text-center">
                            <h5 class="card-title">❌ Failed Answers</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['failedAnswers'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-secondary">
                        <div class="card-body text-center">
                            <h5 class="card-title">📝 Questions Answered</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['questionsAnswered'] }}</p>
                        </div>
                    </div>
                </div>
            @endif
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
