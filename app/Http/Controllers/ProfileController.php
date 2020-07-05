<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    //

    public function getProfile($username)
    {
        $user = User::where('username', $username)->first();

        // dd($user);
        if (!$user) {
            abort(404);
        }
        $statuses= $user->statuses()->notReply()->get();
        $authUserIsFriend=Auth::user()->isFriendWith($user);

        return view('profile.index', compact('user','statuses','authUserIsFriend'));
    }

    public function getEdit()
    {
        //return"hello";
        return view('profile.edit');
    }
    public function postEdit(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'alpha|max:50',
            'last_name' => 'alpha|max:50',
            'location' => 'alpha|max:50'
        ]);
        Auth::user()->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'location' => $request->input('location'),
        ]);
        return redirect()->route('profile.edit')->with('info','профиль обновлен!');
    }



}
