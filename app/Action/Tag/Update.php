<?php

declare(strict_types=1);

namespace App\Action\Tag;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;

final readonly class Update
{
    /**
     * @param  array<string>  $data
     */
    public function update(array $data, Tag $tag): Tag
    {
        DB::transaction(fn () => $tag->update($data));

        return $tag;
    }
}
