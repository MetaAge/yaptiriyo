<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmergencyRequest;
use Illuminate\Http\Request;

class EmergencyController extends Controller
{
    public function index()
    {
        $all_emergencies = EmergencyRequest::with(['client', 'acceptedFreelancer', 'category'])->latest()->paginate(20);
        return view('backend.pages.emergency.index', compact('all_emergencies'));
    }

    public function details($id)
    {
        $emergency = EmergencyRequest::with(['client', 'acceptedFreelancer', 'category', 'offers.freelancer'])->findOrFail($id);
        return view('backend.pages.emergency.details', compact('emergency'));
    }

    public function delete($id)
    {
        EmergencyRequest::findOrFail($id)->delete();
        return redirect()->back()->with(['msg' => __('Emergency request deleted'), 'type' => 'danger']);
    }
}
