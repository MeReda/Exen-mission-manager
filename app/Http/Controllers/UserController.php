<?php

namespace App\Http\Controllers;

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
        $users = User::paginate(10);

        // add SweetAlert delete confirmation
        $title = 'Delete User';
        $text = 'Are you sure you want to delete this user?';
        confirmDelete($title, $text);

        return view('dashboard.user.index', ['active' => 'user', 'users' => $users]);
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
            'CIN' => 'required|unique:users,CIN,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'profile' => 'required',
            'group_id' => 'required|exists:groups,id'
        ]);

        // store the data
        $user = User::find($id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->CIN = $request->CIN;
        $user->email = $request->email;
        $user->profile = $request->profile;
        $user->group_id = $request->group_id;
        $user->save();

        Alert::toast('User updated successfully', 'success');

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
