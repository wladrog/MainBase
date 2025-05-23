<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    // Masowe przypisywanie (opcjonalne, ale przydatne)
    protected $fillable = ['name', 'description'];

    /**
     * Relacja: projekt ma wiele zadań
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
