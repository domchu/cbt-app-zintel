@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>All Subjects Info
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
                            <tbody>
                                @foreach ($subject as $subjectItem)
                                    <tr>
                                        <td>{{ $subjectItem->id }}</td>
                                        <td>{{ $subjectItem->name }}</td>
                                        <td>{{ $subjectItem->code }}</td>
                                        <td>
                                            <a href="{{ route('subject.edit', $subjectItem->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <a href="{{ route('subject.show', $subjectItem->id) }}"
                                                class="btn btn-info">Show Subject</a>
                                            <form action="{{ route('subject.destroy', $subjectItem->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    @endsection
