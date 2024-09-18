<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it('can create user', function () {
    $response = postJson('/api/auth/register', [
        'name' => 'test',
        'email' => 'test@test.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertCreated()
        ->assertJson([
            'data' => [
                'name' => 'test',
                'email' => 'test@test.com',
            ]
        ]);
});

it('cannot create user with the same email', function () {
    User::factory()->create([
        'email' => 'existing@test.com',
    ]);

    $response = postJson('/api/auth/register', [
        'name' => 'test',
        'email' => 'existing@test.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertUnprocessable()  // Use 409 if your API returns this status code for conflicts
        ->assertJson([
            'message' => 'This email is already registered.',
        ]);
});

it("cannot create with invalid email", function () {
    $response = postJson('/api/auth/register', [
        'name' => 'test',
        'email' => 'invalid-email',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertUnprocessable()
        ->assertJson(['message' => 'The email must be a valid email address.']);
});
