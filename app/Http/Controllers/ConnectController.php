<?php

namespace App\Http\Controllers;

use App\Http\Requests\postLoginRequest;
use App\Http\Requests\postRegisterRequest;
use Illuminate\Http\Request;
use Validator, Hash, Auth, Str;
use App\Models\User;


class ConnectController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['getLogout']);
    }
    public function getLogin()
    {

        return view('connect.login');
    }

    public function postLogin(postLoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) :
            return redirect('/feeds');
        else :
            return back()->with('message', 'Correo electrónico o contraseña errónea')->with('typealert', 'danger');
        endif;
    }
    public function getRegister()
    {
        return view('connect.register');
    }

    public function postRegister(postRegisterRequest $request)
    {
        $user = new User;
        $user->email = e($request->input('email'));
        $user->password = Hash::make($request->input('password'));

        if ($user->save()) :
            return redirect('/login')->with('message', 'Su usuario se creó con éxito, ahora puede iniciar sección')->with('typealert', 'success');
        endif;
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
