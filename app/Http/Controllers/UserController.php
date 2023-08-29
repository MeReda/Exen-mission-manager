<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use PDF;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show users with pagination reversed
        $users = User::orderBy('id', 'desc')->paginate(10);

        $groups = Group::all();

        // Get logged in user
        $admin = auth()->user();

        // add SweetAlert delete confirmation
        $title = 'Delete User';
        $text = 'Are you sure you want to delete this user?';
        confirmDelete($title, $text);

        return view('dashboard.user.index', ['active' => 'user', 'groups' => $groups, 'users' => $users, 'admin' => $admin]);
    }

    public function printAll()
    {
        $users = User::all();

        $data = [
            'date' => date('d/m/Y'),
            'users' => $users
        ];

        $pdf = PDF::loadView('dashboard.user.print', $data);

        return $pdf->stream('users.pdf');
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
        // validate the data
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'CIN' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'profile' => 'required',
            'group_id' => 'required|exists:groups,id'
        ]);

        // store the data
        $user = new User;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->CIN = $request->CIN;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->profile = $request->profile;
        $user->group_id = $request->group_id;
        $user->save();

        Alert::toast('User created successfully', 'success');

        return redirect()->route('dashboard.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate the data
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'CIN' => 'unique:users,CIN,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        // store the data if putted
        $user = User::find($id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        if (isset($request->CIN)) {
            $user->CIN = $request->CIN;
        }
        $user->email = $request->email;
        if (isset($request->profile)) {
            $user->profile = $request->profile;
        }
        if (isset($request->group_id)) {
            $user->group_id = $request->group_id;
        }
        $user->save();

        Alert::toast('User updated successfully', 'success');

        return redirect()->route('dashboard.user.index');
    }

    /**
     * Change Password
     */
    public function changePassword(Request $request, $id)
    {
        // validate the data
        $request->validate([
            'password' => 'required|min:8',
        ]);

        // store the data
        $user = User::find($id);
        $user->password = bcrypt($request->passwords); // I've named passwords because of an unknown error
        $user->save();

        Alert::toast('Password changed successfully', 'success');

        return redirect()->route('dashboard.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User  $user)
    {
        $user->delete();

        Alert::toast('User deleted successfully', 'success');

        return redirect()->route('dashboard.user.index');
    }
}
