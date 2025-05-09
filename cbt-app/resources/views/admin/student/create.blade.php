@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
             

                {{-- END OF SESSION MESSAGE --}}
                <div class="card">
                    <div class="card-header">
                        <h4>Register Student <a class="btn btn-danger float-end" href="{{ url('admin/student') }}"> Back</a>
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row col-md-12">
                                <div class="form-group my-3">
                                    <label for="">Surname</label>
                                    <input type="text" class="form-control" name="surname">
                                    @error('surname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group my-3">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" name="first_name">
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group my-3">
                                    <label for="">Other Name</label>
                                    <input type="text" class="form-control" name="other_name">
                                    @error('other_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group my-3">
                                <label for="">Email Address</label>
                                <input type="email" class="form-control" name="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group my-3">
                                <label for="">Phone Number</label>
                                <input type="text" class="form-control" name="phone">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="">Date OF Birth</label>
                                <input type="date" class="form-control" name="dob">
                                @error('dob')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="">State</label>
                                <input type="text" class="form-control" name="state">
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group my-3">
                                <label for="">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="'">-- Select Gender --</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="">Country</label>
                                <input type="text" class="form-control" name="country">
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group my-3">
                                <label for="">Student Image Upload</label>
                                <input type="file" class="form-control" name="image" id="image"
                                    onchange="StudentPreviewImage(event)">
                                <img id="studentImagePreview" style="width:70px; height:70px; display: none;" />
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group my-3">
                                <label for="">Student Address</label>
                                <textarea name="address" id="address" class="form-control"></textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group my-3">
                                <label for="">Status</label>
                                <input type="checkbox" name="status"> 1=visible, 0=hidden
                            </div>
                            <div class="form-group flex justify-center align-baseline text-center w-full my-0 mx-auto">
                                <button type="submit" class="btn btn-primary btn-lg">Add Student</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function StudentPreviewImage(event) {
        const input = event.target;
        const reader = new FileReader();

        reader.onload = function() {
            const imgElement = document.getElementById('studentImagePreview');
            imgElement.src = reader.result;
            imgElement.style.display = 'block';
        }

        reader.readAsDataURL(input.files[0]);
    }
</script>
