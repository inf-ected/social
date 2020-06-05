
@extends('templates.default')


@section('content')
    <h3>Войти</h3>
<div class="row">
    <div class="col-lg-4 mx-auto">

    <form method="post" action="{{route('auth.signin')}}" novalidate>
        @csrf
            <div class="form-group">
                <label for="email">Email address</label>
            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid':''}}" id="email"
                name="email" placeholder="например user@mail.com"
            value="{{Request::old('email')?:''}}">
                @if ($errors->has('email'))
                    <span class="help-block text-danger">
                        {{$errors->first('email')}}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid':''}}" id="password"
                name="password" placeholder="минимум 6 символов"
                value="{{Request::old('password')?:''}}">
                @if ($errors->has('password'))
                <span class="help-block text-danger">
                    {{$errors->first('password')}}
                </span>
            @endif
            </div>
            <div class="custom-control custom-checkbox mb-3">
                <input name="remember" type="checkbox" class="custom-control-input" id="remember">
                <label class="custom-control-label" for="remember">Запомнить меня </label>
              </div>
            <button type="submit" class="btn btn-primary">Войти!</button>
        </form>

    </div>
</div>
{{-- {{dd($errors)}} --}}
        @endsection
