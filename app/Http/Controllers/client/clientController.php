<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
        $receiptName = date('Y-m-d') . '.' . $request->receipt->extension();
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
}
