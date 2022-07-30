<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Prescription;
use App\Medicine;
use App\payment;
use App\Appointment;

class PrescriptionsController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Africa/Cairo");
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prescriptions = Prescription::orderBy('created_at', 'desc')->get();
        return view('prescriptions.index')->with('prescriptions', $prescriptions);
    }

    public function patientIndex($id)
    {
        $prescriptions = Prescription::where('patient_id', $id)
               ->orderBy('created_at', 'desc')
               ->get();
        // $count = sizeof($prescriptions);
        $patient = Patient::find($id);

        return view('prescriptions.patient_index', compact('prescriptions','patient'));
    }


    /**
     * 
     */
    public function create($id)
    {
        $patient = Patient::find($id);
        return view('prescriptions.create')->with('patient',$patient);
    }

    public function store(Request $request, $id)
    {
        // dd($request);
        // $patient = Patient::find($request->selectedPatient);
        // echo $patient->id;
        $medicines = $request->medicines;
        if(!$medicines){
            return redirect()->back()->with('error','عذرا انت لم تضف اي ادوية للروشتة');
        }
        $days = $request->days;
        $repeats = $request->repeats;
        $instructions = $request->instructions;


        $Prescription = new Prescription();
        $Prescription->patient_id = $id;
        // $Prescription->problem = $request->problem;
        // $Prescription->work = $request->work;
        $Prescription->save();
        foreach ($medicines as $key => $medicine) {

            $Medicine = new Medicine();
            
            $Medicine->name = $medicine;
            $Medicine->days = $days[$key];
            $Medicine->repeats = $repeats[$key];
            $Medicine->instructions = $instructions[$key];
            $Medicine->prescription_id = $Prescription->id;

            $Medicine->save();
        }

        // $payment = new payment();
        // $payment->patient_id = $id;
        // $payment->wanted = $request->wanted;
        // $payment->paid = $request->paid;
        // $payment->save();

        // if($request->day){
        //     $appointment = new Appointment();
        //     $appointment->day = $request->day;
        //     $appointment->hour = $request->hour;
        //     $appointment->patient_id = $id;
        //     $appointment->save();
        // }

        return redirect()->route('prescriptions.show', $Prescription->id)->with('success','تم اضافة الروشته بنجاح');
    }

    /**
     * 
     */
    // public function new()
    // {
    //     $patients = Patient::orderBy('id', 'desc')->get();
    //     return view('prescriptions.new')->with('patients',$patients);
    // }

    // public function newStore(Request $request)
    // {
    //     $medicines = $request->medicines;
    //     $days = $request->days;
    //     $repeats = $request->repeats;
    //     $instructions = $request->instructions;

    //     $Prescription = new Prescription();
    //     $Prescription->patient_id = $request->selectedPatient;
    //     $Prescription->problem = $request->problem;
    //     $Prescription->save();

    //     foreach ($medicines as $key => $medicine) {

    //         $Medicine = new Medicine();
            
    //         $Medicine->name = $medicine;
    //         $Medicine->days = $days[$key];
    //         $Medicine->repeats = $repeats[$key];
    //         $Medicine->instructions = $instructions[$key];
    //         $Medicine->prescription_id = $Prescription->id;

    //         $Medicine->save();
    //     }
    //     $payment = new payment();
    //     $payment->wanted = $request->wanted;
    //     $payment->paid = $request->paid;
    //     $payment->patient_id = $request->selectedPatient;
    //     $payment->save();

        
    //     return redirect()->route('patient.prescriptions', $Prescription->patient_id)->with('success','Prescription created successfully');
    // }
    
    /**
     * 
     */

    
    public function Prescription(Request $request)
    {
        $key = $request->key;
        $prescription = Prescription::find($key);
        // dd($prescription);
        $response['medicines'] = $prescription->medicines;
        $response['problem'] = $prescription->problem;
        $response['id'] = $prescription->id;
        $response['patient'] = $prescription->patient_id;


        return $response;

        // return $prescription;
    }

    public function update(Request $request)
    {
        $key = $request->key;
        $prescription = Prescription::find($key);
        $id = $prescription->patient->id;
        $prescription->delete();

        if(!isset($request->medicines)){
            return redirect()->route('patient.prescriptions', $id)->with('success','Prescription deleted successfully');
        }
        
        $medicines = $request->medicines;
        $days = $request->days;
        $repeats = $request->repeats;
        $instructions = $request->instructions;
        
        $Prescription = new Prescription();
        $Prescription->patient_id = $id;
        $Prescription->problem = $request->problem;
        $Prescription->save();

        foreach ($medicines as $key => $medicine) {

            $Medicine = new Medicine();
            
            $Medicine->name = $medicine;
            $Medicine->days = $days[$key];
            $Medicine->repeats = $repeats[$key];
            $Medicine->instructions = $instructions[$key];
            $Medicine->prescription_id = $Prescription->id;

            $Medicine->save();
        }
        return redirect()->route('patient.prescriptions', $id)->with('success','Prescription added successfully');
    }

    public function show($id)
    {
        $prescription = Prescription::find($id);
        $prescription->day = $prescription->created_at->toDateString();
        $patient = $prescription->patient;
        $medicines = $prescription->medicines;
        return view('prescriptions.show', compact('prescription','medicines','patient') );
    }

    public function destroy($id)
    {
        $prescription = Prescription::find($id);
        $prescription->delete();
        return redirect()->route('prescriptions.index')->with('success','Prescription deleted successfully');
    }

    public function deletePresc($id)
    {
        $prescription = Prescription::find($id);
        $prescription->delete();
        return redirect()->route('patients.show',$prescription->patient->id)->with('success','Prescription deleted successfully');
    }
}
