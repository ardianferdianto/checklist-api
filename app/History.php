<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 20.47
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loggable_type',
        'loggable_id',
        'action',
        'kwuid',
        'value'
    ];

    protected $primaryKey = 'id';

    protected $table = "history";
}