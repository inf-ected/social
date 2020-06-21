
@extends('templates.default')


@section('content')
<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="#">
            <div class="form-group">
                <textarea class="form-control" placeholder="О чем задумался ?" rows="3">
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Опубликовать!</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-5">

    </div>
</div>

@endsection
