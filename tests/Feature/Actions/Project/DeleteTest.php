<?php

use App\Models\Project;
use App\Models\User;

it('allows the project owner to delete their project', function (): void {
    $user = User::factory()->create();
    $project = Project::factory()->for($user)->create();

    $response = $this->actingAs($user)->delete(route('auth.project.delete', $project));

    $response->assertRedirect(route('auth.project.index'));
    $this->assertDatabaseMissing('projects', ['id' => $project->id]);
});

it('does not allow another user to delete the project', function (): void {
    $owner = User::factory()->create();
    $anotherUser = User::factory()->create();
    $project = Project::factory()->for($owner)->create();

    $response = $this->actingAs($anotherUser)->delete(route('auth.project.delete', $project));

    $response->assertNotFound();
    $this->assertDatabaseHas('projects', ['id' => $project->id]);
});

it('does not allow guests to delete a project', function (): void {
    $user = User::factory()->create();
    $project = Project::factory()->for($user)->create();

    $response = $this->delete(route('auth.project.delete', $project));

    $response->assertNotFound();
    $this->assertDatabaseHas('projects', ['id' => $project->id]);
});
