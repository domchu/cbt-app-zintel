@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h4> Slider {{ $slider->id}}
                        </h4>

                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <h2>Title: </h2> 
<p>{{ $slider->heading }}</p> 
                        </div>
                        <div class="form-group">
                            <h2>Description: </h2>
                            <p> {{ $slider->description }}</p>
                        </div>
                        <div class="form-group">
                            <h2>Link:  </h2>
                            <p>{{ $slider->link }}</p>

                        </div>
                        <div class="form-group">
                            <h2>Link Name: </h2>
                            <p>{{ $slider->link_name }}</p>


                        </div>
                        <div class="form-group">
<h2>Slider Image</h2>

                            <img src="{{ asset('uploads/sliders/' . $slider->image) }}" alt="Slider Image">

                        </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
