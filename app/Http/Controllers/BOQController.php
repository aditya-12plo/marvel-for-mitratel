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
use App\Models\SubmitBOQ;
use App\Models\ProjectStatus;

class BOQController extends Controller
{
        public function __construct()
    {
        $this->middleware('karyawan.auth');
        $this->data['title']  = 'Selamat Datang';
        $this->SendEmailController = app('App\Http\Controllers\SendEmailController');
    }


        public function store(Request $request)
    {
$cekdata = BOQ::where('project_id',Input::get('project_id'))->first();
if (!$cekdata) {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:document_boq,project_id', 
        'projectid' => 'required|max:255',
        'site_type' => 'required|max:200',
        'tower_type' => 'required|max:255',
        'roof_top_high' => 'nullable|numeric|not_in:0',
        'tower_high' => 'required|numeric|not_in:0',
        'rf_in_meters' => 'required|max:255',
        'mw_in_meters' => 'required|max:255', 
        'harga_bulan' => 'required|numeric|not_in:0', 
        'harga_tahun' => 'required|numeric|not_in:0', 
        'infratype' => 'required',  
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {

$masuk = array('project_id' => $request->project_id,'site_type' => $request->site_type,'tower_type' => $request->tower_type,'roof_top_high' => $request->roof_top_high,'tower_high' => $request->tower_high,'rf_in_meters' => $request->rf_in_meters,'mw_in_meters' => $request->mw_in_meters,'harga_bulan' => $request->harga_bulan,'harga_tahun' => $request->harga_tahun); 
BOQ::create($masuk);
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status')]); 
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_boq' ,'action' => 'insert', 'data' => json_encode($masuk)]);
return response()->json(['success'=>'Successfully']); 
     
    }
else
    {
 return response()->json('error', $valid);
    }
    }
else
    {
return response()->json(['error'=>'Maaf Pekerjaan Ini Sudah Di Kerjakan Orang Lain']);
    }    
    }





}