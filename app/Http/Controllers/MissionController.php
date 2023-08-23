<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use PDF;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $missions = Mission::paginate(10);

        // Add sweetalert confirmation
        $title = 'Delete Mission';
        $text = 'Are you sure you want to delete this mission?';
        confirmDelete($title, $text);

        return view('dashboard.mission.index', ['missions' => $missions, 'active' => 'mission']);
    }

    /**
     * Print mission details
     */
    public function printMission($id)
    {
        $mission = Mission::find($id);

        $data = [
            'date' => date('d/m/Y'),
            'mission' => $mission
        ];

        $pdf = PDF::loadView('dashboard.mission.printMission', $data);

        return $pdf->stream('mission.pdf');
    }

    /**
     * Print reimbursement request
     */
    public function printReimbursement($id)
    {
        $mission = Mission::find($id);

        $data = [
            'date' => date('d/m/Y'),
            'mission' => $mission
        ];

        $pdf = PDF::loadView('dashboard.mission.printReimbursement', $data);

        return $pdf->stream('reimbursement.pdf');
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
        // Validate the data
        $request->validate([
            'name' => 'required',
            'object' => 'required',
            'description' => 'required',
            'place' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date', // Ensure end_date is after start_date
            'date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < $request->start_date || $value > $request->end_date) {
                        $fail("The date must be between start date and end date.");
                    }
                },
            ],
            'companion' => 'required',
            'budget' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        // Store the data
        $mission = Mission::find($id);
        $mission->name = $request->name;
        $mission->object = $request->object;
        $mission->description = $request->description;
        $mission->place = $request->place;
        $mission->start_date = $request->start_date;
        $mission->end_date = $request->end_date;
        $mission->date = $request->date;
        $mission->companion = $request->companion;
        $mission->budget = $request->budget;
        $mission->user_id = $request->user_id;
        $mission->save();

        Alert::toast('Mission updated successfully', 'success');

        return redirect()->route('dashboard.mission.index');
    }

    /**
     * Update mission state to complete
     */

    public function complete($id)
    {
        $mission = Mission::find($id);
        $mission->state = 'complete';
        $mission->save();

        Alert::toast('Mission completed successfully', 'success');

        return redirect()->route('dashboard.mission.index');
    }

    /**
     * Approve mission expenses
     */
    public function approve(Request $request, $id)
    {
        $mission = Mission::find($id);

        // Validate the data
        $request->validate([
            'total_reimbursement' => 'required|numeric',
        ]);

        // Check if the total_reimbursement is less than the budget
        if ($request->total_reimbursement > $mission->budget) {
            Alert::toast('Total reimbursement must be less than the budget', 'error');

            return redirect()->route('dashboard.mission.index');
        }

        // if the total_reimbursement is less than the budget, update the mission
        $mission->state = 'approved';
        $mission->total_reimbursement = $request->total_reimbursement;
        $mission->comment = $request->comment;
        $mission->save();

        Alert::toast('Mission approved successfully', 'success');

        return redirect()->route('dashboard.mission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mission::find($id)->delete();

        Alert::toast('Mission deleted successfully', 'success');

        return redirect()->route('dashboard.mission.index');
    }
}
