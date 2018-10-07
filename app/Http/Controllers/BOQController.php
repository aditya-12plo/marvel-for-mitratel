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
    $this->data['tahunproject']  = DB::table('vtahun')->get();
    }




    public function RevisiDocumentBOQByAdmin(Request $request)
    {
        if(Input::get('id') == 0)
        {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:document_boq,project_id', 
        'projectid' => 'required|max:255',
        'site_type' => 'required|max:200',
        'tower_type' => 'required|max:255',
        'roof_top_high' => 'nullable|numeric',
        'tower_high' => 'required|numeric|not_in:0',
        'rf_in_meters' => 'required|max:255',
        'mw_in_meters' => 'required|max:255', 
        'harga_bulan' => 'required|numeric|not_in:0', 
        'harga_tahun' => 'required|numeric|not_in:0',  
    ]);
if (!$valid)
    {
if($request->roof_top_high == 0)
{
$roof_top_high = null;    
}
else
{
$roof_top_high = $request->roof_top_high;     
}
$masuk = array('project_id' => $request->project_id,'site_type' => $request->site_type,'tower_type' => $request->tower_type,'roof_top_high' => $roof_top_high,'tower_high' => $request->tower_high,'rf_in_meters' => $request->rf_in_meters,'mw_in_meters' => $request->mw_in_meters,'harga_bulan' => $request->harga_bulan,'harga_tahun' => $request->harga_tahun); 
BOQ::create($masuk);
Project::where('id',Input::get('project_id'))->update(['boq_status'=>14]); 
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_boq' ,'action' => 'insert', 'data' => json_encode($masuk)]);
$project = DB::table('vallproject')->where('id',Input::get('project_id'))->first();
return response()->json(['success'=>'Edit Successfully','project'=>$project]);      
    }
else
    {
 return response()->json('error', $valid);
    }
}
else
{

    $valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:document_boq,project_id,'.$request->id, 
        'projectid' => 'required|max:255',
        'site_type' => 'required|max:200',
        'tower_type' => 'required|max:255',
        'roof_top_high' => 'nullable|numeric',
        'tower_high' => 'required|numeric|not_in:0',
        'rf_in_meters' => 'required|max:255',
        'mw_in_meters' => 'required|max:255', 
        'harga_bulan' => 'required|numeric|not_in:0', 
        'harga_tahun' => 'required|numeric|not_in:0',  
    ]);
if (!$valid)
    {
if($request->roof_top_high == 0)
{
$roof_top_high = null;    
}
else
{
$roof_top_high = $request->roof_top_high;     
}
$edit = array('site_type' => $request->site_type,'tower_type' => $request->tower_type,'roof_top_high' => $roof_top_high,'tower_high' => $request->tower_high,'rf_in_meters' => $request->rf_in_meters,'mw_in_meters' => $request->mw_in_meters,'harga_bulan' => $request->harga_bulan,'harga_tahun' => $request->harga_tahun); 
BOQ::where('id',$request->id)->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_boq' ,'action' => 'insert', 'data' => json_encode($edit)]);
$project = DB::table('vallproject')->where('id',Input::get('project_id'))->first();
return response()->json(['success'=>'Edit Successfully','project'=>$project]);      
    }
else
    {
 return response()->json('error', $valid);
    }
}
    }



    public function UpdateBOQRevisi(Request $request)
    { 
        $id = $request->id;
        $project_id = $request->project_id;

Project::whereIn('id',explode(",",$project_id))->update(['boq_status'=>16]);
BOQSubmit::where('id',$id)->update(['boq_status'=>$project_id]);  
return response()->json(['success'=>'Successfully']);      
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
        'roof_top_high' => 'nullable|numeric',
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
if($request->roof_top_high == 0)
{
$roof_top_high = null;    
}
else
{
$roof_top_high = $request->roof_top_high;     
}
$masuk = array('project_id' => $request->project_id,'site_type' => $request->site_type,'tower_type' => $request->tower_type,'roof_top_high' => $roof_top_high,'tower_high' => $request->tower_high,'rf_in_meters' => $request->rf_in_meters,'mw_in_meters' => $request->mw_in_meters,'harga_bulan' => $request->harga_bulan,'harga_tahun' => $request->harga_tahun); 
BOQ::create($masuk);
Project::where('id',Input::get('project_id'))->update(['boq_status'=>Input::get('status')]); 
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
        'roof_top_high' => 'nullable|numeric',
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
if($request->roof_top_high == 0)
{
$roof_top_high = null;    
}
else
{
$roof_top_high = $request->roof_top_high;     
}
$edit = array('project_id' => $request->project_id,'site_type' => $request->site_type,'tower_type' => $request->tower_type,'roof_top_high' => $roof_top_high,'tower_high' => $request->tower_high,'rf_in_meters' => $request->rf_in_meters,'mw_in_meters' => $request->mw_in_meters,'harga_bulan' => $request->harga_bulan,'harga_tahun' => $request->harga_tahun); 
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
$nodoc = 'BOQ/'.($jml->jumlah+1).'/'.$array_bulan[Carbon::now()->month].'/'.Carbon::now()->year;
$masuk = array('boq_code'=>$nodoc,'title'=>$request->title,'nama_telkomsel'=>$request->nama_telkomsel,'posisi_telkomsel'=>$request->posisi_telkomsel,'nama_manager'=>$request->nama_manager,'posisi_manager'=>$request->posisi_manager,'nama_user'=>$request->nama_user,'posisi_user'=>$request->posisi_user,'project_id'=>$request->project_id,'message'=>$request->message,'status'=>$request->status,'area'=>Auth::guard('karyawan')->user()->area,'area2'=>Auth::guard('karyawan')->user()->area2);
$kata = 'SUBMIT BOQ '.$nodoc.'MENUNGGU APPROVAL ANDA';
$detailnya = $request->detailproject;
$emailusernya = array();

for($x=0;$x < count($detailnya);$x++) {
$ProjectStatus = ProjectStatus::create(['project_id' =>$detailnya[$x]['id'],'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);  
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','MANAGER']])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => $detailnya[$x]['id'], 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);
}
}
Project::where('id',$detailnya[$x]['id'])->update(['boq_status'=>15]);


}

BOQSubmit::create($masuk);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'boq_submit' ,'action' => 'insert', 'data' => json_encode($masuk)]);
$showUser2 = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','MANAGER']])->get();
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
$showUser = User::where(function ($query) {
    $query->where([['level', Auth::guard('karyawan')->user()->level],['posisi','ACCOUNT MANAGER'],['area',Input::get('area')]])
          ->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','ACCOUNT MANAGER'],['area2',Input::get('area2')]]);
})->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => $detailnya[$x]['id'], 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);
}
}
Project::where('id',$detailnya[$x]['id'])->update(['boq_status'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]);


}

BOQSubmit::where('id',Input::get('id'))->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'boq_submit' ,'action' => 'update', 'data' => json_encode($edit)]);
$showUser2 = User::where(function ($query) {
    $query->where([['level', Auth::guard('karyawan')->user()->level],['posisi','ACCOUNT MANAGER'],['area',Input::get('area')]])
          ->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','ACCOUNT MANAGER'],['area2',Input::get('area2')]]);
})->get();
if(count($showUser2) > 0)
{
foreach ($showUser2 as $p2) {  
//$this->SendEmailController->kirimBOQ($p2['email'],Input::get('title'),Input::get('nodoc'),Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,$detailnya,strtoupper($kata));

}
}

return response()->json(['success'=>'Successfully']);      
    }
else
    {
 return response()->json('error', $valid);
    }
    
    
    }


        public function SubmitBOQApprovalRevisi(Request $request)
    {
$valid = $this->validate($request, [ 
        'id' => 'required|numeric|not_in:0',
        'statusboq' => 'required|numeric',
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

$edit = array('title'=>Input::get('title'),'nama_telkomsel'=>Input::get('nama_telkomsel'),'posisi_telkomsel'=>Input::get('posisi_telkomsel'),'nama_manager'=>Input::get('nama_manager'),'posisi_manager'=>Input::get('posisi_manager'),'nama_user'=>Input::get('nama_user'),'posisi_user'=>Input::get('posisi_user'),'project_id'=>$request->project_id,'message'=>$request->message,'status'=>$request->statusboq); 
$detailnya = $request->detailproject;
$emailusernya = array();
for($x=0;$x < count($detailnya);$x++) {
$ProjectStatus = ProjectStatus::create(['project_id' =>$detailnya[$x]['id'],'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);  
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','ACCOUNT MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','ACCOUNT MANAGER'],['area2',Auth::guard('karyawan')->user()->area2]])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => $detailnya[$x]['id'], 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);
}
}
Project::where('id',$detailnya[$x]['id'])->update(['boq_status'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]);


}

$cancel_array = explode(",", $request->project_id_cancel);
$resultcancel = count($cancel_array);
if($resultcancel > 0)
{
Project::whereIn('id',explode(",", $request->project_id_cancel))->update(['boq_status'=>14]);
}



BOQSubmit::where('id',Input::get('id'))->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'boq_submit' ,'action' => 'update', 'data' => json_encode($edit)]);
$showUser2 = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','MANAGER']])->get();
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




        public function downloadPDFBOQ(Request $request)
    {
$header = $request->header;        
$detailproject =  $request->detailproject;     
 
$data = ['header'=>$header , 'detailproject'=>$detailproject];
PDF::setOptions(['dpi' => 150, 'defaultFont' => 'arial']);     
$pdf = PDF::loadView('Download.BOQ_PDF', $data)->setPaper('a3', 'landscape');

//return $pdf->stream('admission.pdf'); 
return $pdf->download($header['boq_code'].'.pdf');


    }


     public function GetBOQVerifikasi(Request $request,$id)
    {
       $perPage = $request->per_page;
       $kodenya =  explode(",",$id);
        $search = $request->filter; 
        $infratypenya = $request->infratypenya; 
        $towernya = $request->towernya; 
        $query =  DB::table('vallprojectboq') 
        ->whereIn('id',$kodenya)
        ->orderBy('id','DESC');

        if ($search && $infratypenya && $towernya) {
            $like = "%{$search}%";
            $query = $query->whereIn('id',$kodenya)
            ->where([['projectid', 'LIKE', $like],['infratype',$infratypenya],['tower_high',$towernya]])
            ->orWhere('regional', 'LIKE', $like);
        } 

        if (!$search && $infratypenya && $towernya) { 
            $query = $query->whereIn('id',$kodenya)
            ->where([['infratype',$infratypenya],['tower_high',$towernya]]);
        } 

        if (!$search && !$infratypenya && $towernya) { 
            $query = $query->whereIn('id',$kodenya)
            ->where('tower_high',$towernya);
        } 

        if (!$search && $infratypenya && !$towernya) { 
            $like = "%{$search}%";
            $query = $query->whereIn('id',$kodenya)
            ->where([['projectid', 'LIKE', $like],['tower_high',$towernya]])
            ->orWhere('regional', 'LIKE', $like);
        } 

        if ($search && $infratypenya && !$towernya) { 
            $like = "%{$search}%";
            $query = $query->whereIn('id',$kodenya)
            ->where([['projectid', 'LIKE', $like],['infratype',$infratypenya]])
            ->orWhere('regional', 'LIKE', $like);
        } 

        if ($search && !$infratypenya && !$towernya) { 
            $like = "%{$search}%";
             $query = $query->whereIn('id',$kodenya)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('regional', 'LIKE', $like);
        } 

        if (!$search && $infratypenya && !$towernya) { 
            $query = $query->whereIn('id',$kodenya)
            ->where('infratype',$infratypenya);
        } 

        if (!$search && !$infratypenya && $towernya) { 
            $query = $query->whereIn('id',$kodenya)
            ->where('tower_high',$towernya);
        } 

        return $query->paginate($perPage);
    }


     public function GetBOQProsesPR(Request $request,$id)
    {
       $perPage = $request->per_page;
       $kodenya =  explode(",",$id);
        $search = $request->filter; 
        $infratypenya = $request->infratypenya; 
        $towernya = $request->towernya; 
        $query =  DB::table('vallprojectboq') 
        ->whereIn('id',$kodenya)
        ->orderBy('id','DESC');

        if ($search && $infratypenya && $towernya) {
            $like = "%{$search}%";
            $query = $query->whereIn('id',$kodenya)
            ->where([['projectid', 'LIKE', $like],['infratype',$infratypenya],['tower_high',$towernya]])
            ->orWhere('regional', 'LIKE', $like);
        } 

        if (!$search && $infratypenya && $towernya) { 
            $query = $query->whereIn('id',$kodenya)
            ->where([['infratype',$infratypenya],['tower_high',$towernya]]);
        } 

        if (!$search && !$infratypenya && $towernya) { 
            $query = $query->whereIn('id',$kodenya)
            ->where('tower_high',$towernya);
        } 

        if (!$search && $infratypenya && !$towernya) { 
            $like = "%{$search}%";
            $query = $query->whereIn('id',$kodenya)
            ->where([['projectid', 'LIKE', $like],['tower_high',$towernya]])
            ->orWhere('regional', 'LIKE', $like);
        } 

        if ($search && $infratypenya && !$towernya) { 
            $like = "%{$search}%";
            $query = $query->whereIn('id',$kodenya)
            ->where([['projectid', 'LIKE', $like],['infratype',$infratypenya]])
            ->orWhere('regional', 'LIKE', $like);
        } 

        if ($search && !$infratypenya && !$towernya) { 
            $like = "%{$search}%";
             $query = $query->whereIn('id',$kodenya)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('regional', 'LIKE', $like);
        } 

        if (!$search && $infratypenya && !$towernya) { 
            $query = $query->whereIn('id',$kodenya)
            ->where('infratype',$infratypenya);
        } 

        if (!$search && !$infratypenya && $towernya) { 
            $query = $query->whereIn('id',$kodenya)
            ->where('tower_high',$towernya);
        } 

        return $query->paginate($perPage);
    }



     public function GetBOQPORelease(Request $request,$id)
    {
       $perPage = $request->per_page;
       $kodenya =  explode(",",$id);
        $search = $request->filter; 
        $infratypenya = $request->infratypenya; 
        $towernya = $request->towernya; 
        $query =  DB::table('vallprojectboq') 
        ->whereIn('id',$kodenya)
        ->orderBy('id','DESC');

        if ($search && $infratypenya && $towernya) {
            $like = "%{$search}%";
            $query = $query->whereIn('id',$kodenya)
            ->where([['projectid', 'LIKE', $like],['infratype',$infratypenya],['tower_high',$towernya]])
            ->orWhere('regional', 'LIKE', $like);
        } 

        if (!$search && $infratypenya && $towernya) { 
            $query = $query->whereIn('id',$kodenya)
            ->where([['infratype',$infratypenya],['tower_high',$towernya]]);
        } 

        if (!$search && !$infratypenya && $towernya) { 
            $query = $query->whereIn('id',$kodenya)
            ->where('tower_high',$towernya);
        } 

        if (!$search && $infratypenya && !$towernya) { 
            $like = "%{$search}%";
            $query = $query->whereIn('id',$kodenya)
            ->where([['projectid', 'LIKE', $like],['tower_high',$towernya]])
            ->orWhere('regional', 'LIKE', $like);
        } 

        if ($search && $infratypenya && !$towernya) { 
            $like = "%{$search}%";
            $query = $query->whereIn('id',$kodenya)
            ->where([['projectid', 'LIKE', $like],['infratype',$infratypenya]])
            ->orWhere('regional', 'LIKE', $like);
        } 

        if ($search && !$infratypenya && !$towernya) { 
            $like = "%{$search}%";
             $query = $query->whereIn('id',$kodenya)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('regional', 'LIKE', $like);
        } 

        if (!$search && $infratypenya && !$towernya) { 
            $query = $query->whereIn('id',$kodenya)
            ->where('infratype',$infratypenya);
        } 

        if (!$search && !$infratypenya && $towernya) { 
            $query = $query->whereIn('id',$kodenya)
            ->where('tower_high',$towernya);
        } 

        return $query->paginate($perPage);
    }


    public function SubmitBOQCancel(Request $request)
    {
$id = $request->id;        
$project_id= $request->project_id;  
 
$edit = ['project_id'=>null,'status'=>6]; 
BOQSubmit::where('id',$id)->update($edit);
Project::whereIn('id',explode(",",$project_id))->update(['boq_status'=>14]);

Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'boq_submit' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Successfully']); 

    }


        public function SubmitBOQApprovalVerifikasi(Request $request)
    {
        $id = $request->id;        
        $project_id= $request->project_id;  
        $status= $request->status;  
        $boq_status= $request->statusproject;  
         $edit = ['project_id'=>$project_id ,'status'=>$status , 'boq_status'=> $boq_status]; 
        BOQSubmit::where('id',$id)->update(['status'=>$status]);
        Project::whereIn('id',explode(",",$project_id))->update(['boq_status'=> $boq_status]);
        
        Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'boq_submit' ,'action' => 'update', 'data' => json_encode($edit)]);
        return response()->json(['success'=>'Successfully']);  
  

    }


    public function SubmitBOQApprovalVerifikasiByAdmin(Request $request)
    {
        $id = $request->id;        
        $project_id= $request->project_id;  
        $status= $request->status;  
        $boq_status= $request->statusproject;  
        $project_id_cancel= $request->project_id_cancel; 

        $cancel_array = explode(",", $request->project_id_cancel);
        $resultcancel = count($cancel_array);
        if($resultcancel > 0)
        {
        Project::whereIn('id',explode(",",$project_id_cancel))->update(['boq_status'=>14]);
        }

        $edit = ['project_id'=>$project_id ,'status'=>$status , 'boq_status'=> $boq_status]; 
        BOQSubmit::where('id',$id)->update(['project_id'=>$project_id,'status'=>$status]);
        Project::whereIn('id',explode(",",$project_id))->update(['boq_status'=> $boq_status]);
        
        Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'boq_submit' ,'action' => 'update', 'data' => json_encode($edit)]);
        return response()->json(['success'=>'Successfully']);  

    }


    public function SubmitBOQApprovalRevisiByAdmin(Request $request)
    {
$valid = $this->validate($request, [ 
        'id' => 'required|numeric|not_in:0',
        'statusboq' => 'required|numeric',
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

$edit = array('title'=>Input::get('title'),'nama_telkomsel'=>Input::get('nama_telkomsel'),'posisi_telkomsel'=>Input::get('posisi_telkomsel'),'nama_manager'=>Input::get('nama_manager'),'posisi_manager'=>Input::get('posisi_manager'),'nama_user'=>Input::get('nama_user'),'posisi_user'=>Input::get('posisi_user'),'project_id'=>$request->project_id,'message'=>$request->message,'status'=>$request->statusboq); 
$detailnya = $request->detailproject;
$emailusernya = array();
for($x=0;$x < count($detailnya);$x++) {
$ProjectStatus = ProjectStatus::create(['project_id' =>$detailnya[$x]['id'],'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);  
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','ACCOUNT MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','ACCOUNT MANAGER'],['area2',Auth::guard('karyawan')->user()->area2]])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => $detailnya[$x]['id'], 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);
}
}
Project::where('id',$detailnya[$x]['id'])->update(['boq_status'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]);


}

$cancel_array = explode(",", $request->project_id_cancel);
$resultcancel = count($cancel_array);
if($resultcancel > 0)
{
Project::whereIn('id',explode(",", $request->project_id_cancel))->update(['boq_status'=>14]);
}



BOQSubmit::where('id',Input::get('id'))->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'boq_submit' ,'action' => 'update', 'data' => json_encode($edit)]);
  
return response()->json(['success'=>'Successfully']);      
    }
else
    {
 return response()->json('error', $valid);
    }
    
    
    }    



    /*

        public function SubmitBOQApprovalProsesPR(Request $request)
    {
$id = $request->id;        
$project_id_verifikasi = $request->project_id_verifikasi;  
$cek = BOQSubmit::where('id',$id)->first();
if($cek->project_id_proses_pr == null OR $cek->project_id_proses_pr == '')
{
    $project_id_proses_pr =  $request->project_id_proses_pr;
}
else
{
    $parts = explode(',', $request->project_id_proses_pr);
    $parts[] = $cek->project_id_proses_pr;
    $project_id_proses_pr = implode(',', $parts);
}   
     

$project_id_verifikasi_Array = explode(",",$project_id_verifikasi);
$project_id_proses_pr_Array = explode(",",$project_id_proses_pr);
for($x=0;$x < count($project_id_proses_pr_Array) ; $x++) {
$deleteKey = array_search($project_id_proses_pr_Array[$x],$project_id_verifikasi_Array);
Project::where('id',$project_id_proses_pr_Array[$x])->update(['boq_status'=>19]);
unset($project_id_verifikasi_Array[$deleteKey]);
}

$project_id_verifikasi_update = implode(",",$project_id_verifikasi_Array);

$edit = ['project_id_verifikasi'=>$project_id_verifikasi_update,'project_id_proses_pr'=>$project_id_proses_pr]; 

BOQSubmit::where('id',$id)->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'boq_submit' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Successfully']); 

    }



        public function SubmitBOQApprovalPORelease(Request $request)
    {
$id = $request->id;        
$project_id_proses_pr = $request->project_id_proses_pr;  
$cek = BOQSubmit::where('id',$id)->first();
if($cek->project_id_po_release == null OR $cek->project_id_po_release == '')
{
    $project_id_po_release =  $request->project_id_po_release;
}
else
{
    $parts = explode(',', $request->project_id_po_release);
    $parts[] = $cek->project_id_po_release;
    $project_id_po_release = implode(',', $parts);
}   
     

$project_id_proses_pr_Array = explode(",",$project_id_proses_pr);
$project_id_po_release_Array = explode(",",$project_id_po_release);
for($x=0;$x < count($project_id_po_release_Array) ; $x++) {
$deleteKey = array_search($project_id_po_release_Array[$x],$project_id_proses_pr_Array);
Project::where('id',$project_id_po_release_Array[$x])->update(['boq_status'=>20]);
unset($project_id_proses_pr_Array[$deleteKey]);
}

$project_id_proses_pr_update = implode(",",$project_id_proses_pr_Array);

$edit = ['project_id_proses_pr'=>$project_id_proses_pr_update,'project_id_po_release'=>$project_id_po_release]; 

BOQSubmit::where('id',$id)->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'boq_submit' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Successfully']); 

    }

*/
}