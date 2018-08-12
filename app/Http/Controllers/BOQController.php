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


        public function update(Request $request,$id)
    {
$cekdata = BOQ::findOrFail($id);
if ($cekdata) {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:document_boq,project_id,'.$id, 
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

$edit = array('project_id' => $request->project_id,'site_type' => $request->site_type,'tower_type' => $request->tower_type,'roof_top_high' => $request->roof_top_high,'tower_high' => $request->tower_high,'rf_in_meters' => $request->rf_in_meters,'mw_in_meters' => $request->mw_in_meters,'harga_bulan' => $request->harga_bulan,'harga_tahun' => $request->harga_tahun); 
$cekdata->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_boq' ,'action' => 'update', 'data' => json_encode($cekdata)]);
return response()->json(['success'=>'Edit Successfully']); 
     
    }
else
    {
 return response()->json('error', $valid);
    }
    }
else
    {
 return response()->json(['error'=>'Code Not Found']);
    }    
    }


    public function GetDetailProject($id)
    {
$query =  DB::table('vjobsubmitboq')
         ->whereIn('id',explode(",",$id))->get();
return response()->json($query);

    }


    public function GetDetailProjectBOQ($id)
    {
$query =  DB::table('vallprojectboq')
         ->whereIn('id',explode(",",$id))->get();
return response()->json($query);

    }




// submit BOQ


        public function SubmitBOQ(Request $request)
    {
$valid = $this->validate($request, [ 
        'title' => 'required|max:255',
        'nama_telkomsel' => 'required|max:255',
        'posisi_telkomsel' => 'required|max:255',
        'nama_manager' => 'required|max:255',
        'posisi_manager' => 'required|max:255',
        'nama_user' => 'required|max:255',
        'posisi_user' => 'required|max:255',
        'project_id' => 'required', 
        'detailproject' => 'required',
        'message' => 'required',
        'document' => 'required',
        'statusmessage' => 'required',
        'status' => 'required|numeric'
    ]);
if (!$valid)
    {
$array_bulan = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");        
$jml =  DB::table('vcountboqsubmit')->select('jumlah')->first();
$nodoc = 'MITRATEL/'.($jml->jumlah+1).'/'.$array_bulan[Carbon::now()->month].'/'.Carbon::now()->year;
$masuk = array('boq_code'=>$nodoc,'title'=>$request->title,'nama_telkomsel'=>$request->nama_telkomsel,'posisi_telkomsel'=>$request->posisi_telkomsel,'nama_manager'=>$request->nama_manager,'posisi_manager'=>$request->posisi_manager,'nama_user'=>$request->nama_user,'posisi_user'=>$request->posisi_user,'project_id'=>$request->project_id,'message'=>$request->message,'status'=>$request->status,'area'=>Auth::guard('karyawan')->user()->area);
$kata = 'SUBMIT BOQ '.$nodoc.'MENUNGGU APPROVAL ANDA';
$detailnya = $request->detailproject;
$emailusernya = array();

for($x=0;$x < count($detailnya);$x++) {
$ProjectStatus = ProjectStatus::create(['project_id' =>$detailnya[$x]['id'],'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);  
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','MANAGER'],['area2',Auth::guard('karyawan')->user()->area]])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => $detailnya[$x]['id'], 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);
}
}
Project::where('id',$detailnya[$x]['id'])->update(['status_id'=>15,'project_status_id'=>$ProjectStatus->id]);


}

BOQSubmit::create($masuk);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'boq_submit' ,'action' => 'insert', 'data' => json_encode($masuk)]);
$showUser2 = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->get();
if(count($showUser2) > 0)
{
foreach ($showUser2 as $p2) {  
//$this->SendEmailController->kirimBOQ($p2['email'],Input::get('title'),$nodoc,Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,$detailnya,strtoupper($kata));

}
}

return response()->json(['success'=>'Successfully']);      
    }
else
    {
 return response()->json('error', $valid);
    }
    
    
    }    

        public function SubmitBOQApproval(Request $request)
    {
$valid = $this->validate($request, [ 
        'id' => 'required|numeric|not_in:0',
        'statusboq' => 'required|numeric|not_in:0',
        'title' => 'required|max:255',
        'boq_code' => 'required|max:255', 
        'project_id' => 'required', 
        'kata' => 'required', 
        'detailproject' => 'required',
        'message' => 'required',
        'document' => 'required',
        'statusmessage' => 'required',
        'status' => 'required|numeric'
    ]);
if (!$valid)
    {

$edit = array('message'=>$request->message,'status'=>$request->statusboq); 
$detailnya = $request->detailproject;
$emailusernya = array();
for($x=0;$x < count($detailnya);$x++) {
$ProjectStatus = ProjectStatus::create(['project_id' =>$detailnya[$x]['id'],'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);  
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','ACCOUNT MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => $detailnya[$x]['id'], 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);
}
}
Project::where('id',$detailnya[$x]['id'])->update(['status_id'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]);


}

BOQSubmit::where('id',Input::get('id'))->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'boq_submit' ,'action' => 'update', 'data' => json_encode($edit)]);
$showUser2 = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->get();
if(count($showUser2) > 0)
{
foreach ($showUser2 as $p2) {  
//$this->SendEmailController->kirimBOQ($p2['email'],Input::get('title'),$nodoc,Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,$detailnya,strtoupper($kata));

}
}

return response()->json(['success'=>'Successfully']);      
    }
else
    {
 return response()->json('error', $valid);
    }
    
    
    }    




        public function printPDF(Request $request)
    {
        
$header = $request->palanya;        
$body =  $request->body;    
$namatelkomsel =  $request->nama_telkomsel;
$posisitelkomsel =  $request->posisi_telkomsel;
$namamanager =  $request->nama_manager;
$posisimanager =  $request->posisi_manager;
$namauser =  $request->nama_user;
$posisiuser =  $request->posisi_user;
 
$data = ['header'=>$header , 'body'=>$body,'namatelkomsel'=>$namatelkomsel,'posisitelkomsel'=>$posisitelkomsel,'namamanager'=>$namamanager,'posisimanager'=>$posisimanager,'namauser'=>$namauser,'posisiuser'=>$posisiuser];
PDF::setOptions(['dpi' => 150, 'defaultFont' => 'arial']);     
$pdf = PDF::loadView('DownloadPDF', $data)->setPaper('a3', 'portrait');
return $pdf->download('BOQ-SUBMIT-'.Carbon::now().'.pdf');


    }


}