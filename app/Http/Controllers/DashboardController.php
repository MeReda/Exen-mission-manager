<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Models\Mission;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get count of groups, users, missions, soft deleted missions
        $groups = Group::count();
        $users = User::count();
        $missions = Mission::count();
        $deleted_missions = Mission::onlyTrashed()->count();

        // Get logged in user
        $admin = auth()->user();

        return view('dashboard.index', [
            'groups' => $groups,
            'users' => $users,
            'missions' => $missions,
            'deleted_missions' => $deleted_missions,
            'admin' => $admin,
            'active' => 'dashboard'
        ]);
    }
}
