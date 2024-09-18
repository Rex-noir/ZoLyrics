<?php

namespace App\Actions\Authentication;

use Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginUser
{
    use AsAction;

    public function handle(array $data)
    {

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $data['remember'] ?? false)) {
            session()->regenerate();
            return Auth::user();
        }

        return null;
    }
}
