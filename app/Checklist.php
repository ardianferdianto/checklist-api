<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'object_domain', 'object_id', 'description', 'is_completed', 'due', 'urgency', 'completed_at', 'last_update_by',
    ];

    protected $primaryKey = 'id';
}
