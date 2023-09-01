<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Group;
use App\Models\Mission;
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
        // ger users mission begin with latest
        $missions = auth()->user()->missions()->latest()->get();

        return view('client.index', ['missions' => $missions]);
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
}
