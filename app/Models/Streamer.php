<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Streamer extends Model
{
    protected $guarded = [];

    protected function online(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => boolval($value),
            set: fn($value) => boolval($value),
        );
    }

    public function events(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }
}
