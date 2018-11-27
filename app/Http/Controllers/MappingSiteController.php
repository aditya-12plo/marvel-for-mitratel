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
use SendEmailController;
use App\Models\User;
use App\Models\UserExist;
use App\Models\Pemberitahuan;
use App\Models\Pesan;
use App\Models\Log;
use App\Models\Project;
use App\Models\DokumenSIS;
use App\Models\DokumenDRM;
use App\Models\DokumenSITAC;
use App\Models\ProjectStatus;
use App\Models\HistoryDrop;

class MappingSiteController extends Controller
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
        $this->SendEmailController = app('App\Http\Controllers\SendEmailController');
    $this->data['tahunproject']  = DB::table('vtahun')->get();
    }

   
       public function AddMappingSite(Request $request)
    { 
$cekdata = DB::table('vjobsmappingsite')->where('id',Input::get('project_id'))->first();
if (!$cekdata) {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:vjobsmappingsite,id',
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255', 
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if(!$valid)
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
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status')]);
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


   
       public function ApprovalMappingSite(Request $request)
    { 
$cekdata = DB::table('vjobsapprovedmappingsite')->where('id',Input::get('project_id'))->first();
if (!$cekdata) {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:vjobsapprovedmappingsite,id',
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255', 
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'regional' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if(!$valid)
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
Project::where('id',Input::get('project_id'))->update(['status_id'=>$kodestatus]);
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','ACCOUNT MANAGER'],['regional',strtoupper(Input::get('regional'))]])
->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','AM SUPPORT'],['regional',strtoupper(Input::get('regional'))]])
->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => Input::get('project_id'), 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);

// send email is off
//$this->SendEmailController->kirim($p['email'],Input::get('project_id'),Input::get('projectid'),Input::get('infratype'),strtoupper(Input::get('statusmessage')),strtoupper(Input::get('document')),Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,strtoupper(Input::get('message')),strtoupper(Input::get('kata')));
}
}
 
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

   
       public function SubmitMappingSite(Request $request)
    { 
$cekdata = Project::where([['id',Input::get('id')],['status_id',1]])->first();
if (!$cekdata) {
$valid = $this->validate($request, [   
        'infratype' => 'required|in:UNTAPPED,B2S',
        'site_id_spk' => 'required|max:255', 
        'site_name_spk' => 'required|max:255', 
        'longitude_spk' => 'required|max:255', 
        'latitude_spk' => 'required|max:255', 
        'address_spk' => 'required',  
    ]);
if(!$valid)
    {
Project::where('id',Input::get('id'))->update(['infratype'=>Input::get('infratype'),'site_id_spk'=>Input::get('site_id_spk'),'site_name_spk'=>Input::get('site_name_spk'),'longitude_spk'=>Input::get('longitude_spk'),'latitude_spk'=>Input::get('latitude_spk'),'address_spk'=>Input::get('address_spk'),'status_id'=>1]);
 
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