<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//подключаем модель юзера
use App\Models\User;
class AuthController extends Controller
{
    public function getSignup(){
        return view('auth.signup');
    }
    public function postSignup(Request $request){
        $this->validate($request,[
            'email'=>'required|unique:users|max:255',
            'username'=>'required|unique:users|alpha_dash|max:255',
            'password'=>'required|min:6'
        ]);
        User::create([
            'email'=>$request->input('email'),
            'username'=>$request->input('username'),
            'password'=>bcrypt($request->input('password'))
        ]);
        return redirect()
        ->route('home')
        ->with('info','Вы успешно зарегестрировались!');
    }

}
