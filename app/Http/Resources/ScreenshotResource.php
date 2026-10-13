<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Screenshot;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin Screenshot
 */
class ScreenshotResource extends JsonResource
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
            'screenshotPath' => asset(Storage::url($this->screenshot_path)),
        ];
    }
}
