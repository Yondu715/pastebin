@if (Session::has($name))
    <div class="alert alert-{{$type}}">{{ Session::get($name) }}</div>
@endif
