<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 20.45
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'is_completed',
        'completed_at',
        'due',
        'urgency',
        'assignee_id',
        'task_id',
        'last_update_by',
    ];

    protected $primaryKey = 'id';
}