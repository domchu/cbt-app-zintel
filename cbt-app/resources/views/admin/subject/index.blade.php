@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Add Subject 
                            <a href="{{ route('subject.create') }}" class="btn btn-primary float-end">Back</a>
                        </h2>
                        
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Subject Code</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($subject as $subjectItem)
                                    <tr>
                                        <td>{{ $subjectItem->name }}</td>
                                        <td>{{ $subjectItem->code }}</td>
                                        <td>
                                            <a href="{{ route('subjects.edit', $subjectItem->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form action="{{ route('subjects.destroy', $subjectItem->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody> --}}
                        </table>
                    </div>
                </div>

            </div>
        </div>
    @endsection
