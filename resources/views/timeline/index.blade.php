
@extends('templates.default')


@section('content')
<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="{{ route('status.post') }}">
            @csrf
                <div class="form-group">
                    <textarea name="status"
                    class="form-control {{ $errors->has('status')?'is-invalid':'' }}"
                    placeholder="О чем задумался, {{ Auth::user()->getFirstNameOrUsername() }} ?"
                    rows="3">
                    </textarea>
                @if ($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                </div>
                <button type="submit" class="btn btn-primary">Опубликовать!</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <hr>

  @if ( ! $statuses->count() )
      <p>Пока нет ни одной записи на стене:(</p>
  @else
    @foreach ($statuses as $status)
        <div class="media"
        {{-- style="border:1px solid black;" --}}
        >
        <a class="mr-3" href="{{ route('profile.index', ['username' => $status->user->username]) }}">
        <img class="media-object rounded" src="{{ $status->user->getAvatarUrl() }}"
            alt="{{ $status->user->getNameOrUsername() }}">
        </a>
            <div class="media-body">
            <h4>
                <a href="{{ route('profile.index', ['username' => $status->user->username]) }}">
                {{ $status->user->getNameOrUsername() }}</a>
            </h4>
            <p>{{ $status->body }}</p>
            <ul class="list-inline">
                <li class="list-inline-item">{{ $status->created_at->diffForHumans() }}</li>
                {{-- <li class="list-inline-item">
                <a href="#">Лайк</a>
                </li>
                <li class="list-inline-item">10 Лайков</li> --}}
                {{-- LIKES --}}
                @if ( $status->user->id !== Auth::user()->id )
                <li class="list-inline-item">
                    <a href="{{ route('status.like', ['statusId' => $status->id]) }}">Лайк</a>
                </li>
                @endif
                <li class="list-inline-item">
                    {{ $status->likes->count() }} {{ Str::plural('like', $status->likes->count()) }}
                </li>
            </ul>
{{-- COMMENTS --}}
            @foreach ($status->replies as $reply)
                <div class="media">
                <a class="mr-3" href="{{ route('profile.index', ['username' => $reply->user->username]) }}">
                <img class="media-object rounded" src="{{ $reply->user->getAvatarUrl() }}"
                    alt="{{ $reply->user->getNameOrUsername() }}">
                </a>
                    <div class="media-body">
                        <h4>
                            <a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">
                            {{ $reply->user->getNameOrUsername() }}</a>
                        </h4>
                        <p>{{ $reply->body }}</p>
                        <ul class="list-inline">
                            <li class="list-inline-item">{{ $reply->created_at->diffForHumans() }}</li>
                            {{-- <li class="list-inline-item">
                            <a href="#">Лайк</a>
                            </li>
                            <li class="list-inline-item">10 Лайков</li> --}}
                            {{-- LIKES --}}
                        @if ( $reply->user->id !== Auth::user()->id )
                            <li class="list-inline-item">
                              <a href="{{ route('status.like', ['statusId' => $reply->id]) }}">Лайк</a>
                            </li>
                        @endif
                            <li class="list-inline-item">
                              {{ $reply->likes->count() }} {{ Str::plural('like', $reply->likes->count()) }}
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
{{-- COMMENTS --}}
        <form method="POST" action="{{ route('status.reply', ['statusId'=>$status->id])  }}"
            class="mb-4">
                @csrf
                <div class="form-group">
                <textarea name="reply-{{ $status->id }}"
                    class="form-control
                    {{ $errors->has("reply-{$status->id}") ? 'is-invalid':'' }}"
                        placeholder="Прокомментировать" rows="3">
                </textarea>
                        @if ($errors->has("reply-{$status->id}"))
                            <div class="invalid-feedback">
                                {{ $errors->first("reply-{$status->id}") }}
                            </div>
                        @endif

                </div>
                <input type="submit" class="btn btn-secondary btn-sm" value="Ответить">
            </form>
            <hr>
            </div>
        </div>
    @endforeach

        {{ $statuses->links() }}

    @endif
    </div>
</div>

@endsection
