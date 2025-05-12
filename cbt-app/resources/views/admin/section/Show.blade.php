@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">            
                <div class="card">
                    <div class="card-header">
                        <h4>Update Detail <a class="btn btn-secondary float-end" href="{{ route('sessions.index') }}">Back to
                                List</a>
                        </h4>
                    </div>
                    <div class="card-body my-3">
                        <p> <strong>Name</strong> {{ $session->name }}</p>

                    </div>
                    <div class=" my-3">
                        <p><strong>Active</strong>
                            <span class="badge bg-{{ $session->is_active ? 'success' : 'secondary' }}">
                                {{ $session->is_active ? 'Yes' : 'No' }}
                            </span>
                        </p>

                    </div>
                    <div class=" my-3">
                        <a class="btn btn-secondary" href="{{ route('sessions.index') }}">Back to List</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
