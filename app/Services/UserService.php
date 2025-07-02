<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
    }

    public function login(array $data): array
    {
        $user = User::where('user_name', $data['user_name'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            Auth::login($user);
            return ['success' => true, 'user' => $user];
        }

        return ['success' => false, 'error' => __('messages.auth_failed')];
    }
}