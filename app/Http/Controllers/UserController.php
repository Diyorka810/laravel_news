<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;

class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('user.register');
    }

    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        Auth::login($user);
        return redirect()->route('userPost.index');
    }

    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(LoginUserRequest $request)
    {
        $data = $request->validated();

        $user = User::where('user_name', $data['user_name'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('userPost.index');
        }

        return redirect()->back()->withErrors(['login' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('userPost.index');
    }
}
