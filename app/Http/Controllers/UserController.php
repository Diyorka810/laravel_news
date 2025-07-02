<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $users) {}


    public function showRegisterForm()
    {
        return view('user.register');
    }

    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();
        $result = $this->users->register($data);

        if ($result['success']){
            return redirect()->route('post.index');
        }

        return redirect()->back()
            ->withErrors(['register' => $result['error']])
            ->withInput();
    }

    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(LoginUserRequest $request)
    {
        $data = $request->validated();
        $result = $this->users->login($data);

        if ($result['success']){
            return redirect()->route('post.index');
        }
        
        return redirect()->back()
            ->withErrors(['login' => __('messages.auth_failed')])
            ->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('post.index');
    }
}
