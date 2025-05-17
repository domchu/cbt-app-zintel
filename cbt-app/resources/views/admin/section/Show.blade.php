@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">            
                <div class="card">
                    <div class="card-header">
                        <h4>Show Detail {{$section->id}} <a class="btn btn-primary float-end" href="{{ route('section.create') }}">Add Session</a>
                        </h4>
                    </div>
                    <div class="card-body my-3">
                        <p> <strong class="mx-2">Name:</strong> {{ $section->name }}</p>

                    </div>
                    <div class="card-body my-3">
                        <p><strong class="mx-2">Active:</strong>
                            <span class="badge bg-{{ $section->is_active ? 'success' : 'secondary' }}">
                                {{ $section->is_active ? 'Yes' : 'No' }}
                            </span>
                        </p>

                    </div>
                    <div class="my-3">
                        <a class="btn btn-danger mx-4" href="{{ route('section.index') }}">Back to List</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
