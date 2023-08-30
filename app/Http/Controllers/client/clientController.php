<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

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
            'amount' => 'required|integer',
            'description' => 'required|string',
            'receipt' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // get mission by id
        $mission = auth()->user()->missions()->findOrFail(request('mission_id'));

        // create expense
        $mission->expenses()->create([
            'amount' => request('amount'),
            'description' => request('description'),
            'receipt' => request('receipt') ? request('receipt')->store('receipts', 'public') : null,
        ]);

        // show success alert
        Alert::toast('Expense deleted successfully', 'success');

        // redirect to mission
        return redirect()->route('client.show', ['id' => $mission->id]);
    }
}
