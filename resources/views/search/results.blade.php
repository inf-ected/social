
@extends('templates.default')


@section('content')
<div class="row">
    <div class="col-lg-6">
    <h2>Результаты поиска {{Request::input('query')}}</h2>

    @if ($users->count())
        <div class="row">
            <div class="col-lg-6">
                @foreach ($users as $user)
                    @include('user.partial.userblock')
                @endforeach
            </div>
        </div>
    @else
        <p>никого не нашли =(</p>
    @endif

    </div>
</div>
@endsection
