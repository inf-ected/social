
@extends('templates.default')


@section('content')

{{-- {{ dd($friends) }} --}}

<div class="row">
    <div class="col-lg-6">
        <h3>Ваши друзья</h3>
        @if (!$friends->count())
        <p>У вас нет друзей</p>

        @else
            @foreach ($friends as $user)
                @include('user.partial.userblock')
            @endforeach
        @endif

    </div>
    <div class="col-lg-6">
        <h3>Запросы в друзья</h3>
        @if (!$requests->count())
        <p>У вас нет запросов в друзья</p>
        @else
            @foreach ($requests as $user)
                @include('user.partial.userblock')
                {{-- <a href="{{route('friend.acceptrequest',$user->id)}}">
                    <button class="btn btn-primary mb-2">принять</button>
                </a>
                <a href="{{route('friend.delrequest',$user->id)}}">
                    <button class="btn btn-danger mb-2">отклонить</button>
                </a> --}}
                {{--dump($user)--}}
            @endforeach
        @endif


    </div>
</div>
@endsection
