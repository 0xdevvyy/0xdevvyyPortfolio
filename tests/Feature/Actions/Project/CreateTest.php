<?php

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('creates a project with its screenshots for an authenticated user', function (): void {
    Storage::fake('public');

    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('auth.project.store'), [
        'title' => 'Example project',
        'slug' => 'example-project',
        'description' => 'A project description.',
        'excerpt' => 'A project excerpt.',
        'features' => ['A project feature.'],
        'thumbnail_path' => UploadedFile::fake()->image('thumbnail.png'),
        'screenshots' => [
            UploadedFile::fake()->image('screenshot.png'),
        ],
        'is_published' => true,
    ]);

    $response->assertRedirect(route('auth.project.index'));

    $project = Project::query()->where('slug', 'example-project')->firstOrFail();

    expect($project->user_id)->toBe($user->id)
        ->and($project->screenshots)->toHaveCount(1);

    Storage::disk('public')->assertExists($project->thumbnail_path);
    Storage::disk('public')->assertExists($project->screenshots->first()->screenshot_path);
});

it('does not allow guests to create a project', function (): void {
    Storage::fake('public');

    $response = $this->post(route('auth.project.store'), [
        'title' => 'Example project',
        'slug' => 'example-project',
        'description' => 'A project description.',
        'excerpt' => 'A project excerpt.',
        'features' => ['A project feature.'],
        'thumbnail_path' => UploadedFile::fake()->image('thumbnail.png'),
        'screenshots' => [
            UploadedFile::fake()->image('screenshot.png'),
        ],
        'is_published' => true,
    ]);

    $response->assertNotFound();
    $this->assertDatabaseCount('projects', 0);
});
