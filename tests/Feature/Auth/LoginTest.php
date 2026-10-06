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
