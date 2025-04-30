@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
               
                <div class="card">
                    <div class="card-header">
                        <h4>Update Slider <a class="btn btn-danger float-end" href="{{ url('home-slider') }}"> Back</a>
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="{{ url('update-slider/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Heading</label>
                                <input type="text" class="form-control" name="heading" value="{{ $slider->heading }}">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control">{{ $slider->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Link</label>
                                <input type="text" class="form-control" name="link" value="{{ $slider->link }}">
                            </div>
                            <div class="form-group">
                                <label for="">Link Name</label>
                                <input type="text" class="form-control" name="link_name"
                                    value="{{ $slider->link_name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Slider Image Upload</label>
                                <input type="file" class="form-control" name="image">
                                 <img src="{{ Storage::url($slider->image) }}" alt="Slider Image" style="width:100px; height:100px;"
                                    onchange="previewImage(event)">
                                <img id="imagePreview" />
                            </div>
                            <div class="form-group py-4">
                                <label for="">Status</label>
                                <input type="checkbox" name="status" {{ $slider->status == '1' ? 'checked' : '' }}>
                           
                            </div>
                            <div class="form-group py-4">
                                <button type="submit" class="btn btn-primary">Update Slider </button>
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

    reader.onload = function(){
        const imgElement = document.getElementById('imagePreview');
        imgElement.src = reader.result;
        imgElement.style.display = 'block';
    }

    reader.readAsDataURL(input.files[0]);
}
</script>
