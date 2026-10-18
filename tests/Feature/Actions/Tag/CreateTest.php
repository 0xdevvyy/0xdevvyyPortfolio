<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('allows an authenticated user to view the create tag page', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('auth.tag.create'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('tag/Create')
        );
});

it('allows an authenticated user to create a tag', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('auth.tag.store'), [
            'name' => 'Laravel',
        ])
        ->assertRedirect(route('auth.tag.index'));

    $this->assertDatabaseHas('tags', [
        'name' => 'Laravel',
    ]);
});

it('requires authentication to create a tag', function (): void {
    $this->post(route('auth.tag.store'), [
        'name' => 'Laravel',
    ])->assertNotFound();

    $this->assertDatabaseCount('tags', 0);
});

it('requires a tag name with at least four characters', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('auth.tag.store'), [
            'name' => 'Lar',
        ])
        ->assertSessionHasErrors('name');

    $this->assertDatabaseCount('tags', 0);
});

it('requires a tag name to be at most twenty-five characters', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('auth.tag.store'), [
            'name' => str_repeat('a', 26),
        ])
        ->assertSessionHasErrors('name');

    $this->assertDatabaseCount('tags', 0);
});
