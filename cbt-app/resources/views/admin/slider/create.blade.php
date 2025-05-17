@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                {{-- SUCCESS MESSAGE --}}
                @if(session('status'))
                    <h5 class="alert alert-success">{{ session('status') }} </h5>
                @endif

                @if(session('error'))
                    <h5 class="alert alert-danger">
                        {{ session('error') }}
                    </h5>
                @endif
               

                {{-- END OF SESSION MESSAGE --}}
                <div class="card">
                    <div class="card-header">
                        <h4>Add Slider <a class="btn btn-danger float-end" href="{{ url('home-slider') }}"> Back</a>
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="{{ url('store-slider') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group my-3">
                                <label for="">Heading</label>
                                <input type="text" class="form-control" name="heading">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="">Description</label>
                                <textarea name="description" id="" class="form-control"></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="">Link</label>
                                <input type="text" class="form-control" name="link">
                                @error('link')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="">Link Name</label>
                                <input type="text" class="form-control" name="link_name">
                                @error('link_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="">Slider Image Upload</label>
                                <input type="file" class="form-control" name="image" id="image"
                                    onchange="previewImage(event)">
                                <img id="imagePreview" style="width:70px; height:70px; display: none;" />
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group my-3">
                                <label for="">Status</label>
                                <input type="checkbox" name="status"> 1=visible, 0=hidden
                            </div>
                            <div class="form-group my-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();

        reader.onload = function() {
            const imgElement = document.getElementById('imagePreview');
            imgElement.src = reader.result;
            imgElement.style.display = 'block';
        }

        reader.readAsDataURL(input.files[0]);
    }
</script>
