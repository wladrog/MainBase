<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $table = 'bugs';
    protected $primaryKey = 'bug_id';
    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'description',
        'status',
        'priority',
        'reported_by_user_id',
        'assigned_to_user_id',
        'issue_link'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}