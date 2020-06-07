
@extends('templates.default')


@section('content')
<div class="row">
    <div class="col-lg-5">
                    @include('user.partial.userblock')
    </div>
    <div class="col-lg-4 col-lg-offset-3">
        <h4>{{ $user->getFirstNameOrUsername() }} друзья</h4>
        {{-- {{dd($user->friends())}} --}}
        @if (!$user->friends()->count())
            <p>{{ $user->getFirstNameOrUsername() }} нет друзей</p>
        @else
            @foreach ($user->friends() as $user)
                @include('user.partial.userblock')
            @endforeach
        @endif
    </div>

</div>
@endsection
