<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Role;
use App\Models\Route;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * The open paths.
     *
     * @var array
     */
    protected $openPaths = [
        'user/info', 'user/logout', 'routelist', 'roles'
    ];


    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            return response()->json(
                ['message' => 'Please signin first.', 'code' => 401]);
        }

        $path = $request->path();
        $checkPath = substr($path, strpos($path, '/') + 1);

        Log::info('checkPath: '.$checkPath);
        if (!in_array($checkPath, $this->openPaths)) {
           // Check the path promise.
        }

        return $next($request);
    }
}
