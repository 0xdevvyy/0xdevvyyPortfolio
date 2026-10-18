<?php

declare(strict_types=1);

namespace App\Action\Project;

use App\Action\Screenshot\Store;
use App\Models\Project;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

final readonly class Update
{
    public function __construct(public Store $createScreenshots) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(array $data, Project $project): void
    {

        DB::transaction(function () use ($data, $project): void {
            if ($data['thumbnail_path'] ?? null) {
                if ($project->thumbnail_path) {
                    Storage::disk('public')->delete($project->thumbnail_path);
                }

                $data['thumbnail_path'] = $data['thumbnail_path']->store('thumbnail', 'public');
            } else {
                unset($data['thumbnail_path']);
            }

            $attr = Arr::except($data, ['tags', 'screenshots']);

            $project->update($attr);
            $project->tags()->sync($data['tags'] ?? []);

            $this->createScreenshots->create($data['screenshots'] ?? [], $project);
        });

    }
}
