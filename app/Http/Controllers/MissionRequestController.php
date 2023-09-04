<?php

namespace App\Http\Controllers;

use App\Models\Mission_request;
use App\Models\User;
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

        // get all users
        $users = User::all();

        // get logged in user
        $admin = auth()->user();

        return view('dashboard.mission_requests.index', [
            'mission_requests' => $mission_requests,
            'mission_requests_count' => $mission_requests_count,
            'admin' => $admin,
            'users' => $users,
            'active' => 'request'
        ]);
    }

    public function approve($id)
    {
        $mission_request = Mission_request::find($id);

        // validate mission request data
        $data = $this->validate(request(), [
            'name' => 'required|string',
            'object' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'date' => 'required|date',
            'place' => 'required|string',
            'companion' => 'nullable|string',
            'user_id' => 'required|integer',
        ]);

        // update mission request status to approved
        $mission_request->update([
            'status' => 'accepted'
        ]);

        // create mission with the same data
        $mission = $mission_request->user->missions()->create($data);
        $mission->save();

        // Show Sweet Alert toast
        Alert::toast('Mission request approved successfully', 'success');

        // redirect to mission requests page
        return redirect()->route('dashboard.mission.requests');
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
