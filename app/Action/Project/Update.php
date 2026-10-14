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

        // dd($data);
        // do i still need to wrap it up in DB:transaction?
        $thumbnailPath = $data['thumbnail_path']?->store('thumbnail', 'public') ?? $project->thumbnail_path;

        $attr = Arr::except($data, ['tags', 'screenshots', 'thumbnail_path']);

        $project->update([...$attr, 'thumbnail_path' => $thumbnailPath]);
        $project->tags()->sync($data['tags'] ?? []);

        $this->createScreenshots->create($data['screenshots'] ?? [], $project);

    }
}
