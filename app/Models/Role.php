<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Get routes from a key.
     *
     * @param string $key The key.
     *
     * @return array
     **/
    public static function routes($key)
    {
        $role = static::where('key', $key)->first();
        $r = [];
        if (! is_null($role)) {
            $r = explode(':', $role->routes);
            foreach ($r as $k => &$v) {
                $v = (int)$v;
            }
        }
        return $r;
    }

}
