<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
//    public function handle($request, Closure $next, $role)
    public function handle($request, Closure $next, $adminRole, $prepAffairesRole,  $prepResidentielRole)
    {
        $roles = DB::table('roles')->pluck('name')->toArray();

        if (in_array($adminRole, $roles)) {
            return $next($request);
        } else if (in_array($prepAffairesRole, $roles)) {
            return $next($request);
        } else if (in_array($prepResidentielRole, $roles)) {
            return $next($request);
        }

        return Redirect::route('home');

//        if (! $request->user()->hasRole($role)) {
//            abort(401, 'This action is unauthorized.');
//        }
//        return $next($request);
    }
}
