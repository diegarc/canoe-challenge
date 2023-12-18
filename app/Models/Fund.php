<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Manager;

class Fund extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'manager_id', 'started_at'];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class);
    }
}
