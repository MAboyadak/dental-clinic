<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Tooth;
use App\File;
use App\Prescription;


class DetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patient_id)
    {
        return view('appointment_details.create')->with('patient_id',$patient_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $appointment_id)
    {

        $request->validate([
            'teethObjects' => 'required',
            'description' => 'nullable'
        ]);

        $appointment = Appointment::find($appointment_id); // get appointment
        
        $patientId = $appointment->patient->id; // patient id
        
        
        
        try{
            $appointmentDetails = new AppointmentDetails();
        
            $appointmentDetails->description = $request->description;
            
            $appointmentDetails->appointment_id = $appointment_id;
            $appointmentDetails->save();
            // echo $appointmentDetails;
        }catch(\Exception $e){
            echo $e->getMessage();   // insert query

        }

        $teethArr = $request->teethObjects;
        // var_dump($teethArr);
        foreach ($teethArr as $toothObj) {
            try{
            // var_dump($toothObj);
            // echo'space';
            $tooth = new Tooth();
            if($toothObj['id'])$tooth->id = $toothObj['id'];
            if(isset($toothObj['left']))$tooth->left = $toothObj['left'];
            if(isset($toothObj['top']))$tooth->top = $toothObj['top'];
            if(isset($toothObj['right']))$tooth->right = $toothObj['right'];
            if(isset($toothObj['bottom']))$tooth->bottom = $toothObj['bottom'];
            if(isset($toothObj['condition']))$tooth->condition = $toothObj['condition'];
            if(isset($toothObj['detail']))$tooth->details = $toothObj['details'];

            $tooth->patient_id = $patientId;
            $tooth->appointment_details_id = $appointmentDetails->id;
            $tooth->save();
            }catch(\Exception $e){
            echo $e->getMessage();   // insert query
            $request->session()->flash('error', 'Task error!');
            }
        }
        $request->session()->flash('success', 'Task was successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($appointment_id, $id)
    {
        // return view('appointment_details.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($appointment_id, $id)
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
    public function update($appointment_id, Request $request,  $id)
    {
        //
    }
}
