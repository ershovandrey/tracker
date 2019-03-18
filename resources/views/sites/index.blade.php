@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Your sites</h5>

                    <div class="card-body">
                        @include('messages')

                        @if ($sites->count())
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">URL</th>
                                        <th scope="col">Token</th>
                                        <th scope="col">View visitors</th>
                                        <th scope="col">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sites as $site)
                                        <tr>
                                            <td>{{ $site->title }}</td>
                                            <td><a href="{{ $site->url }}">{{ $site->url }}</a></td>
                                            <td>{{ $site->token }}</td>
                                            <td><a href="/sites/{{$site->id}}">Visitors</a></td>
                                            <td>
                                                <form method="POST" action="/sites/{{ $site->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="form-group">
                                                        <button class="btn btn-danger" type="submit">Delete site</button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-primary" role="alert">
                                There is no sites in your account. Please create new site to continue.
                            </div>
                        @endif
                        <div class="form-group">
                            <a href="/sites/create" class="btn btn-primary">Create new site</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
