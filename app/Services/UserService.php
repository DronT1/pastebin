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
}
