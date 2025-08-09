 @extends('layouts.app')

@section('content')
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
                            <td>{{ $history->created_at->format('d M Y, h:i A') }}</td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection 
