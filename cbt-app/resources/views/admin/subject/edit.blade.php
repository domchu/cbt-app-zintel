@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Subject <a class="btn btn-danger float-end" href="{{ route('subject.index') }}"> Back</a>
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="{{ route( 'subject.update',$subject->id) }}" method="POST" >
                            @csrf
                            @method('PUT')
                            <div class="form-group my-3">
                                <label for="">Subject</label>
                                <input type="text" class="form-control" name="name" value="{{ $subject->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="">Subject Code</label>
                                <input type="text" class="form-control" name="code" value="{{ $subject->code }}">
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                           
                            <div class="form-group my-3">
                                <label for="">Status</label>
                                <input type="hidden" name="status" value="0">
                                <input type="checkbox" name="status"  {{ $subject->status == 'true' ? 'checked' : '' }}> 1=visible, 0=hidden
                            </div>
                            <div class="form-group my-3">
                                <button type="submit" class="btn btn-primary">Update Subject</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

