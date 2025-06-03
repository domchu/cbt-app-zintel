@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                {{-- SUCCESS MESSAGE --}}
                @if (session('success'))
                    <h5 class="alert alert-success">{{ session('success') }} </h5>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- END OF SESSION MESSAGE --}}
                <div class="card">
                    <div class="card-header">
                        <h4>Upload WAEC/BECE/JAMB Past Questions (CSV or Excel)</h4>

                    </div>
                    <div class="card-body my-4">                    
                            <form action="{{ route('questions.preview') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group mb-4">
                                <label for="">Select File:</label>
                                <input type="file" name="file" class="form-control" required>
                                 @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Preview Questions</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
