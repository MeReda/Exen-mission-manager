<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::paginate(10);

        // sweetalert confirmation
        $title = 'Delete Group!';
        $text = 'Are you sure you want to delete this group?';
        confirmDelete($title, $text);

        return view('dashboard.group.index', ['active' => 'group', 'groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate data
        $request->validate([
            'name' => 'required|unique:groups|max:255',
            'percentage' => 'required|numeric|min:0|max:100'
        ]);

        // Create new group
        $group = new Group;
        $group->name = $request->name;
        $group->percentage = $request->percentage;
        $group->save();

        // Show success toast alert
        Alert::toast('Group created successfully', 'success');

        // Redirect to group page
        return redirect()->route('dashboard.group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        // Validate data
        $request->validate([
            'name' => 'required|max:255|unique:groups,name,' . $group->id,
            'percentage' => 'required|numeric|min:0|max:100'
        ]);

        // Update group
        $group->name = $request->name;
        $group->percentage = $request->percentage;
        $group->save();

        // Show success toast alert
        Alert::toast('Group updated successfully', 'success');

        // Redirect to group page
        return redirect()->route('dashboard.group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        // check if group has any user
        if ($group->users()->count() > 0) {
            // Show error toast alert
            Alert::toast('Group cannot be deleted because it has users', 'error');

            // Redirect to group page
            return redirect()->route('dashboard.group.index');
        }

        // Delete group if it has no user
        $group->delete();

        // Show success toast alert
        Alert::toast('Group deleted successfully', 'success');

        // Redirect to group page
        return redirect()->route('dashboard.group.index');
    }
}
