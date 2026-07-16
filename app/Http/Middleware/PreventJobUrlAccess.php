<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventJobUrlAccess
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
        // Yaptiriyo: the freelancer "job board" concept is retired. All job
        // pages permanently redirect to the homepage (301 keeps any SEO value
        // instead of dropping visitors on a 404).
        return redirect()->route('homepage', [], 301);
    }
}
