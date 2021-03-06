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
use PHPExcel; 
use PHPExcel_IOFactory;
use Illuminate\Support\Facades\URL;


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

    
    public function UpdateCMEBtachAccrueDateByAdmin(Request $request)
    {
        $id = $request->id;        
        $project_id= $request->project_id;   
        $cme_code= $request->cme_code;   
        $batch_accrue= $request->batch_accrue;  
         $edit = ['project_id'=>$project_id ,'batch_accrue'=>$batch_accrue];  
        Project::whereIn('id',explode(",",$project_id))->update(['batch_accrue'=> $batch_accrue]); 
        Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'cme_submit' ,'action' => 'update', 'data' => json_encode($edit)]);
        return response()->json(['success'=>'Successfully']);  
  
    }


    public function SubmitCMEToAccruedByAdmin(Request $request)
    {
        $id = $request->id;        
        $project_id= $request->project_id;   
        $cme_code= $request->cme_code;  
        $status= $request->status;  
        $haki_status= $request->haki_status;  
         $edit = ['project_id'=>$project_id ,'status'=>$status , 'haki_status'=> $haki_status]; 
         CMESubmit::where('id',$id)->update(['project_id'=>$project_id  , 'status'=> $status]);
        Project::whereIn('id',explode(",",$project_id))->update(['haki_status'=> $haki_status]); 
        Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'cme_submit' ,'action' => 'update', 'data' => json_encode($edit)]);
        return response()->json(['success'=>'Successfully']);  
  
    }


    public function CancelCMEAccrualMassal(Request $request)
    {
        $id = $request->id;        
        $project_id= $request->project_id;   
        $cme_code= $request->cme_code;  
        $status= $request->status;  
        $haki_status= $request->haki_status;  
         $edit = ['project_id'=>$project_id ,'status'=>$status , 'haki_status'=> $haki_status]; 
         CMESubmit::where('id',$id)->update(['project_id'=>null,'status'=>$status , 'status'=> $status]);
        Project::whereIn('id',explode(",",$project_id))->update(['haki_status'=> $haki_status]); 
        Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'cme_submit' ,'action' => 'update', 'data' => json_encode($edit)]);
        return response()->json(['success'=>'Successfully']);  
  
    }

    public function SubmitCMEToAccrued(Request $request)
    {
        $id = $request->id;        
        $project_id= $request->project_id;   
        $cme_code= $request->cme_code;  
        $status= $request->status;  
        $haki_status= $request->haki_status;  
         $edit = ['project_id'=>$project_id ,'status'=>$status , 'haki_status'=> $haki_status]; 
         CMESubmit::where('id',$id)->update(['project_id'=>$project_id  , 'status'=> $status]);
        Project::whereIn('id',explode(",",$project_id))->update(['haki_status'=> $haki_status]);
        //$this->saveData($cme_code, $project_id);
        Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'cme_submit' ,'action' => 'update', 'data' => json_encode($edit)]);
        return response()->json(['success'=>'Successfully']);  
  
    }



    
    public function saveData($cme_code, $project_id)
    { 

$fileName = Carbon::now().$cme_code;
$datanya =  DB::table('vallproject')->whereIn('id',explode(",",$project_id))->get();
$rubahfile = str_replace("/","_",$fileName);
$destinationPath = 'busdevReport/'.$rubahfile.'.xls'; // save path


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Add column headers
$objPHPExcel->getActiveSheet()
            ->setCellValue('A1', 'KODE ACCRUAL : ')
            ->setCellValue('B1', $fileName)
            ->setCellValue('A3', 'NO')
            ->setCellValue('B3', 'PROJECTID')
            ->setCellValue('C3', 'BATCH')
            ->setCellValue('D3', 'PO NO')
            ->setCellValue('E3', 'PO DATE')
            ->setCellValue('F3', 'SITE NAME SPK')
            ->setCellValue('G3', 'SITE ID SPK')
            ->setCellValue('H3', 'SITE NAME AKTUAL')
            ->setCellValue('I3', 'SITE ID AKTUAL')
            ->setCellValue('J3', 'AREA')
            ->setCellValue('K3', 'REGION')
            ->setCellValue('L3', 'SOW')
            ->setCellValue('M3', 'RFI DATE')
            ->setCellValue('N3', 'START MASA SEWA')
            ->setCellValue('O3', 'AKHIR MASA SEWA')
            ->setCellValue('P3', 'PRICE / MONTH')
            ->setCellValue('Q3', 'PRICE / YEARS')
            ->setCellValue('R3', 'NILAI REVENUE')
            ->setCellValue('S3', 'BATCH ACCRUE') 
            ->setCellValue('T3', 'URL Detail') 
            ;

$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true); 
$objPHPExcel->getActiveSheet()->getStyle('A3:T3')->getFont()->setBold(true); 

$no=1;
$row=4;
$jml=0;
//Put each record in a new cell
foreach ($datanya as $key=>$a){ 
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $no);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,  $a->projectid);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $a->batchnya);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,  $a->no_po);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $a->po_date);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,  $a->site_name_spk);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,  $a->site_id_spk);
    $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,  $a->site_name_actual);
    $objPHPExcel->getActiveSheet()->setCellValue('I'.$row,  $a->site_id_actual);
    $objPHPExcel->getActiveSheet()->setCellValue('J'.$row, 'AREA '.$a->area);
    $objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $a->regional);
    $objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $a->infratype);
    $objPHPExcel->getActiveSheet()->setCellValue('M'.$row, $a->rfi_date);
    $objPHPExcel->getActiveSheet()->setCellValue('N'.$row,$a->rfi_detail_start_date);
    $objPHPExcel->getActiveSheet()->setCellValue('O'.$row, $a->rfi_detail_end_date);
    $objPHPExcel->getActiveSheet()->setCellValue('P'.$row, $a->rfi_detail_price_month);
    $objPHPExcel->getActiveSheet()->setCellValue('Q'.$row, $a->rfi_detail_price_year);
    $objPHPExcel->getActiveSheet()->setCellValue('R'.$row, $a->nilai_revenue);
    $objPHPExcel->getActiveSheet()->setCellValue('S'.$row, $a->batch_accrue);
    $objPHPExcel->getActiveSheet()->setCellValue('T'.$row, url('/detail-project#/pidnya/'.$a->projectid));
$no++; 
$row++;  
$jml = $a->nilai_revenue + $jml; 
}

$rowLast=count($datanya)+4;
 $objPHPExcel->getActiveSheet()->setCellValue('Q'.$rowLast, 'TOTAL : ');
 $objPHPExcel->getActiveSheet()->setCellValue('R'.$rowLast, $jml);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$rowLast.':R'.$rowLast)->getFont()->setBold(true);

// Set worksheet title
$objPHPExcel->getActiveSheet()->setTitle('Sheet1');

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save($destinationPath);


$this->SendEmailController->kirimCMEAccured($destinationPath, $fileName,Auth::guard('karyawan')->user()->name);

    }
/*
        public function SubmitCMEToAccrued(Request $request)
    {
$id = $request->id;        
$project_id_accrual = $request->project_id_accrual;  
$cek = CMESubmit::where('id',$id)->first();
if($cek->project_id_accrued == null OR $cek->project_id_accrued == '')
{
    $project_id_accrued =  $request->project_id_accrued;
}
else
{
    $parts = explode(',', $request->project_id_accrued);
    $parts[] = $cek->project_id_accrued;
    $project_id_accrued = implode(',', $parts);
}   
     

$project_id_accrual_Array = explode(",",$project_id_accrual);
$project_id_accrued_Array = explode(",",$project_id_accrued);
for($x=0;$x < count($project_id_accrued_Array) ; $x++) {
$deleteKey = array_search($project_id_accrued_Array[$x],$project_id_accrual_Array);
Project::where('id',$project_id_accrued_Array[$x])->update(['haki_status'=>48]);
unset($project_id_accrual_Array[$deleteKey]);
}

$project_id_accrual_update = implode(",",$project_id_accrual_Array);

$edit = ['project_id_accrual'=>$project_id_accrual_update,'project_id_accrued'=>$project_id_accrued]; 

CMESubmit::where('id',$id)->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'cme_submit' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Successfully']); 

    }

*/
 

     public function GetCMEAccruedData(Request $request,$id)
    {
       $perPage = $request->per_page;
       $kodenya =  explode(",",$id);
        $search = $request->filter; 
        $infratypenya = $request->infratypenya; 
        $towernya = $request->towernya; 
        $query =  DB::table('vallproject') 
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


     public function GetCMEAccruedDataNya(Request $request,$id)
    {
       $perPage = $request->per_page;
       $kodenya =  explode(",",$id);
        $search = $request->filter; 
        $infratypenya = $request->infratypenya; 
        $towernya = $request->towernya; 
        $query =  DB::table('vallprojectaccrued') 
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

    
    public function UpdateCMEAccrualByAdmin(Request $request)
    { 
     $valid = $this->validate($request, [
        'project_id' => 'required|numeric|not_in:0',   
        'statusmessage' => 'required',   
        'document' => 'required',   
        'kata' => 'required',   
        'detailproject' => 'required',   
        'message' => 'required',   
        'kodeproject' => 'required',   
        'status' => 'required|numeric|not_in:0',
        'statuscme' => 'required|numeric',
    ]);
    
if (!$valid)
    {
$detailnya = $request->detailproject;
for($x=0;$x < count($detailnya);$x++) {
$ProjectStatus = ProjectStatus::create(['project_id' =>$detailnya[$x]['id'],'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);  
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area2',Auth::guard('karyawan')->user()->area2]])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => $detailnya[$x]['id'], 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);
}
}
Project::where('id',$detailnya[$x]['id'])->update(['haki_status'=>Input::get('status'),'batch_accrue'=>Input::get('batch_accrue')]);


}

CMESubmit::where('id',Input::get('project_id'))->update(['status'=>Input::get('statuscme'),'project_id'=>Input::get('kodeproject'),'message'=>Input::get('message')]);
  

return response()->json(['success'=>'Successfully']);



    }
else{
    return response()->json('error', $valid);
}
    }

        public function UpdateCMEAccrual(Request $request)
    { 
     $valid = $this->validate($request, [
        'project_id' => 'required|numeric|not_in:0',   
        'statusmessage' => 'required',   
        'document' => 'required',   
        'kata' => 'required',   
        'detailproject' => 'required',   
        'message' => 'required',   
        'kodeproject' => 'required',   
        'status' => 'required|numeric|not_in:0',
        'statuscme' => 'required|numeric',
    ]);
    
if (!$valid)
    {
$detailnya = $request->detailproject;
for($x=0;$x < count($detailnya);$x++) {
$ProjectStatus = ProjectStatus::create(['project_id' =>$detailnya[$x]['id'],'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);  
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area2',Auth::guard('karyawan')->user()->area2]])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => $detailnya[$x]['id'], 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);
}
}
Project::where('id',$detailnya[$x]['id'])->update(['haki_status'=>Input::get('status')]);


}

CMESubmit::where('id',Input::get('project_id'))->update(['status'=>Input::get('statuscme'),'project_id'=>Input::get('kodeproject'),'message'=>Input::get('message')]);
 
$showUser2 = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area2',Auth::guard('karyawan')->user()->area2]])->get();
if(count($showUser2) > 0)
{
/*foreach ($showUser2 as $p2) {  
$this->SendEmailController->kirimCME($p2['email'],$nodoc,Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,$detailnya,strtoupper($kata));

}*/
}

return response()->json(['success'=>'Successfully']);



    }
else{
    return response()->json('error', $valid);
}
    }


        public function UpdateCMEAccrualRevisi(Request $request)
    { 
        $cme_submit_id = $request->cme_submit_id;
        $project_id = $request->project_id;

Project::whereIn('id',explode(",",$project_id))->update(['haki_status'=>46]);
CMESubmit::where('id',$cme_submit_id)->update(['project_id'=>$project_id]);  
return response()->json(['success'=>'Successfully']);      
    }


        public function CancelCMEAccrual(Request $request)
    {
        $projectid = $request->id;
        $cme_submit_id = $request->cme_submit_id;
        $project_id = $request->project_id;

Project::where('id',$projectid)->update(['haki_status'=>44]);
CMESubmit::where('id',$cme_submit_id)->update(['project_id'=>$project_id]);  
return response()->json(['success'=>'Successfully']);      
    }


        public function ApprovalDocumentCMEManagerHaki(Request $request)
    {
     $valid = $this->validate($request, [
        'project_id' => 'required|numeric|not_in:0',   
        'statusmessage' => 'required',   
        'document' => 'required',   
        'kata' => 'required',   
        'detailproject' => 'required',      
        'message' => 'required',   
        'status' => 'required|numeric|not_in:0',
        'statuscme' => 'required|numeric|not_in:0',
    ]);
    
if (!$valid)
    {
$detailnya = $request->detailproject;
for($x=0;$x < count($detailnya);$x++) {
$ProjectStatus = ProjectStatus::create(['project_id' =>$detailnya[$x]['id'],'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);  
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - ACCOUNT MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - ACCOUNT MANAGER'],['area2',Auth::guard('karyawan')->user()->area2]])->get();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => $detailnya[$x]['id'], 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);
}
}
Project::where('id',$detailnya[$x]['id'])->update(['haki_status'=>Input::get('status'),'batch_accrue'=>Input::get('batch_accrue')]);


}

CMESubmit::where('id',Input::get('project_id'))->update(['status'=>Input::get('statuscme'),'message'=>Input::get('message')]);
 
$showUser2 = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - ACCOUNT MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - ACCOUNT MANAGER'],['area2',Auth::guard('karyawan')->user()->area2]])->get();
if(count($showUser2) > 0)
{
/*foreach ($showUser2 as $p2) {  
$this->SendEmailController->kirimCME($p2['email'],$nodoc,Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,$detailnya,strtoupper($kata));

}*/
}

return response()->json(['success'=>'Successfully']);



    }
else{
    return response()->json('error', $valid);
}

    }




        public function SubmitCMEAccrual(Request $request)
    {
$valid = $this->validate($request, [
        'project_id' => 'required',   
        'message' => 'required',   
        'status' => 'required|numeric',
        'projectstatus' => 'required|numeric|not_in:0'
    ]);

if (!$valid)
    {

$array_bulan = array(1=>"JANUARI","FEBUARI","MARET", "APRIL", "MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER", "NOVEMBER","DESEMBER");
$nodoc = 'ACCRUAL/'.$array_bulan[Carbon::now()->month].'/'.Carbon::now()->year;
$masuk = array('cme_code'=>$nodoc , 'project_id'=>$request->project_id,'area'=>Auth::guard('karyawan')->user()->area, 'area2'=>Auth::guard('karyawan')->user()->area2 , 'status'=>$request->status , 'message'=>$request->message);
$kata = 'CME ACCRUAL '.$nodoc.' MENUNGGU APPROVAL ANDA';
$detailnya = $request->detailproject;

for($x=0;$x < count($detailnya);$x++) {
$ProjectStatus = ProjectStatus::create(['project_id' =>$detailnya[$x]['id'],'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('message'))]);  
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area2',Auth::guard('karyawan')->user()->area2]])->get();
if(count($showUser) > 0)
{
/*foreach ($showUser as $p) {
Pesan::create(['project_id' => $detailnya[$x]['id'], 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);
}*/
}
Project::where('id',$detailnya[$x]['id'])->update(['haki_status'=>45]);


}

CMESubmit::create($masuk);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'cme_submit' ,'action' => 'insert', 'data' => json_encode($masuk)]);
$showUser2 = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area2',Auth::guard('karyawan')->user()->area2]])->get();
if(count($showUser2) > 0)
{
foreach ($showUser2 as $p2) {  
//$this->SendEmailController->kirimCME($p2['email'],$nodoc,Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,$detailnya,strtoupper($kata));

}
}

return response()->json(['success'=>'Successfully']);

    }
    else
    {
        return response()->json('error', $valid);
    }
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
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area2',Auth::guard('karyawan')->user()->area2]])->get();
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
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - ACCOUNT MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - ACCOUNT MANAGER'],['area2',Auth::guard('karyawan')->user()->area2]])->get();
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
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area',Auth::guard('karyawan')->user()->area]])->orWhere([['level', Auth::guard('karyawan')->user()->level],['posisi','HAKI - MANAGER'],['area2',Auth::guard('karyawan')->user()->area2]])->get();
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


    public function RevisiDocumentRFIDetailByAdmin(Request $request)
    {
        if(Input::get('id') == 0)
        {
            $valid = $this->validate($request, [
                'project_id' => 'required|max:255|unique:rfi_detail,project_id', 
                'projectid' => 'required|max:255',
                'rfi_detail_start_date' => 'required|date|date_format:Y-m-d',
                'rfi_detail_end_date' => 'required|date|date_format:Y-m-d',
                'rfi_detail_price_month' => 'required|numeric|not_in:0', 
                'rfi_detail_price_year' => 'required|numeric|not_in:0',   
            ]);
            if (!$valid)
            {
 $masuk = array('project_id' => $request->project_id, 'rfi_detail_start_date' => $request->rfi_detail_start_date, 'rfi_detail_end_date' => $request->rfi_detail_end_date, 'rfi_detail_price_month' => $request->rfi_detail_price_month, 'rfi_detail_price_year' => $request->rfi_detail_price_year); 
RfiDetail::create($masuk);
//Project::where('id',Input::get('project_id'))->update(['status_id'=>44]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'rfi_detail' ,'action' => 'insert', 'data' => json_encode($masuk)]);
$project = DB::table('vallproject')->where('id',Input::get('project_id'))->first();
return response()->json(['success'=>'Add Successfully','project'=>$project]);
            }
            else
            {
                return response()->json('error', $valid);
            }
        }
        else
        {
            $valid = $this->validate($request, [
                'project_id' => 'required|max:255|unique:rfi_detail,project_id,'.$request->id, 
                'projectid' => 'required|max:255',
                'rfi_detail_start_date' => 'required|date|date_format:Y-m-d',
                'rfi_detail_end_date' => 'required|date|date_format:Y-m-d',
                'rfi_detail_price_month' => 'required|numeric|not_in:0', 
                'rfi_detail_price_year' => 'required|numeric|not_in:0',   
            ]);
            if (!$valid)
            {
 $edit = array('rfi_detail_start_date' => $request->rfi_detail_start_date, 'rfi_detail_end_date' => $request->rfi_detail_end_date, 'rfi_detail_price_month' => $request->rfi_detail_price_month, 'rfi_detail_price_year' => $request->rfi_detail_price_year); 

 RfiDetail::where('id',Input::get('id'))->update($edit);
//Project::where('id',Input::get('project_id'))->update(['status_id'=>44]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'rfi_detail' ,'action' => 'update', 'data' => json_encode($edit)]);
$project = DB::table('vallproject')->where('id',Input::get('project_id'))->first();
return response()->json(['success'=>'Edit Successfully','project'=>$project]);
            }
            else
            {
                return response()->json('error', $valid);
            }
        }

    }



}