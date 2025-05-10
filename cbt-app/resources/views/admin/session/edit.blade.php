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
                    <h5 class="alert alert-danger"> {{ session('error') }}</h5>
                @endif
               

                {{-- END OF SESSION MESSAGE --}}
                <div class="card">
                    <div class="card-header">
                        <h4>Update Session: {{$session->name}} <a class="btn btn-danger float-end" href="{{ route('sessions.index') }}">Back to List</a>
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('sessions.update', $session->id) }}" method="POST" >
                            @csrf
                            @method('PUT')
                            <div class="form-group my-3">
                                <label for="">Session Name (e.g., 2024/2025)</label>
                                <input type="text" class="form-control" name="name" value="{{$session->name}}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group my-3 form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                                {{$session->is_active ? 'checked' : ''}}
                                > 
                                <label for="is_active">Set as Active</label>
                            </div>
                            <div class="form-group my-3">
                                <button type="submit" class="btn btn-primary">Update Session</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

