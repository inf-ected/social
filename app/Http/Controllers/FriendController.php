<?php

namespace App\Http\Controllers;
use Auth;
//use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{

public function getIndex(){
    $friends= Auth::user()->friends();
    $requests=Auth::user()->friendsRequests();
    // dd($friends);
    return view('friends.index')->with(compact('friends','requests'));
}



}
