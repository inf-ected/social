<?php

namespace App\Http\Controllers;

//use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class FriendController extends Controller
{

    public function getIndex()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        // dd($friends);
        return view('friends.index')->with(compact('friends', 'requests'));
    }
    // public function DelRequest($id)
    // { //delete from friends where user_id = 1 and friend_id =2
    //     $my_id = Auth::user()->id;
    //     // DB::delete(
    //     //     'delete friends where friend_id = :fid and user_id = :mid',
    //     //     ['fid' => $my_id, 'mid' => $id]
    //     // );
    //     DB::table('friends')
    //         ->where('friend_id', $id)
    //         ->where('user_id', $my_id)
    //         ->delete();

    //     return redirect()->back()->with('info', 'запрос добавления в друзья отклонён!');
    // }
    // public function AcceptRequest($id)
    // {
    //     $friend_id = $id;
    //     $my_id = Auth::user()->id;
    //     DB::update(
    //         'update friends set accepted =1 where friend_id = :fid and user_id = :mid ',
    //         ['fid' => $friend_id, 'mid' => $my_id]
    //     );
    //     return redirect()->back()->with('info', 'запрос добавления в друзья подтверждён!');
    // }
    public function getAdd($username)
    {
        $user = User::where('username', $username)->first();
        if (!$user) {
            return redirect()
                ->route('home')
                ->with('info', 'Юзверь не найден!');
        }
        // запрент на добавление самого себя в друзья
        if (Auth::user()->id === $user->id) {
            return redirect()->route('home');
        }

        if (
            Auth::user()->hasFriendRequestPending($user) ||
            $user->hasFriendRequestPending(Auth::user())
        ) {
            return redirect()
                ->route('profile.index', ['username' => $user->username])
                ->with('info', 'Пользователю отправлен запрос в друзья');
        }
        if (Auth::user()->isFriendWith($user)) {
            return redirect()
                ->route('profile.index', ['username' => $user->username])
                ->with('info', 'Пользователь уже в друзьях!');
        }
        Auth::user()->addFriend($user);
        return redirect()
            ->route('profile.index', ['username' => $username])
            ->with('info', 'Пользователю отправлен запрос в друзья');
    }
    public function getAccept($username)
    {
        $user = User::where('username', $username)->first();
        if (!$user) {
            return redirect()
                ->route('home')
                ->with('info', 'Юзверь не найден!');
        }

        if (!Auth::user()->hasFriendRequestReceived($user)) {
            return redirect()->route('home');
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect()
            ->route('profile.index', ['username' => $username])
            ->with('info', 'Запрос в друзья олдобрен !');
    }

    public function postDelete($username)
    {
        $user = User::where('username', $username)->first();
        if (!Auth::user()->isFriendWith($user)) {
            return redirect()->back();
        }
        Auth::user()->DeleteFriend($user);
        return redirect()->back()->with('info', 'удален из друзей');
    }
}
