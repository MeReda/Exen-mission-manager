<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ArchivedMissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archive = Mission::onlyTrashed()->paginate(10);

        // sweetalert conformation
        $title = 'Delete Mission!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('dashboard.archive', ['active' => 'archive', 'archive' => $archive]);
    }

    public function restore($id)
    {
        $mission = Mission::onlyTrashed()->where('id', $id)->first();
        $mission->restore();
        Alert::toast('Mission restored successfully', 'success');
        return redirect()->route('dashboard.archive.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mission = Mission::onlyTrashed()->where('id', $id)->first();
        $mission->forceDelete();

        Alert::toast('Mission deleted successfully', 'success');
        return redirect()->route('dashboard.archive.index');
    }
}
