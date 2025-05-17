@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h4>Show Slider {{ $slider->id }} <a class="btn btn-danger float-end" href="{{ url('home-slider') }}">Back</a>
                        </h4>

                        </h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <h5>Title: </h5>
                            <p>{{ $slider->heading }}</p>
                        </div>
                        <div class="form-group">
                            <h5>Description: </h5>
                            <p> {{ $slider->description }}</p>
                        </div>
                        <div class="form-group">
                            <h5>Link: </h5>
                            <p>{{ $slider->link }}</p>

                        </div>
                        <div class="form-group">
                            <h5>Link Name: </h5>
                            <p>{{ $slider->link_name }}</p>


                        </div>
                        <div class="form-group">
                            <h5>Slider Image</h5>

                          <img src="{{ Storage::url($slider->image) }}" alt="Slider Image" style="width:500px; height:300px;">

                        </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
