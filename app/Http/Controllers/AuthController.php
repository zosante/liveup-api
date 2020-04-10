<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|min:2|max:60',
        ]);

        $validated['token'] = $this->getRandomToken();

        $user = $this->create($validated);

        return response()->json([
            'user' => $user,
            'token' => $validated['token']
        ]);
    }

    public function login(Request $request)
    {
        $validated = $this->validate($request, [
            'email' => 'email|exists:users,email',
            'password' => 'required|min:2|max:60',
        ], ['*' => 'email or password is invalid']);

        $user = User::where('email', $validated['email'])
            ->firstOrFail();

        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'error' => 'email or password is invalid'
            ]);
        }

        return response()->json([
            'user' => $user,
            'token' => $this->updateUserToken($user)
        ]);
    }

    protected function updateUserToken(User $user)
    {
        $token = $this->getRandomToken();

        $user->forceFill([
            'api_token' => $this->generateHashed($token),
        ])->save();

        return $token;
    }

    protected function getRandomToken()
    {
        return Str::random(60);
    }

    protected function generateHashed(string $token): string
    {
        return hash('sha256', $token);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => $this->generateHashed($data['token']),
        ]);
    }
}
