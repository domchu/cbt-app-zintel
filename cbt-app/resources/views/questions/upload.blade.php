@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Upload WAEC Past Questions (CSV or Excel)</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
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

        <form action="{{ route('questions.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Select File:</label>
                <input type="file" name="file" class="form-control" required>
            </div>


            <button type="submit" class="btn btn-primary">Upload</button>

            <button type="submit" class="btn btn-primary">Preview Questions</button>
        </form>
    </div>
@endsection
