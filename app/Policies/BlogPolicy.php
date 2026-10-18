<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogPolicy
{
    public function workWith(User $user, Blog $blog): Response
    {
        return $blog->user->is($user) ? Response::allow() : Response::denyWithStatus(404);
    }
}
