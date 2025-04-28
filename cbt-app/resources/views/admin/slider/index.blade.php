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
                                            <img src="{{ asset('uploads/slider/' . $sliderItem->image) }}" alt="Slider Image"
                                                style="max-width: 100px">
                                               

                                        </td>
                                        <td>
                                            @if ($sliderItem->status == '1')
                                                visible
                                            @else
                                                hidden
                                            @endif

                                        </td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <a href="{{ url('edit-slider/'.$sliderItem->id) }}"
                                                class="btn btn-success flo">Edit</a>
                                            <a href="{{ url('view-slider/'.$sliderItem->id) }}"
                                                class="btn btn-primary">View</a>

                                            <form action="" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this slider?')"
                                                    class="btn btn-danger float-right">Delete</button>
                                            </form>
                                        </div>
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
