<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = ['project_id', 'user_id', 'title', 'description', 'completed'];

    /**
     * Zadanie należy do projektu
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Zadanie należy do użytkownika
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
