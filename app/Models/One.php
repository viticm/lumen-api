<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class One extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sex', 'tel', 'description', 'age', 'height', 'weight'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
