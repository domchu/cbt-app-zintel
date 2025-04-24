@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Slider <a class="btn btn danger btn-sm float-right" href="{{ url('home-slider') }}"><- Back</a>
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="{{ url('store-slider') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Heading</label>
                                <input type="text" class="form-control" name="Heading">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" id="" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Link</label>
                                <input type="text" class="form-control" name="link">
                            </div>
                            <div class="form-group">
                                <label for="">Link Name</label>
                                <input type="text" class="form-control" name="link_name">
                            </div>
                            <div class="form-group">
                                <label for="">Slider Image Upload</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <input type="checkbox" class="form-control" name="status">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
