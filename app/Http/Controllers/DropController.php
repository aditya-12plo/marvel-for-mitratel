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
use App\Models\HistoryDrop;
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
use App\Models\PO;

class DropController extends Controller
{
        public function __construct()
    {
        $this->middleware('karyawan.auth');
        $this->data['title']  = 'Selamat Datang';
        $this->SendEmailController = app('App\Http\Controllers\SendEmailController');
    $this->data['tahunproject']  = DB::table('vtahun')->get();
    }



 
    public function DeleteProjectData(Request $request)
    {
$valid = $this->validate($request, [
        'project_id' => 'required|numeric|not_in:0',
        'projectid' => 'required|max:255', 
    ]);
if (!$valid)
    {
        $destinationPath = 'files/'.Input::get('projectid');
        File::delete($destinationPath);  
        DokumenSIS::where('project_id',Input::get('project_id'))->delete();     
        DokumenDRM::where('project_id',Input::get('project_id'))->delete();    
        DokumenSITAC::where('project_id',Input::get('project_id'))->delete();     
        DokumenRFC::where('project_id',Input::get('project_id'))->delete();    
        BOQ::where('project_id',Input::get('project_id'))->delete();    
        PO::where('project_id',Input::get('project_id'))->delete();    
        SiteOpening::where('project_id',Input::get('project_id'))->delete();   
        Excavation::where('project_id',Input::get('project_id'))->delete();     
        Rebaring::where('project_id',Input::get('project_id'))->delete();     
        Pouring::where('project_id',Input::get('project_id'))->delete();    
        Curing::where('project_id',Input::get('project_id'))->delete();      
        TowerErection::where('project_id',Input::get('project_id'))->delete();      
        MEProcess::where('project_id',Input::get('project_id'))->delete();  
        FenceYard::where('project_id',Input::get('project_id'))->delete();   
        RfiBaut::where('project_id',Input::get('project_id'))->delete();   
        RfiDetail::where('project_id',Input::get('project_id'))->delete();   
        return response()->json(true);              
    }
else
    {
 return response()->json('error', $valid);
    } 
    }




    public function drop(Request $request)
    {
$valid = $this->validate($request, [
        'project_id' => 'required|numeric|not_in:0',
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
$cekHistory = HistoryDrop::where('project_id',Input::get('project_id'))->first();
$cek = Project::where('id',Input::get('project_id'))->first();
if(!$cekHistory)
{
HistoryDrop::create(['project_id'=>Input::get('project_id'),'status_id'=>$cek->status_id]);
}
else
{
HistoryDrop::where('project_id',Input::get('project_id'))->update(['status_id'=>$cek->status_id]); 
}        
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','MANAGER MARKETING'],['area',Auth::guard('karyawan')->user()->area]])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => Input::get('project_id'), 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);

// send email is off
//$this->SendEmailController->kirim($p['email'],Input::get('project_id'),Input::get('projectid'),Input::get('infratype'),strtoupper(Input::get('statusmessage')),strtoupper(Input::get('document')),Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,strtoupper(Input::get('message')),strtoupper(Input::get('kata')));
}
}
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'drop_site' ,'action' => 'update', 'data' => json_encode($cek)]);
return response()->json(['success'=>'Successfully']); 


        
    }
else
    {
 return response()->json('error', $valid);
    } 
    }

 
    public function dropRegional(Request $request)
    {
$valid = $this->validate($request, [
        'project_id' => 'required|numeric|not_in:0',
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
$cekHistory = HistoryDrop::where('project_id',Input::get('project_id'))->first();
if(Input::get('status') == 1)
{
$kodestatus = $cekHistory->status_id;
}
else
{
$kodestatus = Input::get('status');
}
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','AM SUPPORT'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','ACCOUNT MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => Input::get('project_id'), 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);

// send email is off
//$this->SendEmailController->kirim($p['email'],Input::get('project_id'),Input::get('projectid'),Input::get('infratype'),strtoupper(Input::get('statusmessage')),strtoupper(Input::get('document')),Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,strtoupper(Input::get('message')),strtoupper(Input::get('kata')));
}
}
Project::where('id',Input::get('project_id'))->update(['status_id'=>$kodestatus,'project_status_id'=>$ProjectStatus->id]);
$cek = Project::where('id',Input::get('project_id'))->first();
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'drop_site' ,'action' => 'update', 'data' => json_encode($cek)]);
return response()->json(['success'=>'Successfully']); 


        
    }
else
    {
 return response()->json('error', $valid);
    } 
    }

 
    public function DropProjectHQ(Request $request)
    {
$valid = $this->validate($request, [
        'project_id' => 'required|numeric|not_in:0',
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
$cekHistory = HistoryDrop::where('project_id',Input::get('project_id'))->first();
$cek = Project::where('id',Input::get('project_id'))->first();
if(!$cekHistory)
{
HistoryDrop::create(['project_id'=>Input::get('project_id'),'status_id'=>$cek->status_id]);
}
else
{
HistoryDrop::where('project_id',Input::get('project_id'))->update(['status_id'=>$cek->status_id]); 
}  
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','MANAGER']])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => Input::get('project_id'), 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);

// send email is off
//$this->SendEmailController->kirim($p['email'],Input::get('project_id'),Input::get('projectid'),Input::get('infratype'),strtoupper(Input::get('statusmessage')),strtoupper(Input::get('document')),Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,strtoupper(Input::get('message')),strtoupper(Input::get('kata')));
}
}
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]); 
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'drop_site' ,'action' => 'update', 'data' => json_encode($cek)]);
return response()->json(['success'=>'Successfully']); 


        
    }
else
    {
 return response()->json('error', $valid);
    } 
    }

 

 
    public function dropHQ(Request $request)
    {
$valid = $this->validate($request, [
        'project_id' => 'required|numeric|not_in:0',
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'area' => 'required|numeric|not_in:0',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
$cekHistory = HistoryDrop::where('project_id',Input::get('project_id'))->first();
if(Input::get('status') == 1)
{
$kodestatus = $cekHistory->status_id;
}
else
{
$kodestatus = Input::get('status');
}
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);
$showUser = User::where(function ($query) {
    $query->where([['level', Auth::guard('karyawan')->user()->level],['posisi','ACCOUNT MANAGER'],['area',Input::get('area')]])
          ->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','ACCOUNT MANAGER'],['area',Input::get('area')]]);
})->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => Input::get('project_id'), 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);

// send email is off
//$this->SendEmailController->kirim($p['email'],Input::get('project_id'),Input::get('projectid'),Input::get('infratype'),strtoupper(Input::get('statusmessage')),strtoupper(Input::get('document')),Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,strtoupper(Input::get('message')),strtoupper(Input::get('kata')));
}
}
Project::where('id',Input::get('project_id'))->update(['status_id'=>$kodestatus,'project_status_id'=>$ProjectStatus->id]);
$cek = Project::where('id',Input::get('project_id'))->first();
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'drop_site' ,'action' => 'update', 'data' => json_encode($cek)]);
return response()->json(['success'=>'Successfully']); 


        
    }
else
    {
 return response()->json('error', $valid);
    } 
    }

 
    public function DropProjectHaki(Request $request)
    {
$valid = $this->validate($request, [
        'project_id' => 'required|numeric|not_in:0',
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
$cekHistory = HistoryDrop::where('project_id',Input::get('project_id'))->first();
$cek = Project::where('id',Input::get('project_id'))->first();
if(!$cekHistory)
{
HistoryDrop::create(['project_id'=>Input::get('project_id'),'status_id'=>$cek->status_id]);
}
else
{
HistoryDrop::where('project_id',Input::get('project_id'))->update(['status_id'=>$cek->status_id]); 
}  
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);
$showUser = User::where(function ($query) {
    $query->where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area',Auth::guard('karyawan')->user()->area]])
          ->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area2',Auth::guard('karyawan')->user()->area]]);
})->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => Input::get('project_id'), 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);

// send email is off
//$this->SendEmailController->kirim($p['email'],Input::get('project_id'),Input::get('projectid'),Input::get('infratype'),strtoupper(Input::get('statusmessage')),strtoupper(Input::get('document')),Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,strtoupper(Input::get('message')),strtoupper(Input::get('kata')));
}
}
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]); 
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'drop_site' ,'action' => 'update', 'data' => json_encode($cek)]);
return response()->json(['success'=>'Successfully']); 


        
    }
else
    {
 return response()->json('error', $valid);
    } 
    }

 

    
}
