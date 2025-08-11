@extends('layouts.dashboard')

@section('content')
    <h1 class="mt-4">📊 Student Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Student Dashboard</li>
    </ol>

    {{-- Student/Normal User Stats --}}
    <div class="container mt-4">
        <div class="row g-4 py-4">
            @if (!empty($userData))
                <div class="col-md-4">
                    <div class="card shadow-sm bg-primary text-white border-0">
                        <div class="card-body text-center">
                            <h5 class="card-title">📚 Total Subjects</h5>
                            <p class="fs-3 fw-bold">{{ $userData['totalSubjects'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm bg-info text-white border-0">
                        <div class="card-body text-center">
                            <h5 class="card-title">❓Total Questions</h5>
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
            @else
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        No exam data available for this student.
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

                <div style="width: 100%; max-width: 400px; margin: auto; margin-top: 30px; margin-bottom:30px">
                    <canvas id="subjectChart"></canvas>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Students performance Chart
                </div>
                <div style="width: 100%; max-width: 400px; margin: auto; height: 400px;margin-top: 40px;">
                    <canvas id="performanceChart"></canvas>
                </div>
                
            </div>
        </div> --}}
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Students performance Chart
                </div>
                <div style="width: 100%; max-width: 400px; margin: auto; height: 400px;margin-top: 40px;">
                   <canvas id="subjectScoreChart" height="100"></canvas>
                </div>
                
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <span class="fw-bold">Student Exam History</span>
        </div>
        <div class="card-body">
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
                            {{-- <td>{{ $history->created_at->format('d M Y, h:i A') }}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- JAVASCRIPT --}}
    @php
        $isAdmin = Auth::user()->role == 2;

        $correct = $isAdmin ? $adminData['correctAnswers'] ?? 0 : $userData['correctAnswers'] ?? 0;
        $failed = $isAdmin ? $adminData['failedAnswers'] ?? 0 : $userData['failedAnswers'] ?? 0;
    @endphp
    //
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/    chart.min.js"></script>
    @php
        $isAdmin = Auth::user()->role == 1;

        $correct = $isAdmin
            ? $adminData['correctAnswers'] ?? 0
            : (isset($userData['correctAnswers'])
                ? $userData['correctAnswers']
                : 0);

        $failed = $isAdmin
            ? $adminData['failedAnswers'] ?? 0
            : (isset($userData['failedAnswers'])
                ? $userData['failedAnswers']
                : 0);
       
    @endphp
    <script>
        const correctFailedCtx = document.getElementById('subjectChart')?.getContext('2d');
        const ctxSubject = document.getElementById('subjectScoreChart')?.getContext('2d');

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

        // Bar chart for exam year vs percentage
      
        // chart
         if (ctxSubject) {
        new Chart(ctxSubject, {
            type: 'bar',
            data: {
                labels: {!! json_encode($subjects) !!}, // X-axis: Subjects
                datasets: [{
                    label: 'Score',
                    data: {!! json_encode($scores) !!}, // Y-axis: Scores
                    backgroundColor: '#28a745',
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: Math.max(...{!! json_encode($scores) !!}) + 5 // Slight padding above highest score
                    }
                }
            }
        });
    }
    </script>
@endsection
{{-- <td>{{ $latestResult->created_at->format('d M Y, h:i A') }}</td> --}}
