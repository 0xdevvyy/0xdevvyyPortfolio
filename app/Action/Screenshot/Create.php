<?php

declare(strict_types=1);

namespace App\Action\Screenshot;

use App\Models\Project;
use Illuminate\Support\Facades\DB;

class Create
{
    /**
     * @param  array<string, mixed>  $screenshots
     */
    public function create(array $screenshots, Project $project): void
    {
        // dd($screenshots);

        DB::transaction(function () use ($screenshots, $project): void {
            foreach ($screenshots as $screenshot) {
                $path = $screenshot->store('screenshots', 'public');

                $project->screenshots()->create([
                    'screenshot_path' => $path,
                ]);
            }
        });
    }
}
