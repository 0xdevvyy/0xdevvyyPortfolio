<?php

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('allows the project owner to update their project and add a screenshot', function (): void {
    Storage::fake('public');

    $user = User::factory()->create();
    $project = Project::factory()->for($user)->create();

    $response = $this->actingAs($user)->put(route('auth.project.update', $project), [
        'title' => 'Updated project title',
        'slug' => $project->slug,
        'description' => 'An updated project description.',
        'excerpt' => 'An updated project excerpt.',
        'features' => ['An updated feature.'],
        'is_published' => true,
        'published_at' => now()->toDateTimeString(),
        'screenshots' => [
            UploadedFile::fake()->image('screenshot.png'),
        ],
    ]);

    $response->assertRedirect(route('auth.project.edit', $project->slug));

    $project->refresh();

    expect($project->title)->toBe('Updated project title')
        ->and($project->screenshots)->toHaveCount(1);

    Storage::disk('public')->assertExists($project->screenshots->first()->screenshot_path);
});

it('does not allow another user to update the project', function (): void {
    $owner = User::factory()->create();
    $anotherUser = User::factory()->create();
    $project = Project::factory()->for($owner)->create();

    $response = $this->actingAs($anotherUser)->put(route('auth.project.update', $project), [
        'title' => 'Updated project title',
        'slug' => $project->slug,
        'description' => 'An updated project description.',
        'excerpt' => 'An updated project excerpt.',
        'features' => ['An updated feature.'],
        'is_published' => true,
        'published_at' => now()->toDateTimeString(),
    ]);

    $response->assertNotFound();
    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'title' => $project->title,
    ]);
});

it('does not allow guests to update a project', function (): void {
    $user = User::factory()->create();
    $project = Project::factory()->for($user)->create();

    $response = $this->put(route('auth.project.update', $project), [
        'title' => 'Updated project title',
        'slug' => $project->slug,
        'description' => 'An updated project description.',
        'excerpt' => 'An updated project excerpt.',
        'features' => ['An updated feature.'],
        'is_published' => true,
        'published_at' => now()->toDateTimeString(),
    ]);

    $response->assertNotFound();
    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'title' => $project->title,
    ]);
});
