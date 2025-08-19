@extends('layouts.admin-dashboard')

@section('content')
    <h1 class="mt-4">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin Dashboard</li>
    </ol>
    {{-- DATA --}}
    <div class="container mt-4">
        <div class="row g-4 py-4">

            @if (!empty($adminData))
                <div class="col-md-4">
                    <div class="card shadow-sm border-success">
                        <div class="card-body text-center">
                            <h5 class="card-title">👥Total Students</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['totalUsers'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body text-center">
                            <h5 class="card-title">📚 Total Subjects</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['totalSubjects'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-info">
                        <div class="card-body text-center">
                            <h5 class="card-title">❓Total Questions</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['totalQuestions'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-warning">
                        <div class="card-body text-center">
                            <h5 class="card-title">✅ Answered</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['answeredQuestions'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-success">
                        <div class="card-body text-center">
                            <h5 class="card-title">✔️ Correct</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['correctAnswers'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-danger">
                        <div class="card-body text-center">
                            <h5 class="card-title">❌ Failed</h5>
                            <p class="fs-4 fw-bold">{{ $adminData['failedAnswers'] ?? 0 }}</p>
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
        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Student Correct/Failed Chart
                </div>

                <div style="width: 100%; max-width: 300px; margin: auto; margin-top: 30px; margin-bottom:30px">
                    <canvas id="examChart"></canvas>
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
                    <canvas id="barChart"></canvas>
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
                    <canvas id="pieChart"></canvas>
                </div>

            </div>
        </div>
    </div>
    {{-- DATA TABLE --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <h4 class="mb-3">📊 All Students Exam History</h4>
        </div>
        <div class="card-body">
            @if ($examHistory->isEmpty())
                <div class="alert alert-info">No exam results found.</div>
            @else
                <table id="datatablesSimple" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Candidate Name</th>
                            <th>Subjects</th>
                            <th>Exam Type</th>
                            <th>Years</th>
                            <th>Total Score</th>
                            <th>Total Questions</th>
                            <th>Percentage</th>
                            <th>Date Completed</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Candidate Name</th>
                            <th>Subjects</th>
                            <th>Exam Type</th>
                            <th>Years</th>
                            <th>Total Score</th>
                            <th>Total Questions</th>
                            <th>Percentage</th>
                            <th>Date Completed</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($examHistory as $exam)
                            <tr>
                                <td>{{ $exam->name }}</td>
                                <td>{{ $exam->subject }}</td>
                                <td>{{ $exam->exam_type }}</td>
                                <td> {{ $exam->year }}</td>
                                 <td class="text-success font-bold">{{ $exam->score }}</td>
                                  <td>{{ $exam->total }}</td>
                                <td>
                                    {{ $exam->total > 0 ? round(($exam->score / $exam->total) * 100, 2) : 0 }}%
                                </td>
                                <td>{{ $exam->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                       
                    </tbody>
                </table>
                @endif
        </div>
    </div>



   
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/    chart.min.js"></script>
   
    <script>
        const correctFailedCtx = document.getElementById('examChart')?.getContext('2d');
        // const barCtx = document.getElementById('barChart').getContext('2d');
        // const pieCtx = document.getElementById('pieChart').getContext('2d');

        // FAIL/CORRECT STATISTICS
        const ctx = document.getElementById('examChart').getContext('2d');
    const examChart = new Chart(ctx, {
        type: 'pie', // change to 'bar' or 'doughnut' if you like
        data: {
            labels: @json($chartData['labels']),
            datasets: [{
                label: 'Exam Stats',
                data: @json($chartData['data']),
                backgroundColor: ['#4CAF50', '#F44336'], // green = correct, red = failed
            }]
        }
    });


       
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
@endsection
