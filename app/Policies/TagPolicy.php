<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TagPolicy
{
    /**
     * Determine whether the user can view any tag.
     */
    public function viewAny(?User $user): bool
    {
        return $user !== null;
    }

    /**
     * Determine whether the user can view the tag.
     */
    public function view(?User $user, Tag $tag): bool
    {
        return $user !== null && $user->id === 1; // dunno if i should add a role, pero portfolio ko lang naman e so i think that this will suffice?
    }

    /**
     * Determine whether the user can update the tag.
     */
    public function update(?User $user, Tag $tag): bool
    {
        return $user !== null && $user->id === 1;
    }

    /**
     * Determine whether the user can delete the tag.
     */
    public function delete(?User $user, Tag $tag): bool
    {
        return $user !== null && $user->id === 1;
    }

    /**
     * Determine whether the user can work with the tag.
     */
    public function workWith(User $user, Tag $tag): Response
    {
        return $user->id === 1
            ? Response::allow()
            : Response::denyWithStatus(404);
    }
}
