<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ScreenshotFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screenshot extends Model
{
    /** @use HasFactory<ScreenshotFactory> */
    use HasFactory;
}
