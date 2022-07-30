<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Note;

class NotesController extends Controller
{
    // public function add()
    // {
    //     $patients = Patient::orderBy('id', 'desc')->get();
    //     return view('payments.create')->with('patients',$patients);;
    // }
    public function store(Request $request,$id)
    {
        $note = new Note();
        $note->patient_id = $id;
        $note->note = $request->note;
        $note->save();
        return redirect()->route('patients.show',$id)->with('success', 'تمت الاضافة بنجاح');
    }
    public function destroy($id)
    {
        
        $note = Note::find($id);
        // dd($note);
        $patientId = $note->patient->id;
        $note->delete();
        return redirect()->route('patients.show',$patientId)->with('success', 'تم المسح بنجاح');
    }
}
