@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center m-8">Select Subject, Year & Exam Type</h2>
                    </div>
                    <div class="card-body my-4"> 
                        <form action="{{ route('exam.start') }}" method="POST">
                            @csrf

                            <div class="row">
                          <div class="my-4">
                            <h3 for="subject" class="">Select Subject</h3>
                            <select name="subject" class="btn btn-secondary" required>
                
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject }}" class="btn btn-primary">{{ $subject }}</option>
                                @endforeach
                            </select>
                          </div>
                
                          <div class="my-4">
                            <h3 for="year">Select Year</h3>
                            <select name="year" class="btn btn-secondary" required>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                          </div>
                
                            <div class="my-4">
                                <h3 for="exam_type">Select Exam Type</h3>
                            <select name="exam_type" class="btn btn-secondary mx-30 my-8" required>
                                @foreach ($examTypes as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                
                            <button type="submit" class="btn btn-danger float-end text-bold">Start Exam</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        



    </div>
@endsection
