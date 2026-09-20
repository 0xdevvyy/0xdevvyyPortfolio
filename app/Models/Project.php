<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;


    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo {
            return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<Tag, $this>
     */
    public function tags(): HasMany {
        return $this->hasMany(Tag::class);
    }


    /**
     * @return HasMany<Screenshot, $this>
     */
    public function screenshots(): HasMany {
        return $this->hasMany(Screenshot::class);
    }
}
