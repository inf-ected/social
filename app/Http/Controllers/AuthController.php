<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//подключаем модель юзера
use App\Models\User;
//подключаем авторизацию
use Auth;
// use Illuminate\Auth;
// use Illuminate\Facades\Auth;

class AuthController extends Controller
{
    public function getSignup()
    {
        return view('auth.signup');
    }
    public function postSignup(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|max:255',
            'username' => 'required|unique:users|alpha_dash|max:255',
            'password' => 'required|min:6'
        ]);
        User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password'))
        ]);
        return redirect()
            ->route('home')
            ->with('info', 'Вы успешно зарегестрировались!');
    }
    public function getSignin()
    {
        return view('auth.signin');
    }
    public function postSignin(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'email' => 'required|max:255',
            'password' => 'required|min:6'
        ]);
        if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
            return redirect()->back()->with('info', 'неправильный логин или пароль!');
        }
        return redirect()->route('home')->with('info', 'вы вошли!');
    }
}
