@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                {{-- SUCCESS MESSAGE --}}
                @if (session('status'))
                    <h5 class="alert alert-success">{{ session('status') }} </h5>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4> Academic Session <a class="btn btn-secondary float-end"
                                href="{{ url('admin.section.index') }}">Add Session</a>
                        </h4>

                    </div>
                    <div class="card-body">
                        <table class="table-stripe table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Active?</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- @if (count($sections) > 0) --}}
                                @foreach ($sections as $sectionItem)
                                    <tr>
                                        <td>{{ $sectionItem->name }}</td>
                                        <td>{{ $sectionItem->is_active ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <a href="{{ route('sections.edit', $sectionItem->id) }}"
                                                class="btn btn-success">Edit</a>
                                            <a href="{{ route('sections.show', $sectionItem->id) }}"
                                                class="btn btn-info">Show</a>
                                            <form action="{{ route('sections.destroy', $sectionItem->id) }}"
                                                class="d-inline">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach

                                {{-- @endif --}}
                                {{-- @empty($sections)
                            <tr>
                                <td class="colspan-6">No section found in the database</td>
                            </tr>
                                
                            @endempty --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
