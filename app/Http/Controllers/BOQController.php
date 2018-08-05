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
        'project_id' => 'required|max:255|unique:document_sis,project_id',
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'site_type' => 'required|max:200',
        'tower_type' => 'required|max:255',
        'roof_top_high' => 'numeric|not_in:0',
        'tower_high' => 'required|numeric|not_in:0',
        'rf_in_meters' => 'required|max:255',
        'mw_in_meters' => 'required|max:255',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {

$masuk = array('project_id' => $request->project_id,'site_type' => $request->site_type,'tower_type' => $request->tower_type,'roof_top_high' => $request->roof_top_high,'tower_high' => $request->tower_high,'rf_in_meters' => $request->rf_in_meters,'mw_in_meters' => $request->mw_in_meters); 
BOQ::create($masuk);
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => Input::get('project_id'), 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);

// send email is off
//$this->SendEmailController->kirim($p['email'],Input::get('project_id'),Input::get('projectid'),Input::get('infratype'),strtoupper(Input::get('statusmessage')),strtoupper(Input::get('document')),Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,strtoupper(Input::get('message')),strtoupper(Input::get('kata')));
}
}
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]);
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