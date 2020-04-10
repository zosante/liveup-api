<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $this->validate($request,[
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|min:2|max:60',
        ]);

        $user = $this->create($validated);

        return response()->json([
            'user' => Arr::except($user->toArray(), ['api_token']),
            'token' => $user->api_token,
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),
        ]);
    }
}
