@extends('layouts.dashboard')

@section('content')
    <h1 class="mt-4">📊 Student Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Student Dashboard</li>
    </ol>

    {{-- STUDENTS/USER STATISTICS --}}
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





    {{--STATISTICAL CHARTTING --}}
    <div class="row">
        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                   <i class="fas fa-chart-pie me-1"></i>
                    Student Correct/Failed Chart
                </div>

                <div style="width: 100%; max-width: 300px; margin: auto; margin-top: 30px; margin-bottom:30px">
                    <canvas id="subjectChart"></canvas>
                </div>
            </div>
        </div>
       
        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Students Performance History 
                </div>
                <div style="width: 100%; max-width: 300px; margin: auto; margin-top: 40px;">
                  <canvas id="barChart" ></canvas>
                </div>
                
            </div>
        </div>
         <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                   <i class="fas fa-chart-pie me-1"></i>
                   Average % Score Per Subject
                </div>
                <div style="width: 100%; max-width: 300px; margin: auto; ;margin-top: 40px;">
                   <canvas id="pieChart" ></canvas>
                </div>
                
            </div>
        </div>
    </div>

    {{--DATA TABLE FOR STUDENT HISTORY--}}
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
    const barCtx = document.getElementById('barChart').getContext('2d');
    const pieCtx = document.getElementById('pieChart').getContext('2d');

// FAIL/CORRECT STATISTICS
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

      
  

// Bar Chart (Subject vs Latest Score)
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($barSubjects) !!},
            datasets: [{
                label: 'Latest Score',
                data: {!! json_encode($barScores) !!},
                backgroundColor: '#007bff',
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    // Assuming max score known or optional
                }
            }
        }
    });

    // Pie Chart (Subject vs Average Percentage)
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($pieSubjects) !!},
            datasets: [{
                data: {!! json_encode($piePercentages) !!},
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF',
                    '#FF9F40'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
   
   
   
   </script>
@endsection
{{-- <td>{{ $latestResult->created_at->format('d M Y, h:i A') }}</td> --}}
