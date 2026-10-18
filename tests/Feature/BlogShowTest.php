<?php

use App\Models\Blog;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('a published blog can be read by slug', function (): void {
    $blog = Blog::factory()->for(User::factory())->published()->create([
        'title' => 'A readable post',
        'slug' => 'a-readable-post',
        'description' => 'The full post content.',
        'excerpt' => 'A short introduction.',
    ]);

    $this->get(route('blog.show', $blog->slug))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('blog/Show')
            ->where('blog.title', 'A readable post')
            ->where('blog.description', 'The full post content.'));
});

test('unpublished blogs cannot be read publicly', function (): void {
    $blog = Blog::factory()->for(User::factory())->create([
        'slug' => 'draft-post',
        'is_published' => false,
    ]);

    $this->get(route('blog.show', $blog->slug))
        ->assertNotFound();
});
