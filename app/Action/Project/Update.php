<?php

declare(strict_types=1);

namespace App\Action\Project;

use App\Models\Project;
use Illuminate\Support\Arr;

class Update
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function update(array $data, Project $project): void
    {
        // dd($data);
        $attr = Arr::except($data, ['tags']);

        // dd(...$data['tags']);
        $project->update([...$attr]);
        $project->tags()->sync([...$data['tags']]);

        // will create an action where i can pass the data of screenshot and also the project
        // so i can $project->screenshots()->create([])
    }
}
