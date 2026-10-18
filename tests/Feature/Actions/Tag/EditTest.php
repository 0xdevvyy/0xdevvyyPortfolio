<?php

use App\Models\Tag;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('allows an authenticated user to view the edit tag page', function (): void {
    $user = User::factory()->create();
    $tag = Tag::factory()->create();

    $this->actingAs($user)
        ->get(route('auth.tag.edit', $tag))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('tag/Edit')
            ->has('tag')
            ->where('tag.id', $tag->id)
            ->where('tag.name', $tag->name)
        );
});

it('allows an authenticated user to update a tag', function (): void {
    $user = User::factory()->create();
    $tag = Tag::factory()->create();

    $this->actingAs($user)
        ->put(route('auth.tag.update', $tag), [
            'name' => 'Laravel',
        ])
        ->assertRedirect(route('auth.tag.index'));

    $tag->refresh();

    expect($tag->name)->toBe('Laravel');
});

it('requires authentication to update a tag', function (): void {
    $tag = Tag::factory()->create();

    $this->put(route('auth.tag.update', $tag), [
        'name' => 'Laravel',
    ])->assertNotFound();

    $this->assertDatabaseHas('tags', [
        'id' => $tag->id,
        'name' => $tag->name,
    ]);
});

it('requires a tag name with at least four characters', function (): void {
    $user = User::factory()->create();
    $tag = Tag::factory()->create();

    $this->actingAs($user)
        ->put(route('auth.tag.update', $tag), [
            'name' => 'Lar',
        ])
        ->assertSessionHasErrors('name');

    $this->assertDatabaseHas('tags', [
        'id' => $tag->id,
        'name' => $tag->name,
    ]);
});

it('requires a tag name to be at most twenty-five characters', function (): void {
    $user = User::factory()->create();
    $tag = Tag::factory()->create();

    $this->actingAs($user)
        ->put(route('auth.tag.update', $tag), [
            'name' => str_repeat('a', 26),
        ])
        ->assertSessionHasErrors('name');

    $this->assertDatabaseHas('tags', [
        'id' => $tag->id,
        'name' => $tag->name,
    ]);
});
