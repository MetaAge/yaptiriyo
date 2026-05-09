<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array<int, string>
     */
    protected $except = [
        'admin/general-settings/*',  // Your admin settings routes
        'admin/update-v2',            // V2 update page
        'update/v2/*',                // All V2 update API endpoints
    ];
}
