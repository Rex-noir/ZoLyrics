<?php

namespace App\Actions\Authentication;

use App\Models\User;
use Hash;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateUser
{
    use AsAction;
    /**
     * Create a new class instance.
     */
    public function handle(array $data): User
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }
}
