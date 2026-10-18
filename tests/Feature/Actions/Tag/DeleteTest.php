<?php

use App\Models\Tag;
use App\Models\User;

it('allows the authorized user to delete a tag', function (): void {
    $user = User::factory()->create(['id' => 1]);
    $tag = Tag::factory()->create();

    $response = $this->actingAs($user)->delete(route('auth.tag.delete', $tag));

    $response->assertRedirect(route('auth.tag.index'));
    $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
});

it('does not allow another user to delete a tag', function (): void {
    $user = User::factory()->create(['id' => 2]);
    $tag = Tag::factory()->create();

    $response = $this->actingAs($user)->delete(route('auth.tag.delete', $tag));

    $response->assertNotFound();
    $this->assertDatabaseHas('tags', ['id' => $tag->id]);
});

it('does not allow guests to delete a tag', function (): void {
    $tag = Tag::factory()->create();

    $response = $this->delete(route('auth.tag.delete', $tag));

    $response->assertNotFound();
    $this->assertDatabaseHas('tags', ['id' => $tag->id]);
});
