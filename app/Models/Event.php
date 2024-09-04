<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $guarded = [];

    protected function casts()
    {
        return [
            'date' => 'datetime',
        ];
    }

    public function streamers(): BelongsToMany
    {
        return $this->belongsToMany(Streamer::class);
    }
}
