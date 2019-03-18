@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Site <em>"{{$site->title}}"</em> visitors</h5>

                    <div class="card-body">
                        @include('messages')
                        @if ($visits->count())
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Visitor ID</th>
                                    <th scope="col">URL</th>
                                    <th scope="col">Browser</th>
                                    <th scope="col">IP</th>
                                    <th scope="col">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($visits as $visit)
                                    <tr>
                                        <td>{{ $visit->visitor }}</td>
                                        <td><a href="{{ $visit->url }}">{{ $visit->url }}</a></td>
                                        <td>{{ $visit->browser }}</td>
                                        <td>{{ $visit->ip }}</td>
                                        <td>{{ $visit->datetime }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $visits->links() }}
                        @else
                            <div class="alert alert-primary" role="alert">
                                There is no records about visitors of your site.
                            </div>
                        @endif
                        <div class="form-group">
                            <a href="/sites" class="btn btn-link">Back to all sites</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
