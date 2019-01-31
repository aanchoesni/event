<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Auth;
use Alert;

class Role
{
    /**
        * Handle an incoming request.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  \Closure  $next
        *
        * @return mixed
        */
    public function __construct(Request $request)
    {
        $this->req = $request;
    }

    public function handle($request, Closure $next, $role)
    {
        if (!auth()->user()) {
            $level = 'no-access';

            Alert::error('Anda tidak boleh mengakses halaman ini', 'Error');

            return redirect('/');
        }

        $level = auth()->user()->role;

        $roles = explode('_', $role);
        $x = 0;
        foreach ($roles as $r) {
            if ($level == $r) {
                $x = 1;
            }
        }

        if ($x == 1) {
            return $next($request);
        }

        Alert::error('Anda tidak boleh mengakses halaman ini', 'Error');
        return redirect('home');
    }
}
