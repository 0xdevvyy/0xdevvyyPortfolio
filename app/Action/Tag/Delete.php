<?php

declare(strict_types=1);

namespace App\Action\Tag;

use App\Models\Tag;

final readonly class Delete
{
    public function destory(Tag $tag): void
    {
        $tag->delete();
    }
}
