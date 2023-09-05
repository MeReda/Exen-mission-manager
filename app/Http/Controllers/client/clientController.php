<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Group;
use App\Models\Mission;
use App\Models\Mission_request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

use PDF;

class clientController extends Controller
{
    public function index()
    {
        // get users mission begin with latest
        $missions = auth()->user()->missions()->latest()->get();

        // get mission requests
        $mission_requests = auth()->user()->mission_requests()->latest()->get();

        // get all users
        $users = User::all();

        return view('client.index', [
            'missions' => $missions,
            'mission_requests' => $mission_requests,
            'users' => $users
        ]);
    }

    public function show($id)
    {
        // get mission by id
        $mission = auth()->user()->missions()->findOrFail($id);

        return view('client.show', ['mission' => $mission]);
    }

    public function storeExpense(Request $request)
    {
        // validate request
        $this->validate(request(), [
            'mission_id' => 'required|integer',
            'category' => 'required|string',
            'amount' => 'required|integer',
            'description' => 'required|string',
            'receipt' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // get mission by id
        $mission = auth()->user()->missions()->findOrFail($request->mission_id);

        // prepare receipt image
        $receiptName = date('Y-m-d') . '-' . Str::uuid() . '.' . $request->receipt->extension();
        $receipt = Image::make($request->receipt);
        $receipt->stream();

        // store in storage
        Storage::disk('images')->put('receipts/' . $receiptName, $receipt);

        // create expense
        $expense = Expense::create([
            'mission_id' => $mission->id,
            'category' => $request->category,
            'amount' => $request->amount,
            'description' => $request->description,
            'receipt_image' => 'receipts/' . $receiptName,
        ]);

        $expense->save();


        // show success alert
        Alert::toast('Expense created successfully', 'success');

        // redirect to mission
        return redirect()->route('client.show', ['id' => $mission->id]);
    }

    /**
     * Print reimbursement request
     */
    public function printReimbursement($id)
    {
        $mission = Mission::find($id);

        // Get logged in user
        $admin = auth()->user();

        $data = [
            'date' => date('d/m/Y'),
            'mission' => $mission,
            'admin' => $admin
        ];

        $pdf = PDF::loadView('client.printReimbursementRequest', $data);

        return $pdf->stream('reimbursement.pdf');
    }

    public function settings()
    {
        $user = auth()->user();
        $groups = Group::all();

        return view('client.settings', ['user' => $user, 'groups' => $groups]);
    }

    public function updateInfo(Request $request)
    {
        // validate request
        $this->validate(request(), [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'CIN' => 'required|string',
            'email' => 'required|email',
            'profile' => 'required|string',
            'group_id' => 'required|integer',
        ]);

        // get user by id
        $user = auth()->user();

        // update user
        $user->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'CIN' => $request->CIN,
            'email' => $request->email,
            'profile' => $request->profile,
            'group_id' => $request->group_id,
        ]);

        // show success alert
        Alert::toast('User updated successfully', 'success');

        // redirect to settings
        return redirect()->route('client.settings');
    }

    public function updatePassword(Request $request)
    {
        // validate request
        $this->validate(request(), [
            'newPassword' => 'required|string|min:8',
        ]);

        // get user by id
        $user = auth()->user();

        // update user
        $user->update([
            'password' => bcrypt($request->newPassword),
        ]);

        // show success alert
        Alert::toast('Password updated successfully', 'success');

        // redirect to settings
        return redirect()->route('client.settings');
    }

    public function destroyExpense($id)
    {
        // get expense by id
        $expense = Expense::findOrFail($id);

        // delete expense
        $expense->delete();

        // show success alert
        Alert::toast('Expense deleted successfully', 'success');

        // redirect to mission
        return redirect()->route('client.show', ['id' => $expense->mission->id]);
    }

    public function showMissionRequest($id)
    {
        // get mission request by id
        $mission_request = Mission_request::findOrFail($id);

        // get all users
        $users = User::all();

        return view('client.showMissionRequest', ['mission_request' => $mission_request, 'users' => $users]);
    }

    public function storeMissionRequest(Request $request)
    {
        // validate request
        $this->validate(request(), [
            'name' => 'required|string',
            'object' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'date' => 'required|date',
            'end_date' => 'required|date',
            'place' => 'required|string',
            'companion' => 'nullable|string',
        ]);

        // get user by id
        $user = auth()->user();

        // create mission request
        $mission = Mission_request::create([
            'name' => $request->name,
            'object' => $request->object,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'date' => $request->date,
            'end_date' => $request->end_date,
            'place' => $request->place,
            'companion' => $request->companion,
            'user_id' => $user->id,
        ]);

        $mission->save();

        // show success alert
        Alert::toast('Mission created successfully', 'success');

        // redirect to missions
        return redirect()->route('client.index');
    }

    public function updateMissionRequest(Request $request, $id)
    {
        // validate request
        $this->validate(request(), [
            'name' => 'required|string',
            'object' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'date' => 'required|date',
            'end_date' => 'required|date',
            'place' => 'required|string',
            'companion' => 'nullable|string',
        ]);

        // get mission request by id
        $mission_request = Mission_request::findOrFail($id);

        // update mission request
        $mission_request->update([
            'name' => $request->name,
            'object' => $request->object,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'date' => $request->date,
            'end_date' => $request->end_date,
            'place' => $request->place,
            'companion' => $request->companion,
        ]);

        // show success alert
        Alert::toast('Mission updated successfully', 'success');

        // redirect to mission request
        return redirect()->route('client.showMissionRequest', ['id' => $id]);
    }

    public function destroyMissionRequest($id)
    {
        // get mission request by id
        $mission_request = Mission_request::findOrFail($id);

        // delete mission request
        $mission_request->delete();

        // show success alert
        Alert::toast('Mission deleted successfully', 'success');

        // redirect to missions
        return redirect()->route('client.index');
    }
}
