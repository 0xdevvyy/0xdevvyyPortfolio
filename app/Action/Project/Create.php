<?php

declare(strict_types=1);

namespace App\Action\Project;

use App\Action\Screenshot\Create as ScreenshotCreate;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

final readonly class Create
{
    public function __construct(
        public ScreenshotCreate $createScreenshots,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public function handle(array $data, User $user): Project
    {
        return DB::transaction(function () use ($data, $user): Project {
            $thumbnail = $data['thumbnail_path'];

            $thumbnailPath = $thumbnail instanceof UploadedFile
                ? $thumbnail->store('thumbnails', 'public')
                : null;

            $attr = Arr::except($data, ['screenshots', 'thumbnail_path', 'tags']);

            $project = $user->projects()->create([
                ...$attr,
                'thumbnail_path' => $thumbnailPath,
                'published_at' => 'now',
            ]);

            $this->createScreenshots->create(
                $data['screenshots'] ?? [],
                $project,
            );

            return $project;
        });
    }
}
