@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                {{-- SUCCESS MESSAGE --}}
                @if(session('status'))
                    <h5 class="alert alert-success">{{ session('status') }} </h5>
                @endif

                @if(session('error'))
                    <h5 class="alert alert-danger">
                        {{ session('error') }}
                    </h5>
                @endif
               

                {{-- END OF SESSION MESSAGE --}}
                <div class="card">
                    <div class="card-header">
                        <h4>Show Subject <a class="btn btn-danger float-end" href="{{ route('subject.index') }}"> Back</a>
                        </h4>

                    </div>
                    <div class="card-body">
                        
                            @csrf
                            <div class="form-group my-3">
                                <h5 for="">Subject Name</h5>
                                <p>{{ $subject->name }}</p>
                            </div>
                            <div class="form-group my-3">
                                <h5 >Subject Code</h5>
                                  <p>{{ $subject->code }}</p>
                            </div>
                           
                            
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

