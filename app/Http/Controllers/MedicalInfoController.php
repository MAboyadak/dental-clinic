<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MedicalInfo;
use App\Patient;

class MedicalInfoController extends Controller
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
        return view('medical_info.index')->with('patients', $patients);
    }

    public function edit($id)
    {
        $patient = Patient::find($id);
        $medInfo = $patient->medicalInfo;
        // dd($medInfo);
        return view('medical_info.edit',compact('patient','medInfo'));
    }


    public function medicalInfo($id){
        $patient = Patient::find($id);
        if($patient->medicalInfo()->exists()){
            $medicalInfo = $patient->MedicalInfo;
            return $medicalInfo;
        }
        return 'false';
    }


    public function store(Request $request,$patient_id)
    {
        $patient = Patient::find($patient_id);
        if($patient->medicalInfo()->exists()){
            return $this->update($request, $patient_id);
        }
        // $MedicalInfo = App\Flight::updateOrCreate(
        //     ['departure' => 'Oakland', 'destination' => 'San Diego'],
        //     ['price' => 99, 'discounted' => 1]
        // );
        $MedicalInfo = new MedicalInfo();
        $MedicalInfo->blood_pressure        = $request->blood_pressure;
        $MedicalInfo->diabetes              = $request->diabetes;
        $MedicalInfo->diabetes_details      = $request->diabetes_details;
        $MedicalInfo->heart                 = $request->heart;
        $MedicalInfo->sensitivity           = $request->sensitivity;
        $MedicalInfo->sensitivity_details   = $request->sensitivity_details;
        $MedicalInfo->other                 = $request->other;
        $MedicalInfo->other_details         = $request->other_details;
        $MedicalInfo->pregnant              = $request->pregnant;
        $MedicalInfo->pregnant_details      = $request->pregnant_details;
        $MedicalInfo->breast_feeding        = $request->breast_feeding;
        $MedicalInfo->patient_id            = $patient_id;
        $MedicalInfo->save();

        return redirect()->route('patients.show', $patient_id)->with('success','Medical Info created successfully');
    }


    public function update($request, $id)
    {
        // $patient = Patient::find($id);
        // $MedicalInfo = MedicalInfo::find($patient->medicalInfo->id);
        $MedicalInfo = MedicalInfo::where('patient_id',$id)->first();

        $MedicalInfo->blood_pressure        = $request->blood_pressure;
        $MedicalInfo->diabetes              = $request->diabetes;
        $MedicalInfo->diabetes_details      = $request->diabetes_details;
        $MedicalInfo->heart                 = $request->heart;
        $MedicalInfo->sensitivity           = $request->sensitivity;
        $MedicalInfo->sensitivity_details   = $request->sensitivity_details;
        $MedicalInfo->other                 = $request->other;
        $MedicalInfo->other_details         = $request->other_details;
        $MedicalInfo->pregnant              = $request->pregnant;
        $MedicalInfo->pregnant_details      = $request->pregnant_details;
        $MedicalInfo->breast_feeding        = $request->breast_feeding;

        $MedicalInfo->save();
        return redirect()->route('patients.show', $id)->with('success','Medical Info updated successfully');

        // if(isset($request->blood_pressure) && $request->blood_pressure == true){$MedicalInfo->blood_pressure = $request->blood_pressure;}
        // if(isset($request->diabetes) && $request->diabetes == true){$MedicalInfo->diabetes = $request->diabetes;}
        // if(isset($request->diabetes_details) && !empty($request->diabetes_details)){$MedicalInfo->diabetes_details = $request->diabetes_details;}
        // if(isset($request->heart) && $request->heart == true){$MedicalInfo->heart = $request->heart;}
        // if(isset($request->sensitivity) && $request->sensitivity == true){$MedicalInfo->sensitivity = $request->sensitivity;}
        // if(isset($request->sensitivity_details) && !empty($request->sensitivity_details)){$MedicalInfo->sensitivity_details = $request->sensitivity_details;}
        // if(isset($request->other) && $request->other == true){$MedicalInfo->other = $request->other;}
        // if(isset($request->other_details) && !empty($request->other_details)){$MedicalInfo->other_details = $request->other_details;}
        // if(isset($request->pregnant) && $request->pregnant == true){$MedicalInfo->pregnant = $request->pregnant;}
        // if(isset($request->pregnant_details) && !empty($request->pregnant_details)){$MedicalInfo->pregnant_details = $request->pregnant_details;}
        // if(isset($request->breast_feeding) && $request->breast_feeding == true){$MedicalInfo->breast_feeding = $request->breast_feeding;}

        // $MedicalInfo->patient_id = $id;
    }
}
