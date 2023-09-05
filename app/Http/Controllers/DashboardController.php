<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Models\Mission;
use App\Models\Mission_request;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get count of groups, users, missions, soft deleted missions, mission requests
        $groups = Group::count();
        $users = User::count();
        $missions = Mission::count();
        $deleted_missions = Mission::onlyTrashed()->count();
        $mission_requests_count = Mission_request::where('status', 'pending')->count();

        // Get logged in user
        $admin = auth()->user();

        return view('dashboard.index', [
            'groups' => $groups,
            'users' => $users,
            'missions' => $missions,
            'deleted_missions' => $deleted_missions,
            'mission_requests_count' => $mission_requests_count,
            'admin' => $admin,
            'active' => 'dashboard'
        ]);
    }
}
