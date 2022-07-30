<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;

class ProgramsController extends Controller
{
    public function store(Request $request){
        $program = new Program(); 
        $program->title = $request->title;;
        $program->cost = $request->cost; 
        $program->problem = $request->problem;
        $program->patient_id = $request->patientId;
    
        if($program->save()){
            return redirect()->back()->with('success','تمت الاضافة بنجاح');
        }
    
    }

    public function update(Request $request){
        // return $request;
        $program = Program::find($request->program_id); 
        $program->title = $request->title;;
        $program->cost = $request->cost; 
        $program->problem = $request->problem;
        // $program->patient_id = $request->patientId;
    
        if($program->save()){
            return redirect()->back()->with('success','تم التعديل بنجاح');
        }
    
    }

    public function getProgram(Request $request){
        $program = Program::find($request->id);
        return $program;
    }
}