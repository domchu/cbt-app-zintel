@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>View Uploaded Questions</h2>

                <div class="card">
                    <div class="card-header">
                        <h4> View Uploaded Questions <a class="btn btn-danger float-end"
                            href="{{ route('questions.upload') }}">Upload Bulk Questions</a>
                    </h4>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name='questions' value="{{ json_encode($questions) }}">
                        <table class="table table-stripe table:hover">
                            <thead>
                                <tr>
                                    <th>Subject Id</th>
                                    <th>Subject</th>
                                    <th>Year</th>
                                    <th>Exam Type</th>
                                    <th>Question</th>
                                    <th>Option A</th>
                                    <th>Option B</th>
                                    <th>Option C</th>
                                    <th>Option D</th>
                                    <th>Option E</th>
                                    <th>Correct Answer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $index => $question)
                                    <tr>
                                        <td>{{$question['subject_id']}} </td>
                                        <td>{{$question['subject']}} </td>
                                        <td>{{$question['year']}} </td>
                                        <td>{{$question['exam_type']}} </td>
                                        <td>{{$question['option_a']}} </td>
                                        <td>{{$question['option_b']}} </td>
                                        <td>{{$question['option_c']}} </td>
                                        <td>{{$question['option_d']}} </td>
                                        <td>{{$question['option_e']}} </td>
                                        <td>{{$question['correct_answer']}} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>    
                
            </div>
        </div>
    </div>
    @endsection