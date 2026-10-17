<?php

declare(strict_types=1);

namespace App\Action\Tag;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;

final readonly class Create
{
    /**
     * @param  array<string>  $data
     */
    public function handle(array $data, Tag $tag): Tag
    {
        return DB::transaction(fn (): Tag => $tag->create($data));
    }
}
