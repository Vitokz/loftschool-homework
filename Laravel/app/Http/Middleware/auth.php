<?php
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class auth extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function check($request)
    {
        $user=\Illuminate\Support\Facades\Auth::user();
        if ($user->admin == 1) {
            return route('admin');
        } else {
            return route('login');
        }

    }
}
