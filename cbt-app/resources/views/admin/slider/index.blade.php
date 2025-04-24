@extends('layouts.admin-dashboard')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Slider <a class="btn btn primary btn-sm float-right" href="{{url('add-slider')}}">Add Slider</a></h4>
                    
                </div>
                <div class="card-body">
                    {{-- your slider data --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection