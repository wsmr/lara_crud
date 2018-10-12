<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class status
 * @package App\Models
 * @version October 12, 2018, 3:09 pm UTC
 *
 * @property string name
 * @property integer active
 */
class status extends Model
{
    use SoftDeletes;

    public $table = 'statuses';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'active' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'active' => 'required'
    ];

    
}
