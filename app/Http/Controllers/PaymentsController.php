<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\payment;
use App\Patient;

class PaymentsController extends Controller
{
    // public function all()
    // {
    //     $users = User::all();
    //     return view('payments.all',compact('users'));
    // }
    public function add()
    {
        $patients = Patient::orderBy('id', 'desc')->get();
        return view('payments.create')->with('patients',$patients);;
    }
    public function store(Request $request)
    {
        $request->validate([
            'wanted' => 'numeric|nullable',
            'paid' => 'required',
        ]);

        $payment = new payment();
        $payment->patient_id = $request->selectedPatient;
        $payment->wanted = $request->wanted;
        $payment->paid = $request->paid;
        $payment->save();
        return redirect()->route('patients.show',$request->selectedPatient)->with('success', 'تم اضافه الدفع بنجاح');
    }
}
