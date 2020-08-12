<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerOpt extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'host_name', 'inner_ip', 'net_ip', 'server_id', 'port'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
