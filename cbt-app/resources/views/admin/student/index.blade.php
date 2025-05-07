@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Registered <a class="btn btn-primary float-end"
                                href="{{ url('subject.create') }}">Register Student </a></h4>

                    </div>
                    <div class="card-body">
                        {{-- your Student data --}}

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Surname</th>
                                    <th>Fisrt Name</th>
                                    <th>Other Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Gender</th>
                                    <th>Registration Number</th>
                                    <th>State Of Origin</th>
                                    <th>Country</th>
                                    <th>Home Address</th>
                                    <th>Date Of Birth</th>
                                    <th>Slider Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($student) > 0)
                                    @foreach ($student as $studentInfo)
                                        <tr>
                                            <td>{{ $studentInfo->id }} </td>
                                            <td>{{ $studentInfo->surname }} </td>
                                            <td>{{ $studentInfo->first_name }} </td>
                                            <td>{{ $studentInfo->other_name }} </td>
                                            <td>{{ $studentInfo->email }} </td>
                                            <td>{{ $studentInfo->phone }} </td>
                                            <td>{{ $studentInfo->gender }} </td>
                                            <td>{{ $studentInfo->state }} </td>
                                            <td>{{ $studentInfo->country }} </td>
                                            <td>{{ $studentInfo->registration_number }} </td>
                                            <td>{{ $studentInfo->address }} </td>
                                            <td>{{ $studentInfo->dob }} </td>
                                            <td>
                                                <img src="{{ Storage::url($studentInfo->image) }}" alt="Student Image"
                                                    style="width:100px; height:50px;">
                                            </td>
                                            <td>
                                                @if ($studentInfo->status == '1')
                                                    visible
                                                @else
                                                    hidden
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{ url('subject.edit/' . $studentInfo->id) }}"
                                                    class="btn btn-success">Edit</a>
                                                <a href="{{ url('subject.show/' . $studentInfo->id) }}"
                                                    class="btn btn-info">Show</a>

                                                <form action="{{ url('subject.destroy/' . $studentInfo->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger delete-student d-inline"
                                                        data-id="{{ $studentInfo->id }}">Delete</button>
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
@endsection


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
