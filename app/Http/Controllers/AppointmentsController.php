<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Appointment;
use App\Patient;

class AppointmentsController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Africa/Cairo");
        $this->middleware('auth');
    }
    
    public function index()
    {
        $appointments = Appointment::orderBy('id','desc')->get();
        $patients = Patient::all();

        foreach ($appointments as $key => $value) {
            $patient = Patient::find($appointments[$key]->patient_id);
            // if($patient->prescriptions()->exists())
            // {
            //     $prescriptions = $patient->prescriptions;
            //     foreach ($prescriptions as $pkey => $pvalue) {
            //         $prescriptions[$pkey]->day = $prescriptions[$pkey]->created_at->toDateString();
            //     }
            //     // $appointments[$key]['problem'] = $prescriptions->firstWhere('day','=', $appointments[$key]->day)['problem'];
            //     // $appointments[$key]['p_id'] = $prescriptions->firstWhere('day','=', $appointments[$key]->day)['id'];
            // }else{
            //     $appointments[$key]['problem'] = 'لا يوجد';
            // }

            if($patient->payments()->exists())
            {
                $payments = $patient->payments;

                foreach ($payments as $key2 => $value2) {
                    $payments[$key2]->day = $payments[$key2]->created_at->toDateString();
                    $appointments[$key]['wanted'] = $payments->where('day','=',$appointments[$key]->day)->SUM('wanted');
                    $appointments[$key]['paid'] = $payments->where('day','=',$appointments[$key]->day)->SUM('paid');
                    $appointments[$key]['remained'] = $appointments[$key]['wanted'] - $appointments[$key]['paid'];
                }
                $appointments[$key]['allWanted'] = $payments->SUM('wanted');
                $appointments[$key]['allPaid'] = $payments->SUM('paid');
                $appointments[$key]['allRemained'] = $payments->SUM('wanted') - $payments->SUM('paid');
            }else{
                $appointments[$key]['wanted'] = 0;
                $appointments[$key]['paid'] = 0;
                $appointments[$key]['remained'] = 0;

                $appointments[$key]['allWanted'] = 0;
                $appointments[$key]['allPaid'] = 0;
                $appointments[$key]['allRemained'] = 0;
            }

            
        }
                // dd($prescriptions);
        return view('appointments.index',compact('appointments','patients'));
    }

    public function create($id)
    {
        $patient = Patient::find($id);
        return view('appointments.create')->with('patient',$patient);
    }

    public function store(Request $request)
    {
        $request->validate([
            'selectedPatient' => 'required',
            'day' => 'date|nullable',
            'hour' => 'nullable',
        ]);
        if(empty($request->day)){$request->day = date('Y/m/d');}
        if(empty($request->hour)){$request->hour = date('H:i');}

        $appointment = new Appointment();
        $appointment->day = $request->day;
        $appointment->hour = $request->hour;
        $appointment->patient_id = $request->selectedPatient;

        if($appointment->save()){
            return redirect()->route('patients.show',$request->selectedPatient)->with('success', 'تم الحجز بنجاح');
        }
        return redirect()->route('patients.show',$request->selectedPatient)->with('success', 'حدث خطأ');
    }

    public function edit($id)
    {
        $appointment = Appointment::find($id);
        return view('appointments.edit')->with('appointment', $appointment);
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
        $request->validate([
            'selectedPatient' => 'required',
            'day' => 'date|nullable',
            'hour' => 'nullable',
        ]);
        if(empty($request->day)){$request->day = date('Y-m-d');}
        if(empty($request->hour)){$request->hour = date('H:i');}

        $appointment = Appointment::find($id);
        $appointment->day = $request->day;
        $appointment->hour = $request->hour;

        if($appointment->save()){
            return redirect()->route('appointments.index')->with('success', 'Appointment is updated successfully');
        }
        return redirect()->route('appointments.index')->with('error', 'Error !!');
    }

    public function destroy(Request $request)
    {
        $appointment = Appointment::find($request->id);
        $appointment->delete();
    }

    // public function search(Request $request)
    // {
    //     // return $request;
    //     $start = $request->startDate;
    //     $end = $request->endDate;
    //     $patientId = $request->id;
    //     // return($request);
    //     if(!$start){return;}
    //     if(!$end)
    //     {
    //         $searchedAppointments = Appointment::where('day','>=',$start)->where('patient_id','=',$patientId)->get();
    //     }else{
    //         $searchedAppointments = Appointment::where('day','<=',$end)
    //         ->where('day','>=',$start)
    //         ->where('patient_id','=',$patientId)
    //         ->get();
    //     }
        
    //     foreach ($searchedAppointments as $key => $app) {
    //         $patient = $app->patient;
    //         if($patient->prescriptions()->exists())
    //         {
    //             $prescriptions = $patient->prescriptions;
    //             foreach ($prescriptions as $pkey => $pvalue) {
    //                 $prescriptions[$pkey]->day = $prescriptions[$pkey]->created_at->toDateString();
    //             }
    //             // $app['problem'] = $prescriptions->firstWhere('day','=', $app->day)['problem'];
    //         }else{
    //             // $app['problem'] = 'لا يوجد';
    //         }

    //         if($patient->payments()->exists())
    //         {
    //             $payments = $patient->payments;

    //             foreach ($payments as $key2 => $value2) {
    //                 $value2->day = $value2->created_at->toDateString();
    //                 $app['wanted'] = $payments->where('day','=',$app->day)->SUM('wanted');
    //                 $app['paid'] = $payments->where('day','=',$app->day)->SUM('paid');
    //                 $app['remained'] = $app['wanted'] - $app['paid'];
    //             }
    //             $app['allWanted'] = $payments->SUM('wanted');
    //             $app['allPaid'] = $payments->SUM('paid');
    //             $app['allRemained'] = $payments->SUM('wanted') - $payments->SUM('paid');
    //         }else{
    //             $app['wanted'] = 0;
    //             $app['paid'] = 0;
    //             $app['remained'] = 0;

    //             $app['allWanted'] = 0;
    //             $app['allPaid'] = 0;
    //             $app['allRemained'] = 0;
    //         }

            
    //     }
    //     return($searchedAppointments);
    //     // dd($searchedAppointments);
    // }
}
