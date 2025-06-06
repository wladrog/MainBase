<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['project_name', 'description'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
