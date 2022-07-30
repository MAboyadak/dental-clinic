<?php

namespace App\Http\Controllers;

use App\Tooth;
use App\Patient;
use App\Appointment;
use Illuminate\Http\Request;

class TeethController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::with('teeth')->orderBy('id', 'desc')->paginate(10);
        // dd($patients);
        return view('teeth.index')->with('patients', $patients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $patient = Patient::find($id);
        // dd($patient);
        return view('teeth.create')->with('patient', $patient);
    }
    
    public function teeth($id){
        $patient = Patient::find($id);
        if($patient->teeth()->exists()){
            $teeth = $patient->teeth;
            return $teeth;
        }
        return 'false';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // return($request);
        $request->validate([
            'teethObjects' => 'required',
        ]);

        $patientId = $request->patientId; // patient id

        $teethContainer = $request->teethObjects;
        // var_dump($teethContainer);
        
        foreach ($teethContainer as $toothArr) {
            try{
            // var_dump($toothArr);
            // echo'space';
            $tooth = new Tooth();
            if($toothArr['tooth_id'])$tooth->tooth_id = $toothArr['tooth_id'];
            if(isset($toothArr['left']))$tooth->left = $toothArr['left'];
            if(isset($toothArr['top']))$tooth->top = $toothArr['top'];
            if(isset($toothArr['right']))$tooth->right = $toothArr['right'];
            if(isset($toothArr['bottom']))$tooth->bottom = $toothArr['bottom'];
            if(isset($toothArr['condition']))$tooth->condition = $toothArr['condition'];
            if(isset($toothArr['details']))$tooth->details = $toothArr['details'];
            if(isset($toothArr['description']))$tooth->description = $toothArr['description'];


            $tooth->patient_id = $patientId;
            // // $tooth->appointment_details_id = $appointmentDetails->id;
            $tooth->save();
            $request->session()->flash('success', 'تم تعديل الاسنان بنجاح !');
            }catch(\Exception $e){
                // echo $e->getMessage();   // insert query
                $request->session()->flash('error', $e->getMessage());
            }
        }

        $app = new Appointment();
        $app = $app->where('patient_id','=',$patientId)->latest()->first();
        $app->work = $request->work;
        $app->problem = $request->problem;
        $app->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $patient = Patient::find($id);
    //     return view('teeth.show')->with('patient', $patient);
    // }
    
    public function destroy($id)
    {
        //
    }
}
