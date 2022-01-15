<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function authenticate(array $data): array
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        $remember = $data['remember'] ?? 0;

        if (Auth::attempt($credentials, $remember)) {
            return [
                'status' => 'success',
                'errors' => null
            ];
        } else {
            return [
                'status' => 'error',
                'errors' => [
                    'email' => 'The provided credentials do not match our records.',
                ]
            ];
        }
    }

    public function logout(): bool
    {
        Auth::logout();
        return true;
    }
}
