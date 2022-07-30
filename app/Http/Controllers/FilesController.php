<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\File;

class FilesController extends Controller
{

    public function index()
    {
        $patients = Patient::with('files')->orderBy('id', 'desc')->paginate(10);
        return view('files.index')->with('patients', $patients);
    }

    public function create($id)
    {
        $patient = Patient::find($id);
        return view('files.create')->with('patient',$patient);
    }

    public function store(Request $request,$id)
    {
        $file = new File();
        // $name = time().'_'. $request->file('file')->getClientOriginalName();
        if(isset($request->file)){
            $path = $request->file('file')->store('uploaded-images','public');
            // return $path;
            $file->patient_id = $id;
            $file->name = $path;
            $file->type = $request->type;
            $file->details = $request->details;
            // dd($path);
            $file->save();
            return redirect()->route('patients.show',$id)->with('success','تم اضافه الملف بنجاح');
        }
    }
    
    // public function show($id)
    // {
    //     $patient = Patient::find($id);
    //     return view('files.show')->with('patient',$patient);   
    // }
    
    public function destroy($id)
    {
        //
    }
}
