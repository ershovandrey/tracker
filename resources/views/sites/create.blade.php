@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Create site</h5>

                    <div class="card-body">
                        @include('errors')

                        <form method="POST" action="/sites">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" placeholder="Title" value="{{ old('title') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="text" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" name="url" placeholder="Site URL" value="{{ old('url') }}" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info" type="submit">Create Site</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
