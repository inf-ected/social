@if (Session::has('info'))
    <div class="alert alert-primary">
        {{Session::get('info')}}
    </div>
@endif
