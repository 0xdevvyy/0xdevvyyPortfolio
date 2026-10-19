<?php

use App\Action\Settings\UpdateProfile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('allows an authenticated user to update their email address', function (): void {
    $user = User::factory()->create([
        'email' => 'old@example.com',
    ]);

    $response = $this->actingAs($user)->put(route('auth.settings.update'), [
        'email' => 'new@example.com',
    ]);

    $response->assertRedirect(route('auth.settings.index'));
    expect($user->fresh()->email)->toBe('new@example.com');
});

it('rejects an incorrect current password without changing account settings', function (): void {
    $user = User::factory()->create([
        'email' => 'old@example.com',
        'password' => 'old-password',
    ]);

    $response = $this->actingAs($user)->put(route('auth.settings.update'), [
        'email' => 'new@example.com',
        'current_password' => 'incorrect-password',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertSessionHasErrors('current_password');
    expect($user->fresh()->email)->toBe('old@example.com');
    expect(Hash::check('old-password', $user->fresh()->password))->toBeTrue();
});

it('allows an authenticated user to update their password', function (): void {
    $user = User::factory()->create([
        'password' => 'old-password',
    ]);

    $response = $this->actingAs($user)->put(route('auth.settings.update'), [
        'email' => $user->email,
        'current_password' => 'old-password',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertRedirect(route('auth.settings.index'));
    expect(Hash::check('new-password', $user->fresh()->password))->toBeTrue();
});

it('rejects a new password that matches the current password', function (): void {
    $user = User::factory()->create([
        'password' => 'old-password',
    ]);

    $response = $this->actingAs($user)->put(route('auth.settings.update'), [
        'email' => $user->email,
        'current_password' => 'old-password',
        'password' => 'old-password',
        'password_confirmation' => 'old-password',
    ]);

    $response->assertSessionHasErrors('password');
    expect(Hash::check('old-password', $user->fresh()->password))->toBeTrue();
});

it('does not replace the stored password when the action receives the same password', function (): void {
    $user = User::factory()->create([
        'password' => 'old-password',
    ]);
    $storedPassword = $user->password;

    app(UpdateProfile::class)->update(
        ['email' => 'new@example.com'],
        'old-password',
        $user,
    );

    expect($user->fresh()->password)->toBe($storedPassword);
});
