<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {

        if (!auth()->user()->hasRoles($roles)) {

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Access Denied! You are not permitted to take this action.']);
            }

            session()->flash('accessDenied', 'Access Denied! You are not permitted to take this action.');
            return redirect()->back();
        }

        return $next($request);
    }
}
