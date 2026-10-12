<?php

declare(strict_types=1);

namespace App\Action\Project;

use App\Models\Project;

class Update
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function update(array $data, Project $project): void
    {
        // dd($data);

        $project->update([...$data]);

        // $attr->except->screenshot in the tag i will $project->tags()->sync()...

        // will create an action where i can pass the data of screenshot and also the project
        // so i can $project->screenshots()->create([])
    }
}
