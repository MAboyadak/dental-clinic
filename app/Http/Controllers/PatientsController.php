<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Program;
use App\Appointment;
use App\File;


class PatientsController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Africa/Cairo");
        $this->middleware('auth');
    }
    
    public function index()
    {
        $patients = Patient::orderBy('id','desc')->paginate(10);
        return view('patients.index')->with('patients',$patients);
    }

    public function create()
    {
        return view('patients.create');
    }
    
    public function store(Request $request)
    {        
        // dd($request->number);
        $request->validate([
            'name' => 'required',
            'age' => 'numeric|nullable',
            'city' => 'nullable',
            'number' => 'numeric|nullable',
            'day' => 'date|nullable',
            'hour' => 'nullable',
            'file' => 'nullable',
            'job' => 'nullable',
        ]);

        // return gettype($request->hour);
        if(empty($request->day)){$request->day = date('Y-m-d');}
        if(empty($request->hour)){$request->hour = date('H:i');}

        $patient = new Patient();
        $patient->name = $request->input('name');
        $patient->age = $request->input('age');
        $patient->city = $request->input('city');
        $patient->number = $request->input('number');
        $patient->job = $request->input('job');
        // $name = time().'_'. $request->file('file')->getClientOriginalName();
        if(isset($request->file)){
            $path = $request->file('file')->store('patient-images','public');
            $patient->image = $path;
        }
        $patient->save();

        $appointment = new Appointment();
        $appointment->day = $request->day;
        $appointment->hour = date('H:i',strtotime($request->hour));
        $appointment->patient_id = $patient->id;

        if($appointment->save()){
            return redirect()->route('home')->with('success', 'تمت الاضافة بنجاح');
        }
        return redirect()->route('home')->with('error', 'يوجد مشكلة !!');

    }

    public function show($id)
    {
        $is_admin = Auth()->user()->is_admin;
        // dd($is_admin);
        // $patient = Patient::find($id)->with(['payments','programs'])->first();
        $patient = Patient::find($id);
        // dd($patient);
        if(!$patient)abort(403,'For new System or maintainance call me @ 01010568214 , 01222471879 :: Eng. Mohamed Aboayadak');
        $medicalinfo = $patient->medicalinfo;
        $teeth = $patient->teeth;

        $files = File::where('patient_id',$id)->orderBy('created_at','desc')->get();
        if(!$files)return 'error files';
        $prescriptions = $patient->prescriptions()->orderBy('created_at','desc')->get();;
        foreach ($prescriptions as $key => $value) {
            $value['day'] = $prescriptions[$key]->created_at->toDateString();
            $value['hour'] = $prescriptions[$key]->created_at->format('H:i');
        }
        // dd($prescriptions);
        $appointments = $patient->appointments()->orderBy('created_at','desc')->paginate(8);
        $notes = $patient->notes()->orderBy('created_at','desc')->get();
        $payments = $patient->payments()->orderBy('created_at','desc')->paginate(8);
        // dd($payments);
        if(!$payments) return 'error payments';
        foreach ($payments as $key => $value) {
            $payments[$key]->day = $payments[$key]->created_at->toDateString();
            $payments[$key]->hour = $payments[$key]->created_at->format('H:i');
        }
        
        return view('patients.show',compact('patient','medicalinfo','teeth','files','prescriptions','appointments','notes','payments','is_admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $current_patient = Patient::find($id);
        date_default_timezone_set("Africa/Cairo");
        return view('patients.edit')->with('current_patient', $current_patient);
    }

    public function patient(Request $request){
        $patient = Patient::find($request->id);
        // if($patient->medicalInfo()->exists()){
        //     $medicalInfo = $patient->MedicalInfo;
        //     return $medicalInfo;
        // }
        // return 'false';
        return $patient;
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $patient = Patient::find($request->patientId);
        $patient->name = $request->name;
        $patient->age = $request->age;
        $patient->city = $request->city;
        $patient->number = $request->number;
        $patient->job = $request->job;

        if(isset($request->file)){
            $path = $request->file('file')->store('patient-images','public');
            $patient->image = $path;
        }
        // dd(Auth()->user());

        $patient->save();
        if(Auth()->user()->is_admin)
        {
            return redirect()->route('patients.show',$request->patientId)->with('success', 'تم التعديل بنجاح');
        }else{
            return redirect()->route('home')->with('success', 'تم التعديل');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // return ($request);
        Patient::delete($request->id);
        // return redirect()->route('patients.index')->with('success', 'Patient deleted successfully !!');
    }
}
