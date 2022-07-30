<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Appointment;
use App\payment;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Africa/Cairo");
        $this->middleware('auth');
    }
    // public function all()
    // {
        
    //     $patients = Patient::all();
    //     return view('home.partials.index',compact('patients'));
    // }
    public function index()
    {
        if(Auth()->user()->is_admin){
            return redirect()->route('admin.index');
        }

        $patients = Patient::all();
        foreach ($patients as $patient) {

            $patient->wanted = 0;
            $patient->paid = 0;

            if (!$patient->programs) {
                
            }else{
                foreach($patient->programs as $program){

                    if (!$program->sessions) {
                
                    }else{
                        foreach ($program->sessions as $session) {
                            $patient->wanted += $session->cost;
                            if (!$session->payment) {
                                
                            } else {
                                $patient->paid += $session->payment->paid;   
                            }
                        }
                    }
    
                }
            }
            
        }
        // dd($patients);
        $appointments = Appointment::whereDate('day', Carbon::today())
        // ->where('done','=',0)
        ->with(['patient', 'session.payment'])
        ->orderBy('hour','desc')
        ->paginate(10);

        // $appsCount = $appointments->count();
        $appsCount = $appointments->where('done','=','0')->count();
        // $appointments->put($appsCount,$count);

        return view('home.index',compact('patients','appsCount','appointments'));
    }

    // public function store(Request $request)
    // {        
    //     // dd($request->number);
    //     $request->validate([
    //         'name' => 'required',
    //         'age' => 'numeric|nullable',
    //         'city' => 'nullable',
    //         'number' => 'numeric|nullable',
    //         'day' => 'date|nullable',
    //         'hour' => 'nullable',
    //         'file' => 'nullable',
    //     ]);

    //     if(empty($request->day)){$request->day = date('Y/m/d');}
    //     if(empty($request->hour)){$request->hour = date('H:i');}

    //     $patient = new Patient();
    //     $patient->name = $request->input('name');
    //     $patient->age = $request->input('age');
    //     $patient->city = $request->input('city');
    //     $patient->number = $request->input('number');
    //     if(isset($request->file)){
    //         $path = $request->file('file')->store('patient-images','public');
    //         $patient->image = $path;
    //     }
    //     $patient->save();

    //     $appointment = new Appointment();
    //     $appointment->day = $request->day;
    //     $appointment->hour = $request->hour;
    //     $appointment->patient_id = $patient->id;

    //     if($appointment->save()){
    //         return redirect()->route('home')->with('success', 'تمت الاضافة بنجاح');
    //     }
    //     return redirect()->route('home')->with('error', 'يوجد مشكلة !!');

    // }

    public function revisit(Request $request)
    {
        $appointment = new Appointment();
        $appointment->patient_id = $request->selectedPatient;
        if(empty($request->day)){$request->day = date('y/m/d');}
        if(empty($request->hour)){$request->hour = date('H:i');}
        $appointment->day = $request->day;
        $appointment->hour = $request->hour;
        $appointment->save();
        return redirect()->route('home')->with('success', 'تم الحجز بنجاح');
    }
    
    public function getTodayApps()
    {
        $appointments = Appointment::whereDate('day', date('Y-m-d'))
                                    ->with(['patient.payments', 'session.payment'])
                                    // ->where('done','=',0)
                                    ->orderBy('hour','desc')
                                    ->get();

        $appsCount = $appointments->count();                                    
        $count = $appointments->where('done','=','0')->count();
        $appointments->put($appsCount,$count);

        // $today = date('Y-m-d');
        // $response = [];
        // if(sizeof($appointments) == 0){
        //     // $response = '';
        //     $appsCount = 0;
        // }else{
        //     $appsCount = $appointments->count();
            
        //     for($i = 0; $i < sizeof($appointments); $i++)
        //     {
        //         $response[$i]['appId'] = $appointments[$i]->id;
        //         $response[$i]['patient'] = $appointments[$i]->patient;

        //         if($appointments[$i]->patient->payments()->exists()){
        //             $payments = $appointments[$i]->patient->payments;

        //             foreach ($payments as $key => $value) {
        //                 $payments[$key]->day = $payments[$key]->created_at->toDateString();
        //             }
        //             // return $payments;
        //         }
        //         $response[$i]['wanted'] = $appointments[$i]->patient->payments->where('day','=',$today)->SUM('wanted');
        //         // $response[$i]['paid'] = $appointments[$i]->patient->payments->where('day','=',$today)->SUM('paid');
        //         // $response[$i]['remained'] = $response[$i]['wanted'] - $response[$i]['paid'];


        //         $response[$i]['day'] = $appointments[$i]->day;
        //         $response[$i]['hour'] = $appointments[$i]->hour;

        //         if($appointments[$i]->patient->payments()->exists())
        //         {
        //             $payments = $appointments[$i]->patient->payments;
        //             $response[$i]['allWanted'] = $payments->SUM('wanted');
        //             $response[$i]['allPaid'] = $payments->SUM('paid');
        //             $response[$i]['allRemained'] = $response[$i]['allWanted'] - $response[$i]['allPaid'];
        //         }else{
        //             $response[$i]['allWanted'] = 0;
        //             $response[$i]['allPaid'] = 0;
        //             $response[$i]['allRemained'] = 0;
        //         }
        //     }
        // }
        // array_push($response,$appsCount);

        return $appointments;
    }

    public function deleteAppointment(Request $request)
    {
        $appointment = Appointment::find($request->id);
        $appointment->delete();
        // return redirect()->route('home')->with('success', 'تم الغاء الحجز بنجاح');
    }

    public function endAppointment(Request $request)
    {
        $appointment = Appointment::find($request->id);
        $appointment->done = 2;
        $appointment->save();

        $payment = new payment();
        if(!$appointment->session->payment){
            $payment->patient_id = $appointment->patient->id;
            $payment->session_id = $appointment->session->id;

            $payment->paid = $request->paid;
            $payment->save();
        }else{
            $payment = $payment->find($appointment->session->payment->id);
            $payment->paid = $request->paid;
            $payment->save();
        }
        // return redirect()->route('home')->with('success', 'تم الغاء الحجز بنجاح');
    }



    // Search by date
    // public function search(Request $request)
    // {
    //     $start = $request->startDate;
    //     $end = $request->endDate;
    //     if(empty($start) && empty($end)){
    //         $searchedAppointments = Appointment::orderBy('day','desc')->orderBy('hour','desc')->get();
    //     }
    //     elseif($start && empty($end))
    //     {
    //         $searchedAppointments = Appointment::where('day','>=',$start)->orderBy('day','desc')->orderBy('hour','desc')->get();
    //     }
    //     elseif($end && empty($start)){
    //         $searchedAppointments = Appointment::where('day','<=',$end)->orderBy('day','desc')->orderBy('hour','desc')->get();
    //     }else{
    //         $searchedAppointments = Appointment::where('day','<=',$end)
    //         ->where('day','>=',$start)
    //         ->orderBy('day','desc')
    //         ->orderBy('hour','desc')
    //         ->get();
    //     }
        
    //     foreach ($searchedAppointments as $key => $value) {
    //         $patient = Patient::find($searchedAppointments[$key]->patient_id);
    //         $searchedAppointments[$key]['patient'] = $patient;
    //         if($patient->prescriptions()->exists())
    //         {
    //             $prescriptions = $patient->prescriptions;
    //             foreach ($prescriptions as $pkey => $pvalue) {
    //                 $prescriptions[$pkey]->day = $prescriptions[$pkey]->created_at->toDateString();
    //             }
    //             $searchedAppointments[$key]['problem'] = $prescriptions->firstWhere('day','=', $searchedAppointments[$key]->day)['problem'];
    //         }else{
    //             $searchedAppointments[$key]['problem'] = 'لا يوجد';
    //         }


    //         if($patient->payments()->exists())
    //         {
    //             $payments = $patient->payments;

    //             foreach ($payments as $key2 => $value2) {
    //                 $payments[$key2]->day = $payments[$key2]->created_at->toDateString();
                    
    //                 $searchedAppointments[$key]['wanted'] = $payments->where('day','=',$searchedAppointments[$key]->day)->SUM('wanted');
    //                 $searchedAppointments[$key]['paid'] = $payments->where('day','=',$searchedAppointments[$key]->day)->SUM('paid');
    //                 $searchedAppointments[$key]['remained'] = $searchedAppointments[$key]['wanted'] - $searchedAppointments[$key]['paid'];
    //             }
    //             $searchedAppointments[$key]['allWanted'] = $payments->SUM('wanted');
    //             $searchedAppointments[$key]['allPaid'] = $payments->SUM('paid');
    //             $searchedAppointments[$key]['allRemained'] = $payments->SUM('wanted') - $payments->SUM('paid');
    //         }else{
    //             $searchedAppointments[$key]['wanted'] = 0;
    //             $searchedAppointments[$key]['paid'] = 0;
    //             $searchedAppointments[$key]['remained'] = 0;

    //             $searchedAppointments[$key]['allWanted'] = 0;
    //             $searchedAppointments[$key]['allPaid'] = 0;
    //             $searchedAppointments[$key]['allRemained'] = 0;
    //         }

            
    //     }
    //     return($searchedAppointments);
    //     // dd($searchedAppointments);
    // }


    // Search by date
    public function searchDay(Request $request)
    {
        $dayToSearch = $request->dayToSearch;
        if(!$dayToSearch){return 'error';}

        $searchedAppointments = Appointment::where('day','=',$dayToSearch)->get();
        // var_dump($searchedAppointments);
        if(sizeof($searchedAppointments) > 0){
            foreach ($searchedAppointments as $key => $app) {
                $patient = Patient::find($app->patient_id);
                $app['patient'] = $patient;
                $app['hour'] = substr($app['hour'],0,5);
            }
            return $searchedAppointments;
        }
        return 'empty';
        // dd($searchedAppointments);
    }
}
