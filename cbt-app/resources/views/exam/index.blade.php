@extends('layouts.app')

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
                                    <button type="submit" class="btn btn-primary fw-bold">Start Exam</button>
                                </div>
                            </form>
                        </div>
                    {{-- </div> --}}
                    
                </div>
            </div>
        </div>
        



    </div>
    {{-- CBT INSTRUCTIONS --}}

<div class="container my-4">
    <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#cbtInstructions" aria-expanded="false" aria-controls="cbtInstructions">
        CBT Exams Instructions
    </button>

    <div class="collapse mt-3" id="cbtInstructions">
        <div class="card shadow border-0">
            <div class="card-body">
                <h4 class="mb-3 text-secondary"> Computer-Based Test (CBT) Instructions</h4>
                <ul class="cbt-instructions">
                    <li>Make sure you are in a quiet and comfortable environment before starting the test.</li>
                    <li>Once the exam starts, the timer will begin counting down. The test will automatically submit when time runs out.</li>
                    <li>You are allowed to answer questions in any order unless otherwise restricted.</li>
                    <li>Click “Next” to proceed to the next question, and “Previous” to review earlier questions (enabled).</li>
                    <li>Do not refresh the browser, close the tab, or press the back button during the test.</li>
                    <li>Each question may have a time limit or may auto-lock after submission (based on exam settings).</li>
                    <li>Click “Submit” once you are done. You cannot modify answers after submission.</li>
                    <li>Your score will be available immediately submit button is trigger or after admin review depending on the exam type.</li>
                    <li>Cheating or switching tabs may lead to disqualification.</li>
                    <li>If you face any issues, contact your exam supervisor or administrator immediately.</li>
                    <li>GoodLucks !!!</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Optional custom styling -->
<style>
    .cbt-instructions {
        list-style: none;
        padding-left: 0;
    }

    .cbt-instructions li {
        position: relative;
        padding-left: 2rem;
        margin-bottom: 0.75rem;
        font-size: 1rem;
        color: #393737;
        line-height: 1.6;
        background: #f8f9fa;
        border-left: 4px solid #0d6efd;
        border-radius: 0.25rem;
        padding: 0.75rem 1rem;
    }

    /* .cbt-instructions li::before { */
        /* content: "✔️";
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.1rem;
        color: #0d6efd; */
    /* } */
</style>


@endsection
