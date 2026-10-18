<?php

declare(strict_types=1);

namespace App\Action\Blog;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use function Illuminate\Support\now;

final readonly class Store
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function store(array $data, User $user): Blog
    {
        return DB::transaction(fn (): Blog => $user->blogs()->create([...$data, 'published_at' => now()]));
    }
}
