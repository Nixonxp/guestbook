<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $admin = false;

        if (\Auth::check()) {
            $admin = \Auth::user()->isAdmin();
        }

        if (!$admin) {
            session()->flash('warning', 'У вас недостаточно прав для просмотра страницы');
            return redirect()->route('index');
        }
        return $next($request);
    }
}
