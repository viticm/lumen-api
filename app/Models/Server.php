<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'host_name', 'inner_ip', 'net_ip'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
