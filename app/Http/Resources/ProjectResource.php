<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Project
 */
class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            // 'userId' => $this->user_id,
            'title' => $this->title,
            'slug' => $this->slug,  // i can create a path in the model..
            'thumbnailPath' => $this->thumbnail_path,
            'description' => $this->description,
            'excerpt' => $this->excerpt,
            'features' => $this->features,
            'isPublished' => (bool) $this->is_published,
            'publishedAt' => $this->published_at,
            'screenshots' => ScreenshotResource::collection($this->whenLoaded('screenshots')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
