@if ($errors->any())
    <ul class="alert alert-danger list-unstyled" role="alert">
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif
