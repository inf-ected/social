<div class="media mb-2">
<img src="{{$user->getAvatarUrl()}}" class="mr-3" alt="{{$user->getNameOrUsername()}}">
    <div class="media-body">
    <h5 class="mt-0"><a href="">{{$user->getNameOrUsername()}}</a></h5>
    @if ($user->location)
    <p>Location: {{$user->location}}</p>
    @endif

    </div>
  </div>
