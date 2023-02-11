<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        

          if($request->is('Admin/login'))
        {
            return redirect()->route('admin-login-form');
        }
        if($request->is('Admin/adminpanel'))
        {
            return route('admin-login-form');
        }

         if($request->is('Admin/*'))
        {
            return route('admin-login-form');
        }

          if($request->is('Admin/*'))
        {
            return route('admin-login-form');
        
       }

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
