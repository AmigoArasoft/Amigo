<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Contracts\Auth\Guard;

class Mina{
    protected $auth;

    public function __construct(Guard $auth){
        $this->auth = $auth;
    }

    public function handle($request, Closure $next){
        if ($this->auth->user()->tercero_id != 1) {
            return redirect('/');
        }
        return $next($request);
    }
}