<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Response,View,Input,Auth,Session,Validator,File,Hash,DB,Excel,Mail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use PDF;
use Carbon\Carbon;


use App\Models\User;
use App\Models\UserExist;
use App\Models\Pemberitahuan;
use App\Models\Pesan;
use App\Models\Log;
use App\Models\Project;
use App\Models\DokumenSIS;
use App\Models\DokumenDRM;
use App\Models\DokumenSITAC;
use App\Models\DokumenRFC;
use App\Models\BOQ;
use App\Models\BOQSubmit;

class DownloadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('karyawan.auth');
        $this->data['title']  = 'Selamat Datang';
    $this->data['tahunproject']  = DB::table('vtahun')->get();
    }


            public function DownloadExcelTracking(Request $request)
    {
$filename = $request->filename;        
$projectid =  $request->projectid;     
$project =  DB::table('vallproject') 
        ->whereIn('id',explode(",",$projectid))
        ->orderBy('id','DESC')->get();

return Excel::create('ExportData', function($excel) use ($project){
    $excel->sheet('ExportData', function($sheet) use ($project){
             $sheet->loadView('Download.Tracking_Excel')
             ->with('data',$project);
             $sheet->setOrientation('landscape');
            });
    
})->export('xlsx'); 


    }



 }