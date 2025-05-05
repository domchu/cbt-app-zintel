@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>All Subjects Information
                            <a href="{{ route('subject.create') }}" class="btn btn-primary float-end">Back</a>
                        </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Subject Name</th>
                                    <th>Subject Code</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subject as $subjectItem)
                                    <tr>
                                        <td>{{ $subjectItem->id }}</td>
                                        <td>{{ $subjectItem->name }}</td>
                                        <td>{{ $subjectItem->code }}</td>
                                        <td>{{ $subjectItem->status }}</td>
                                        <td>
                                            <a href="{{ route('subject.edit',$subjectItem->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <a href="{{ route('subject.show',$subjectItem->id) }}"
                                                class="btn btn-info">Show</a>
                                            <form action="{{ route('subject.destroy', $subjectItem->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $subject->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
