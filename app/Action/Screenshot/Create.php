<?php

declare(strict_types=1);

namespace App\Action\Screenshot;

use App\Models\Project;

class Create
{
    /**
     * @param  array<string, mixed>  $array
     */
    public function create(array $array, Project $project): void
    {

        // or should i just let this one handle it?
        // return DB::transaction(function () use ($array, $project): void {
        //     $project->screenshots()->create([
        //         ...$array,
        //     ]);
        // });
    }
}
