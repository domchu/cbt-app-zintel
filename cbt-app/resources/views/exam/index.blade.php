@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-16">
                    <div class="card-header mt-16">
                        <h2 class="text-center ">Select Subject, Year & Exam Type</h2>
                    </div>
                    {{-- <div class="my-4 shadow-sm border-0"> --}}
                        <div class="card-body">
                            <h3 class="card-title mb-4">Start Your Exam</h3>
                            <form action="{{ route('exam.start') }}" method="POST">
                                @csrf
                    
                                <div class="row g-3">
                                    <!-- Subject Select -->
                                    <div class="col-md-4">
                                        <label for="subject" class="form-label fw-semibold">Select Subject</label>
                                        <select name="subject" id="subject" class="form-select" required>
                                            <option selected disabled>Choose a Subject</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject }}">{{ $subject }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <!-- Year Select -->
                                    <div class="col-md-4">
                                        <label for="year" class="form-label fw-semibold">Select Year</label>
                                        <select name="year" id="year" class="form-select" required>
                                            <option selected disabled>Choose a Year</option>
                                            @foreach ($years as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <!-- Exam Type Select -->
                                    <div class="col-md-4">
                                        <label for="exam_type" class="form-label fw-semibold">Select Exam Type</label>
                                        <select name="exam_type" id="exam_type" class="form-select" required>
                                            <option selected disabled>Choose Exam Type</option>
                                            @foreach ($examTypes as $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                    
                                <div class="mt-4 text-end">
                                    <button type="submit" class="btn btn-danger fw-bold">Start Exam</button>
                                </div>
                            </form>
                        </div>
                    {{-- </div> --}}
                    
                </div>
            </div>
        </div>
        



    </div>
@endsection
