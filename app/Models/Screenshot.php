<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ScreenshotFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Screenshot extends Model
{
    /** @use HasFactory<ScreenshotFactory> */
    use HasFactory;

    /**
     * @return BelongsToMany<Project, $this>
     */
    public function project(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }
}
