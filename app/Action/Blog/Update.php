<?php

declare(strict_types=1);

namespace App\Action\Blog;

use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class Update
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function update(array $data, User $user): void
    {
        DB::transaction(fn () => $user->blogs()->update([...$data, 'published_at' => now()]));
    }
}
