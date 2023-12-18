<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Manager;
use App\Models\Alias;
use Illuminate\Database\Eloquent\Builder;

class Fund extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'manager_id', 'started_at'];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class);
    }

    public function alias(): HasMany
    {
        return $this->hasMany(Alias::class);
    }

    public function scopeDuplicated(Builder $query, array $payload)
    {
        $query->where('manager_id', $payload['manager_id'])->where(function ($query) use ($payload) {
            $query->where('name', $payload['name'])->orWhereHas('alias', function ($query) use ($payload) {
                $query->where('name', $payload['name']);
            });
        });
    }
}
