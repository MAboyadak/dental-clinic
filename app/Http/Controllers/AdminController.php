<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Appointment;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;

class AdminController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Africa/Cairo");
    }

    public function index()
    {
        $appointments = Appointment::whereDate('day', Carbon::today())
        // ->where('done','=',0)
        ->with(['patient', 'session.payment'])
        ->orderBy('hour','desc')
        ->paginate(10);

        $appsCount = $appointments->where('done','=','0')->count();
        
        return view('admin.index',compact('appointments','appsCount'));
    }
    
    public function getTodayApps()
    {
        $appointments = Appointment::whereDate('day', date('Y-m-d'))
                                    ->with(['patient', 'session.payment'])
                                    // ->where('done','=',0)
                                    ->orderBy('hour','desc')
                                    ->get();
        $appsCount = $appointments->count();                                    
        $count = $appointments->where('done','=','0')->count();
        $appointments->put($appsCount,$count);
        // $response = [];
        // if(sizeof($appointments) == 0){
        //     // $response = '';
        //     $appsCount = 0;
        // }
        // else{
        //     // for($i = 0; $i < sizeof($appointments); $i++)
        //     // {
        //     //     $response[$i]['appointment'] = $appointments[$i];
        //     //     $response[$i]['patient'] = $appointments[$i]->patient;
        //     //     $response[$i]['session'] = $appointments[$i]->session;
        //     // }
        //     $appsCount = $appointments->count();
        // }
        
        // $appointments = (array) $appointments;
        // array_push($appointments,$appsCount);
        // $response->count = $appsCount;
        return $appointments;
    }

    public function doneDocApp(Request $request)
    {
        $appointment = Appointment::find($request->id);
        $appointment->done = 1;
        $appointment->save();
        return 'yes deleted';
    }

    public function backUpData(Request $request)
    {
        return 'backup';        
    }

    public function print(){
        try {
            // $connector = new WindowsPrintConnector("\\wind7\usb\epson");
            $connector = new WindowsPrintConnector("epson U220");
            //The share name should be passed to the WindowsPrintConnector as the first argument, instead:
            //            If the share name was epson U2020

            $printer = new Escpos($connector);
            $printer -> text("Hello World!\n");
            $printer -> cut();

            $printer -> close();
        } catch(Exception $e) {
            echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
        }

        dd($printer);
    }
}
