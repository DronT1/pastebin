<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register()
    {
        return \view('auth.register');
    }

    public function registration(Request $request)
    {
        // dd($request->all());
//        $user = User::create([
//            'login' => $request->get('login'),
//            'password' => Hash::make($request->get('password'))
//        ]);
        $data = $request->validate([
            'login' => ['required', 'unique:users', 'max:20'],
            'password' => ['required', 'confirmed']
        ]);
        $user = $this->userService->registration($data);
        \Auth::login($user);
        return to_route('home');
    }

    public function login()
    {
        return \view('auth.login');
    }

    public function auth(Request $request)
    {
//        $user = User::where('login', $this->request->get('login'))->first();
//
//        if (!$user || !\Hash::check($this->request->get('password'), $user->password)) {
//            \Session::flash('error', 'Неверный логин или пароль');
//            return redirect()->back();
//        }
        $data = $request->all();
        $user = $this->userService->auth($data);
//        dd($user);
//        \Auth::login($user);
        return to_route('home');
    }

    public function logout()
    {
        \Auth::logout();
        return to_route('home');
    }
}
