<?php

declare(strict_types=1);

namespace App\Action\Blog;

use App\Models\Blog;

final readonly class Delete
{
    public function destroy(Blog $blog): void
    {
        $blog->delete();
    }
}
