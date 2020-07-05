<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Status;

class StatusController extends Controller
{
    public function postStatus(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:1000'
        ]);
        Auth::user()->statuses()->create([
            'body' => $request->input('status')
        ]);
        return redirect()->route('home')
            ->with('info', 'Статус успешно добавлен!');
    }
    public function postReply(Request $request, $statusId)
    {

        $this->validate(
            $request,
            [
                "reply-{$statusId}" => 'required|max:1000'
            ],
            [
                'required' => 'Обязательно для заполнения!'
            ]
        );
        #notReply наш пользовательский scope
        $status = Status::notReply()->find($statusId);
        #провверка на несуществующую запись
        if ( ! $status) redirect()->route('home');
        #проверка на если коментатор не друг
        if( ! Auth::user()->isFriendWith($status->user)
        && Auth::user()->id !== $status->user->id){
           return redirect()->route('home');
        }
        // dump($request);
        // dump($statusId);
        $reply = new Status();
        $reply->body = $request->input("reply-{$status->id}");
        $reply->user()->associate( Auth::user() );
        $status->replies()->save($reply);

        return redirect()->back();

    }
}
