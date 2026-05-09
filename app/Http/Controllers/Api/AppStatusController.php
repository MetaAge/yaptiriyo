<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StaticOption;
use Illuminate\Http\Request;

class AppStatusController extends Controller
{
    public function getStatus()
    {
        $maintenance_mode = get_static_option('app_maintenance_mode') ?? 'off';
        $maintenance_message = get_static_option('app_maintenance_message') ?? 'Sistem şu anda bakımda. Lütfen daha sonra tekrar deneyiniz.';
        
        $android_version = get_static_option('app_android_version') ?? '1.0.0';
        $ios_version = get_static_option('app_ios_version') ?? '1.0.0';
        $force_update = get_static_option('app_force_update') ?? 'off';
        
        return response()->json([
            'maintenance_mode' => $maintenance_mode === 'on',
            'maintenance_message' => $maintenance_message,
            'android_version' => $android_version,
            'ios_version' => $ios_version,
            'force_update' => $force_update === 'on',
            'status' => 'success'
        ]);
    }
}
