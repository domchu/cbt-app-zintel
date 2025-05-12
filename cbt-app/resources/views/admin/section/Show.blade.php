@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">            
                <div class="card">
                    <div class="card-header">
                        <h4>Show Detail {{$sectionItem->id}} <a class="btn btn-secondary float-end" href="{{ route('section.create') }}">Add Session</a>
                        </h4>
                    </div>
                    <div class="card-body my-3">
                        <p> <strong>Name</strong> {{ $sectionItem->name }}</p>

                    </div>
                    <div class=" my-3">
                        <p><strong>Active</strong>
                            <span class="badge bg-{{ $sectionItem->is_active ? 'success' : 'secondary' }}">
                                {{ $sectionItem->is_active ? 'Yes' : 'No' }}
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
