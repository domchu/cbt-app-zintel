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
                        <h4> Academic Session <a class="btn btn-danger float-end"
                                href="{{ route('section.create') }}">Add Session</a>
                        </h4>

                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table table-stripe table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Active?</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($section) > 0) 
                                @foreach ($section as $sectionItem)
                                     <tr>
                                        <td>{{ $sectionItem->name }}</td>
                                        <td>{{ $sectionItem->is_active ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <a href="{{ route('section.edit', $sectionItem->id) }}"
                                                class="btn btn-success">Edit</a>
                                            <a href="{{ route('section.show', $sectionItem->id) }}"
                                                class="btn btn-info">Show</a>
                                            <form action="{{ route('section.destroy',$sectionItem->id) }}"
                                                class="d-inline" method="post" onsubmit="return confirm('Are you sure you want to delete this section?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                 @endforeach
                             @else
                                    <tr colspan="6">
                                        <td>No Section found</td>
                                    </tr>
                             @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
