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
                        <h4>Add Subject <a class="btn btn-danger float-end" href="{{ url('add-subject') }}"> Back</a>
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="{{ url('store-subject') }}" method="POST" >
                            @csrf
                            <div class="form-group my-3">
                                <label for="">Suject</label>
                                <input type="text" class="form-control" name="subject">
                                @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="">Code</label>
                                <input type="text" class="form-control" name="code">
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                           
                            <div class="form-group my-3">
                                <label for="">Status</label>
                                <input type="checkbox" name="status"> 1=visible, 0=hidden
                            </div>
                            <div class="form-group my-3">
                                <button type="submit" class="btn btn-primary">Add Subject</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

