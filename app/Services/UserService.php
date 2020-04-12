<?php

namespace App\Services;

use Illuminate\Support\Str;

class UserService
{
    public static function generateHashed(string $token): string
    {
        return hash('sha256', $token);
    }

    public static function getRandomToken()
    {
        return Str::random(60);
    }
}
