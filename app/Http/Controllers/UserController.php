<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userService;

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
        $data = $request->validate([
            'login' => ['required', 'string', 'unique:users', 'max:20'],
            'password' => ['required', 'string', 'confirmed', 'max:200']
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
        $data = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        $user = $this->userService->auth($data);

        if (!$user) {
            return redirect()->back()->withErrors('Неверный логин или пароль');
        }

        \Auth::login($user);

        return to_route('home');
    }

    public function logout()
    {
        \Auth::logout();
        return to_route('home');
    }
}
