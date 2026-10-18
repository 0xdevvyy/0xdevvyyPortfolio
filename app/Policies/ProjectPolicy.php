<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    /**
     * Determine whether the user can work with models.
     */
    public function workWith(User $user, Project $project): Response
    {
        return $project->user->is($user) ? Response::allow() : Response::denyWithStatus(404);
    }
}
