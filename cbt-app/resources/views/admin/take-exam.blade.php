{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Select a Subject</h2>
    <div class="row">
        @foreach($subjects as $subject)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>{{ $subject->name }}</h5>
                    <a href="{{ route('exam.start', $subject->id) }}" class="btn btn-primary">Start Exam</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection --}}
<h1>take exam</h1>
 <a href="{{ url('exam.start') }}" class="btn btn-primary">Start Exam</a>