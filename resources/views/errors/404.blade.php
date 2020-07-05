@extends('templates.default')


@section('content')
<div class="container  text-center">
    <div class="">

        <h1> УПЦ, ЧТО-ТO ПОШЛО НЕ ТАК ! (404 и всё такое)</h1>
        <img src="{{asset('404.jpg')}}" alt="logo"/>
        <p>
            <a href="{{ route('home') }}">
                Страница не найдена , вурнуться взад
            </a>
        </p>
    </div>
</div>
@endsection


