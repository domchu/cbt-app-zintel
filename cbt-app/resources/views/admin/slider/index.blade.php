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

                                            <form action="{{ url('home-slider.destroy/'.$slider->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"                                       
                                                    class="btn btn-danger float-right delete-slider" data-id="{{$slider->id}}" >Delete</button>
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


{{-- SWEET SweetAlert --}}
<script>
$(document).ready(function() {
    $('.delete-slider').click(function() {
        var sliderId = $(this).data('id');
        var button = $(this);

        // SweetAlert confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirmed, make the AJAX call
                $.ajax({
                    url: '/sliders/' + sliderId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Fade out the deleted row
                        button.closest('tr').fadeOut();

                        // Show success message
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        )
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'There was a problem deleting the slider.',
                            'error'
                        )
                    }
                });
            }
        })
    });
});
</script>
