@extends('layouts.admin-dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                {{-- SUCCESS MESSAGE --}}
                @if (session('status'))
                    <h5 class="alert alert-success">{{ session('status') }} </h5>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{${error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- END OF SESSION MESSAGE --}}
                <div class="card">
                    <div class="card-header">
                        <h4>Upload WAEC/BECE/JAMB Past Questions (CSV or Excel)
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('questions.preview') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Select File:</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Preview Questions</button>
                        </form>
                    </div>
                </div>

            </div>





        </div>
    @endsection
