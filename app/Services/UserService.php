<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function registration(array $data) : User
    {
        $user = User::create([
            'login' => $data['login'],
            'password' => Hash::make($data['password'])
        ]);

        return $user;
    }

    public function auth(array $data)
    {
        $user = User::where('login', $data['login'])->first();

        if (!$user || !\Hash::check($data['password'], $user->password)) {
            \Session::flash('error', 'Неверный логин или пароль');
            return redirect()->back();
        }

        return $user;
    }
}
