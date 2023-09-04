<?php

namespace App\Http\Controllers;

use App\Models\Mission_request;
use Illuminate\Http\Request;

class MissionRequestController extends Controller
{
    public function index()
    {
        // get pending mission requests count
        $mission_requests_count = Mission_request::where('status', 'pending')->count();

        // get all mission requests
        $mission_requests = Mission_request::all();

        // get logged in user
        $admin = auth()->user();

        return view('dashboard.mission_requests.index', [
            'mission_requests' => $mission_requests,
            'mission_requests_count' => $mission_requests_count,
            'admin' => $admin,
            'active' => 'request'
        ]);
    }
}
