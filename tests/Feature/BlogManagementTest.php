<?php

use App\Models\Blog;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

it('shows all blogs belonging to the authenticated user', function (): void {
    $user = User::factory()->create();
    $publishedBlog = Blog::factory()->for($user)->published()->create([
        'created_at' => now(),
    ]);
    $draftBlog = Blog::factory()->for($user)->create([
        'is_published' => false,
        'created_at' => now()->subDay(),
    ]);
    Blog::factory()->for(User::factory())->create();

    $this->actingAs($user)
        ->get(route('auth.blog.index'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('blog/Index')
            ->has('blogs', 2)
            ->where('blogs.0.id', $publishedBlog->id)
            ->where('blogs.1.id', $draftBlog->id));
});

it('creates a blog for the authenticated user', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('auth.blog.create'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('blog/Create'));

    $this->actingAs($user)
        ->post(route('auth.blog.store'), [
            'title' => 'A useful blog post',
            'slug' => 'a-useful-blog-post',
            'description' => 'The complete post content.',
            'excerpt' => 'A quick introduction.',
            'is_published' => false,
            'published_at' => null,
        ])
        ->assertRedirect(route('auth.blog.index'));

    $this->assertDatabaseHas('blogs', [
        'user_id' => $user->id,
        'slug' => 'a-useful-blog-post',
        'is_published' => false,
    ]);
});

it('allows the blog owner to edit and delete a blog', function (): void {
    $user = User::factory()->create();
    $blog = Blog::factory()->for($user)->create();

    $this->actingAs($user)
        ->get(route('auth.blog.edit', $blog))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('blog/Edit')
            ->where('blog.id', $blog->id));

    $this->actingAs($user)
        ->put(route('auth.blog.update', $blog), [
            'title' => 'An updated blog title',
            'slug' => $blog->slug,
            'description' => 'Updated post content.',
            'excerpt' => 'An updated introduction.',
            'is_published' => true,
            'published_at' => now()->toDateString(),
        ])
        ->assertRedirect(route('auth.blog.index'));

    $this->assertDatabaseHas('blogs', [
        'id' => $blog->id,
        'title' => 'An updated blog title',
    ]);

    $this->delete(route('auth.blog.delete', $blog))
        ->assertRedirect(route('auth.blog.index'));

    $this->assertDatabaseMissing('blogs', [
        'id' => $blog->id,
    ]);
});

it('does not allow another user to manage a blog', function (): void {
    $owner = User::factory()->create();
    $anotherUser = User::factory()->create();
    $blog = Blog::factory()->for($owner)->create();

    $this->actingAs($anotherUser)
        ->get(route('auth.blog.edit', $blog))
        ->assertNotFound();

    $this->actingAs($anotherUser)
        ->delete(route('auth.blog.delete', $blog))
        ->assertNotFound();

    $this->assertDatabaseHas('blogs', [
        'id' => $blog->id,
        'user_id' => $owner->id,
    ]);
});

it('does not allow guests to open the blog manager', function (): void {
    $this->get(route('auth.blog.index'))->assertNotFound();
});
