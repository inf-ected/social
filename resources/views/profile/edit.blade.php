
@extends('templates.default')


@section('content')
<div class="row">
    <div class="col-lg-6">
        <h2>Редактирование профиля</h2>
        <form method="post" action="{{route('profile.edit')}}" novalidate>
            @csrf
                <div class="form-group">
                    <label for="first_name">Ваше имя</label>
                <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid':''}}" id="email"
                    name="first_name"
                value="{{Request::old('first_name')?:Auth::user()->first_name}}">
                    @if ($errors->has('first_name'))
                        <span class="help-block text-danger">
                            {{$errors->first('first_name')}}
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="last_name">Ваша Фамилия</label>
                    <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid':''}}"
                    id="last_name"
                    name="last_name"
                    value="{{Request::old('last_name')?:Auth::user()->last_name}}">
                    @if ($errors->has('last_name'))
                    <span class="help-block text-danger">
                        {{$errors->first('last_name')}}
                    </span>
                @endif
                </div>

                <div class="form-group">
                    <label for="location">Откуда вы</label>
                    <input type="text" class="form-control {{ $errors->has('location') ? 'is-invalid':''}}"
                     id="location"
                    name="location"
                    value="{{Request::old('location')?:Auth::user()->location}}">
                    @if ($errors->has('location'))
                    <span class="help-block text-danger">
                        {{$errors->first('location')}}
                    </span>
                @endif
                </div>

                <button type="submit" class="btn btn-primary">Обновить!</button>
            </form>
    </div>
</div>
@endsection
