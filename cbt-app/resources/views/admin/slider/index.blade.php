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
                                    @if (count($slider) > 0)
                                        @foreach ($slider as $sliderItem)
                                            <tr>
                                                <td>{{ $sliderItem->id }} </td>
                                                <td>{{ $sliderItem->heading }} </td>
                                                <td>{{ $sliderItem->description }} </td>
                                                <td>{{ $sliderItem->link }} </td>
                                                <td>{{ $sliderItem->link_name }} </td>
                                                <td>
                                                    <img src="{{ Storage::url($sliderItem->image) }}" alt="Slider Image"
                                                        style="width:100px; height:50px;">
                                                </td>
                                                <td>
                                                    @if ($sliderItem->status == '1')
                                                        visible
                                                    @else
                                                        hidden
                                                    @endif

                                                </td>
                                                <td>
                                                    <a href="{{ url('edit-slider/' . $sliderItem->id) }}"
                                                        class="btn btn-success">Edit</a>
                                                    <a href="{{ url('show-slider/' . $sliderItem->id) }}"
                                                        class="btn btn-info">Show</a>

                                                    <form action="{{ url('home-slider/' . $sliderItem->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger delete-slider d-inline"
                                                            data-id="{{ $sliderItem->id }}">Delete</button>
                                                    </form>

                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>No data found</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        
                        <div class="mt-3">
                            {{ $slider->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



{{-- SWEET SweetAlert --}}

{{-- <script>
    function bindDeleteButtons() {
    $('.delete-slider').off('click').on('click', function () {
        const sliderId = $(this).data('id');
        const button = $(this);

        Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete the slider.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/sliders/' + sliderId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        Swal.fire('Deleted!', response.message, 'success');

                        // Reload partial view
                        $('#sliderTable').load("{{ route('sliders.list.partial') }}", function () {
                            bindDeleteButtons();
                        });
                    },
                    error: function () {
                        Swal.fire('Error!', 'Could not delete slider.', 'error');
                    }
                });
            }
        });
    });
}

$(document).ready(function () {
    bindDeleteButtons();
});
</script> --}}

{{-- <script>
    success: function(response) {
    Swal.fire('Deleted!', response.message, 'success');

    // Reload the slider list partial
    $('#sliderTable').load("{{ route('sliders.list.partial') }}", function () {
        // Re-bind delete button events after reload
        bindDeleteButtons();
    });
}

</script> --}}
@endsection


