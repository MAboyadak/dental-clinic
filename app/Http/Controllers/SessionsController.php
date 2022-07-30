<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Program;
use App\Patient;
use App\payment;
use App\Appointment;
use App\Prescription;
use App\Medicine;
use App\Note;
use App\Tooth;
use App\File;

class SessionsController extends TeethController
{
    private $file = '';

    public function Create($id)
    {
        $program = Program::where('id','=',$id)->first();
        $patient = Patient::where('id','=',$program->patient_id)->first();
        $sessions = Session::where('program_id','=',$id)->with('payment')->get();

        foreach ($sessions as $session) {
            // $session->wanted = $session->payment->wanted ;
            // dd($session->payment);
            $session->paid = $session->payment['paid'];
            // $session->remained = ;
        }
        // dd($program);
        // return 'a7a '. $sessions;
        return view('sessions.create',compact('patient','program','sessions'));
    }

    public function storeFile($request)
    {
        // $this->file = $request->input('file');
        // dd($this->file);
    }

    public function storeSessionDetails(Request $request)
    {
        $session = new Session();
        // return $request;
        // return $teethObjects[1]['tooth_id'];
        // foreach ($request->teethObjects as $toothArr) {
        //     return $toothArr;
        // }

        $sessionCount = Session::where('program_id','=',$request->program_id)->get()->count() +1;

        if(!$request->cost || empty($request->cost)){
            $session->cost = 0;    
        }else{
            $session->cost = $request->cost;    
        }
        $session->work = $request->work;
        $session->title = "جلسه $sessionCount";
        $session->program_id = $request->program_id;

        $appId = Appointment::where('patient_id', '=', $request->patient_id)->latest()->first()->id;        
        $session->appointment_id = $appId;

        // return $session;


        if($session->save()){
            $theApp = Appointment::find($appId);
            $theApp->done = 1;
            $theApp->save();

            $prescId = $this->savePrescription($request,$session->id);
            $this->saveTeeth($request,$session->id);
            $this->saveSessionDetails($request,$session->id);

            $request->session()->flash('success', 'تم اضافة السيشن بنجاح!');

            // return json_decode($request->teethObjects,true);
            return $prescId;
        }else{
            return;
        }
        // return $session->id;
        // return response()->json($session->save(),200);
        
        
        // return ;

        // $app = new Appointment();
        // $app = $app->where('patient_id','=',$request->patient_id)->latest()->first();
        // $app->save();
    }

    private function savePrescription($request,$id){
        $medicines = $request->medicines;
        if(!$medicines){
            // return $request->session()->flash('error', "عذرا انت لم تضف اي ادوية للرشوته");
            // return redirect()->back()->with('error','عذرا انت لم تضف اي ادوية للروشتة');
            return;
        }
        $days = $request->days;
        $repeats = $request->repeats;
        $instructions = $request->instructions;


        $Prescription = new Prescription();
        $Prescription->patient_id = $request->patient_id;
        $Prescription->session_id = $id;
        // $Prescription->problem = $request->problem;
        // $Prescription->work = $request->work;
        // return $Prescription;
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
        return $Prescription->id;
    }

    private function saveTeeth($request, $id){

        $teethContainer = json_decode($request->teethObjects,true);
        // if($teethContainer){
            // return $teethContainer;
        // }
        foreach ($teethContainer as $toothArr) {
            try{
            
            // return($toothArr['tooth_id']);
            // echo'space';
            $tooth = new Tooth();
            if($toothArr['tooth_id'])$tooth->name = $toothArr['tooth_id'];
            if(isset($toothArr['left']))$tooth->left = $toothArr['left'];
            if(isset($toothArr['top']))$tooth->top = $toothArr['top'];
            if(isset($toothArr['right']))$tooth->right = $toothArr['right'];
            if(isset($toothArr['bottom']))$tooth->bottom = $toothArr['bottom'];
            if(isset($toothArr['center']))$tooth->center = $toothArr['center'];
            if(isset($toothArr['condition']))$tooth->condition = $toothArr['condition'];
            if(isset($toothArr['details']))$tooth->details = $toothArr['details'];
            if(isset($toothArr['description']))$tooth->description = $toothArr['description'];

            $tooth->patient_id = $request->patient_id;
            $tooth->session_id = $id;
            // return $tooth;

            $tooth->save();
            // $request->session()->flash('success', 'تم تعديل الاسنان بنجاح !');
            }catch(\Exception $e){
            //     // echo $e->getMessage();   // insert q uery
            //     // $request->session()->flash('error', $e->getMessage());
                return response()->json('a7a',200);
            }
        }

        // return response()->json('a7ten success',200);

    }

    private function saveSessionDetails($request,$id){
        if($request->note){
            $note = new Note();
            $note->note = $request->note;
            $note->patient_id = $request->patient_id;
            $note->session_id = $id;
            $note->save();    
        }

        $file = new File();
        if(isset($request->file)){
            $path = $request->file('file')->store('uploaded-images','public');
            // return $path;
            $file->patient_id = $request->patient_id;
            $file->session_id = $id;
            $file->name = $path;
            $file->save();
            // $file->type = "ss";
            // $file->details = "ss";
            // dd($path);
            // return $file;
            // return redirect()->route('patients.show',$id)->with('success','تم اضافه الملف بنجاح');
        }


        if($request->day){
            $appointment = new Appointment();
            $appointment->day = $request->day;
            $hour = date('H:i');

            if($request->hour){
                $hour = $request->hour;
            }
            $appointment->hour = $hour;
            $appointment->patient_id = $request->patient_id;
            $appointment->save();
        }
    }

    public function show($id)
    {
        $session = Session::find($id);
        $patientId = $session->program->patient->id;
        $programId = $session->program->id;
        $patient = Patient::find($patientId)->with('appointments')->first();
        $program = Program::find($programId);
        $presc = Prescription::where('session_id','=',$session->id)->with('medicines')->first();
        $nextApp = $patient->appointments()->latest()->first();
        // dd($nextApp);
        return view('sessions.show',compact('session','patient','program','presc','nextApp'));
    }

}
