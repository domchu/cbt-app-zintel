@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Slider <a class="btn btn-primary float-end" href="{{ url('add-slider') }}">Add Slider</a></h4>

                    </div>
                    <div class="card-body">
                        {{-- your slider data --}}
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Heading</th>
                                    <th>Description</th>
                                    <th>Link</th>
                                    <th>Link Name</th>
                                    <th>Slider Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($slider as $sliderItem)
                                    <tr>
                                        <td>{{ $sliderItem->id }} </td>
                                        <td>{{ $sliderItem->heading }} </td>
                                        <td>{{ $sliderItem->description }} </td>
                                        <td>{{ $sliderItem->link }} </td>
                                        <td>{{ $sliderItem->link_name }} </td>

                                        <td>
                                            <img src="{{ asset('uploads/slider'.$sliderItem->image) }}" alt="Slider Image"
                                                sizes="100" srcset="">
                                        </td>
                                        <td>
                                            @if ($sliderItem->status  == '1')
                                                visible
                                            @else
                                                hidden
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ url('edit-slider/'.$sliderItem->id) }}" class="btn btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('edit-slider/'.$sliderItem->id) }}" class="btn btn-success">View</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('edit-slider/'.$sliderItem->id) }}" class="btn btn-success">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
