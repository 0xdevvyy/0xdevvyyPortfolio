<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('logins the user', function (): void {
    $user = User::factory()->create([
        'email' => 'test@gmail.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post(route('login.store'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect((route('dashboard')));
    $this->actingAs($user);

});

it('logs out the authenticated user and invalidates their session', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('auth.logout'));

    $response->assertRedirect(route('home'));
    $this->assertGuest();
});
