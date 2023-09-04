<?php

namespace App\Http\Controllers;

use App\Models\Mission_request;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MissionRequestController extends Controller
{
    public function index()
    {
        // get pending mission requests count
        $mission_requests_count = Mission_request::where('status', 'pending')->count();

        // get all mission requests reversed
        $mission_requests = Mission_request::all()->reverse();

        // get logged in user
        $admin = auth()->user();

        return view('dashboard.mission_requests.index', [
            'mission_requests' => $mission_requests,
            'mission_requests_count' => $mission_requests_count,
            'admin' => $admin,
            'active' => 'request'
        ]);
    }

    public function reject($id)
    {
        $mission_request = Mission_request::find($id);

        // update mission request status to rejected
        $mission_request->update([
            'status' => 'rejected'
        ]);

        // Show Sweet Alert toast
        Alert::toast('Mission request rejected successfully', 'success');

        // redirect to mission requests page
        return redirect()->route('dashboard.mission.requests');
    }
}
