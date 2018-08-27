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
use App\Models\BOQSubmit;
use App\Models\SiteOpening;
use App\Models\Excavation;
use App\Models\Rebaring;
use App\Models\Pouring;
use App\Models\Curing;
use App\Models\TowerErection;
use App\Models\MEProcess;
use App\Models\FenceYard;
use App\Models\RfiBaut;
use App\Models\RfiDetail;
use App\Models\CMESubmit;

class RfiDetailController extends Controller
{
        public function __construct()
    {
        $this->middleware('karyawan.auth');
        $this->data['title']  = 'Selamat Datang';
        $this->SendEmailController = app('App\Http\Controllers\SendEmailController');
    $this->data['tahunproject']  = DB::table('vtahun')->get();
    }



        public function AddDocumentRfiDetail(Request $request)
    {
$cekdata = RfiDetail::where('project_id',Input::get('project_id'))->first();
if (!$cekdata) {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:rfi_detail,project_id',  
        'rfi_detail_start_date' => 'required|date|date_format:Y-m-d',
        'rfi_detail_end_date' => 'required|date|date_format:Y-m-d',
        'rfi_detail_price_month' => 'required|numeric|not_in:0', 
        'rfi_detail_price_year' => 'required|numeric|not_in:0',  
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
 
$masuk = array('project_id' => $request->project_id,'rfi_detail_start_date' => $request->rfi_detail_start_date,'rfi_detail_end_date' => $request->rfi_detail_end_date,'rfi_detail_price_month' => $request->rfi_detail_price_month,'rfi_detail_price_year' => $request->rfi_detail_price_year); 
RfiDetail::create($masuk);
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area2',Auth::guard('karyawan')->user()->area]])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => Input::get('project_id'), 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);

// send email is off
//$this->SendEmailController->kirim($p['email'],Input::get('project_id'),Input::get('projectid'),Input::get('infratype'),strtoupper(Input::get('statusmessage')),strtoupper(Input::get('document')),Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,strtoupper(Input::get('message')),strtoupper(Input::get('kata')));
}
}
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]); 
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'rfi_detail' ,'action' => 'insert', 'data' => json_encode($masuk)]);
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



        public function ApprovalRfiDetail(Request $request)
    {
$valid = $this->validate($request, [
            'project_id' => 'required',
            'projectid' => 'required',
            'kata' => 'required',
            'infratype' => 'required',
            'message' => 'required',
            'statusmessage' => 'required',
            'document' => 'required',
            'status' => 'required|numeric|not_in:0',
            'statuscme' => 'required|numeric',
    ]);
if (!$valid)
    {
 
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - ACCOUNT MANAGER'],['area2',Auth::guard('karyawan')->user()->area]])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => Input::get('project_id'), 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);

// send email is off
//$this->SendEmailController->kirim($p['email'],Input::get('project_id'),Input::get('projectid'),Input::get('infratype'),strtoupper(Input::get('statusmessage')),strtoupper(Input::get('document')),Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,strtoupper(Input::get('message')),strtoupper(Input::get('kata')));
}
}
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status'),'haki_status'=>Input::get('statuscme'),'project_status_id'=>$ProjectStatus->id]); 

return response()->json(['success'=>'Successfully']); 
     
    }
else
    {
 return response()->json('error', $valid);
    }
      
    }






        public function RevisiDocumentCMEDetail(Request $request)
    {
 
$valid = $this->validate($request, [
        'id' => 'required|numeric|not_in:0', 
        'rfi_detail_start_date' => 'required|date|date_format:Y-m-d',
        'rfi_detail_end_date' => 'required|date|date_format:Y-m-d',
        'rfi_detail_price_month' => 'required|numeric|not_in:0', 
        'rfi_detail_price_year' => 'required|numeric|not_in:0',  
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
 
$edit = array('rfi_detail_start_date' => $request->rfi_detail_start_date,'rfi_detail_end_date' => $request->rfi_detail_end_date,'rfi_detail_price_month' => $request->rfi_detail_price_month,'rfi_detail_price_year' => $request->rfi_detail_price_year); 
RfiDetail::where('id',$request->id)->update($edit);
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area2',Auth::guard('karyawan')->user()->area]])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => Input::get('project_id'), 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);

// send email is off
//$this->SendEmailController->kirim($p['email'],Input::get('project_id'),Input::get('projectid'),Input::get('infratype'),strtoupper(Input::get('statusmessage')),strtoupper(Input::get('document')),Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,strtoupper(Input::get('message')),strtoupper(Input::get('kata')));
}
}
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]);  
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'rfi_detail' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Successfully']); 
     
    }
else
    {
 return response()->json('error', $valid);
    }
 
    }




    public function SubmitRFIDetailMassal(Request $request)
    {

        $valid = $this->validate($request, [
            'id' => 'required',
            'statusmessage' => 'required',
            'kata' => 'required',
            'document' => 'required',
            'status' => 'required|numeric|not_in:0',
            'statuscme' => 'required|numeric|not_in:0',
        ]);
    if (!$valid)
        {
    
    $detailnya = explode(",", $request->id);
    $emailusernya = array();
    for($x=0;$x < count($detailnya);$x++) {
    $ProjectStatus = ProjectStatus::create(['project_id' =>$detailnya[$x],'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('kata'))]);  
    $showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - ACCOUNT MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - ACCOUNT MANAGER'],['area2',Auth::guard('karyawan')->user()->area]])->get();
    $cekproject = Project::where('id',$detailnya[$x])->first();
    if(count($showUser) > 0)
    {
    foreach ($showUser as $p) {
    Pesan::create(['project_id' => $detailnya[$x], 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);
     // send email is off
    //$this->SendEmailController->kirim($p['email'],$detailnya[$x],$cekproject->projectid,$cekproject->infratype,strtoupper(Input::get('statusmessage')),strtoupper(Input::get('document')),Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,strtoupper(Input::get('message')),strtoupper(Input::get('kata')));
    }
    }
    Project::where('id',$detailnya[$x])->update(['status_id'=>Input::get('status'),'haki_status'=>Input::get('statuscme'),'project_status_id'=>$ProjectStatus->id]);
    
    
    }
    
    
    return response()->json(['success'=>'Successfully']);
        }
    else
        {
     return response()->json('error', $valid);
        } 

    }




        public function SubmitCME(Request $request)
    {
$valid = $this->validate($request, [ 
        'project_id' => 'required',  
        'document' => 'required', 
        'status' => 'required|numeric'
    ]);
if (!$valid)
    {
$array_bulan = array(1=>"JANUARI","FEBUARI","MARET", "APRIL", "MEI","JUNI","JULI","AGUSTUS","IX","SEPTEMBER", "OKTOBER","NOVEMBER");        
$nodoc = ' ACCRUAL/'.$array_bulan[Carbon::now()->month].'/'.Carbon::now()->year;

 

    }
else
    {
 return response()->json('error', $valid);
    }
    
    
    }    





}