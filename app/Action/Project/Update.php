<?php

declare(strict_types=1);

namespace App\Action\Project;

use App\Action\Screenshot\Create;
use App\Models\Project;
use Illuminate\Support\Arr;

class Update
{
    public function __construct(public Create $createScreenshots) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(array $data, Project $project): void
    {
        // dd($data['screenshots']);
        $attr = Arr::except($data, ['tags', 'screenshots']);

        // dd(...$data['tags']);
        $project->update([...$attr]);
        $project->tags()->sync([...$data['tags']]);

        // foreach($data['screenshots'] as $screenshot){
        //     $imagePath = $screenshot->screenshots()->store('projectScreenshots', 'public');

        // }

        $this->createScreenshots->create($data['screenshots'], $project);

        // will create an action where i can pass the data of screenshot and also the project
        // so i can $project->screenshots()->create([])
    }
}
