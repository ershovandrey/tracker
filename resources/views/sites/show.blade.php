@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Site {{$site->title}} visitors </h5>

                    <div class="card-body">
                        @include('messages')

    <h1 class="title">{{$project->title}}</h1>
    <div class="content">{{$project->description}}</div>
    <p><a href="/projects/{{$project->id}}/edit" class="button">Edit Project</a></p>

    @if ($project->tasks->count())
        <div class="box">
            <p>Tasks</p>
            @foreach ($project->tasks as $task)
                <div>
                    <form method="POST" action="/tasks/{{$task->id}}">
                        @method('PATCH')
                        @csrf
                        <label class="checkbox" for="completed">
                            <input type="checkbox" name="completed" {{$task->completed ? 'checked="checked"' : ''}} onchange="this.form.submit()">
                            {{$task->description}}
                        </label>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
    <a href="/projects">Back to all projects</a>
@endsection
