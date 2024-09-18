<?php

use Database\Factories\UserFactory;

use function Pest\Laravel\postJson;

it("can log in with existing user", function () {

    $user = UserFactory::new()->create();
    $response = postJson('/api/auth/login', [
        'email' => $user->email,
        'password' => 'password'
    ]);

    $response->assertOk()
        ->assertJson([
            'data' => [
                'email' => $user->email,
                'name' => $user->name,
            ]
        ]);
});

it('cannot login with invalid credentials', function () {

    $response = postJson(
        '/api/auth/login',
        [
            'email' => 'air@example.com',
            'password' => 'password'
        ]
    );

    $response->assertUnauthorized()->assertJson(['message' => 'Invalid credentials']);

});