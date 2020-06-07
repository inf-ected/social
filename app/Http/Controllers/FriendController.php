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
    // dd($friends);
    return view('friends.index')->with('friends',$friends);
}



}
