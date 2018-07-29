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

class DokumenSITACController extends Controller
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
    }

    
   public function upload(Request $request)
    {
$cekdata = DB::table('vjobsdocumentsitacrevisi')->where('id',Input::get('project_id'))->first();
if ($cekdata->status_id == '9') {
$valid = $this->validate($request, [
        'id' => 'required|numeric|not_in:0', 
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'document_ban_bak' => 'required|mimes:pdf', 
    ]);
if (!$valid)
    {
$file = Input::file('document_ban_bak'); 
$extension  = Input::file('document_ban_bak')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-ban-bak-'.time().'.'.$extension;
    if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    }
$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
File::delete($destinationPath .$fileName);
 return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
 File::delete($destinationPath .Input::get('namafile'));
  DokumenSITAC::where('id',Input::get('id'))->update(['document_ban_bak'=>$fileName]);
  return response()->json(['success'=>'Upload Successfully' , 'namafilenya'=>$fileName]);
}



}
else
{
return response()->json(['errorfile'=>'Please, check your file type / size']);  
}
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


   public function uploadIjinWarga(Request $request)
    {
$cekdata = DB::table('vjobsdocumentsitacrevisi')->where('id',Input::get('project_id'))->first();
if ($cekdata->status_id == '9') {
$valid = $this->validate($request, [
        'id' => 'required|numeric|not_in:0', 
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'document_ijin_warga' => 'required|mimes:pdf', 
    ]);
if (!$valid)
    {
$file = Input::file('document_ijin_warga'); 
$extension  = Input::file('document_ijin_warga')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-ijin-warga-'.time().'.'.$extension;
    if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    }
$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
File::delete($destinationPath .$fileName);
 return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
 File::delete($destinationPath .Input::get('namafile'));
  DokumenSITAC::where('id',Input::get('id'))->update(['document_ijin_warga'=>$fileName]);
  return response()->json(['success'=>'Upload Successfully' , 'namafilenya'=>$fileName]);
}



}
else
{
return response()->json(['errorfile'=>'Please, check your file type / size']);  
}
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

   public function uploadPKS(Request $request)
    {
$cekdata = DB::table('vjobsdocumentsitacrevisi')->where('id',Input::get('project_id'))->first();
if ($cekdata->status_id == '9') {
$valid = $this->validate($request, [
        'id' => 'required|numeric|not_in:0', 
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'document_pks' => 'required|mimes:pdf', 
    ]);
if (!$valid)
    {
$file = Input::file('document_pks'); 
$extension  = Input::file('document_pks')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-pks-'.time().'.'.$extension;
    if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    }
$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
File::delete($destinationPath .$fileName);
 return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
 File::delete($destinationPath .Input::get('namafile'));
  DokumenSITAC::where('id',Input::get('id'))->update(['document_pks'=>$fileName]);
  return response()->json(['success'=>'Upload Successfully' , 'namafilenya'=>$fileName]);
}



}
else
{
return response()->json(['errorfile'=>'Please, check your file type / size']);  
}
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


   public function uploadIMB(Request $request)
    {
$cekdata = DB::table('vjobsdocumentsitacrevisi')->where('id',Input::get('project_id'))->first();
if ($cekdata->status_id == '9') {
$valid = $this->validate($request, [
        'id' => 'required|numeric|not_in:0', 
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'document_imb' => 'required|mimes:pdf', 
    ]);
if (!$valid)
    {
$file = Input::file('document_imb'); 
$extension  = Input::file('document_imb')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-imb-'.time().'.'.$extension;
    if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    }
$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
File::delete($destinationPath .$fileName);
 return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
 File::delete($destinationPath .Input::get('namafile'));
  DokumenSITAC::where('id',Input::get('id'))->update(['document_imb'=>$fileName]);
  return response()->json(['success'=>'Upload Successfully' , 'namafilenya'=>$fileName]);
}



}
else
{
return response()->json(['errorfile'=>'Please, check your file type / size']);  
}
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


        public function store(Request $request)
    {
$cekdata = DokumenSITAC::where('project_id',Input::get('project_id'))->first();
if (!$cekdata) {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:document_sitac,project_id',
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'no_ban_bak' => 'required|max:255',
        'date_ban_bak' => 'required|date|date_format:Y-m-d',
        'document_ban_bak' => 'required',
        'ijin_warga_date' => 'required|date|date_format:Y-m-d',
        'document_ijin_warga' => 'required',
        'no_pks' => 'required|max:255',  
        'pks_date' => 'required|date|date_format:Y-m-d', 
        'document_pks' => 'required', 
        'no_imb' => 'required|max:255',
        'imb_date' => 'required|max:255',
        'document_imb' => 'required',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
$file = Input::file('document_ban_bak');
$filedocument_ijin_warga = Input::file('document_ijin_warga');
$filedocument_pks = Input::file('document_pks');
$filedocument_imb = Input::file('document_imb');
$extension  = Input::file('document_ban_bak')->getClientOriginalExtension(); 
$extensiondocument_ijin_warga  = Input::file('document_ijin_warga')->getClientOriginalExtension(); 
$extensiondocument_pks  = Input::file('document_pks')->getClientOriginalExtension(); 
$extensiondocument_imb  = Input::file('document_imb')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $filedrm->getSize() <= 10000000 && $filedrm->getClientMimeType() == 'application/pdf')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
$fileName   = Input::get('projectid').'-document-ban-bak-'.time().'.'.$extension; 
$fileNamedocument_ijin_warga   = Input::get('projectid').'-document-ijin-warga-'.time().'.'.$extensiondocument_ijin_warga; 
$fileNamedocument_pks   = Input::get('projectid').'-document-pks-'.time().'.'.$extensiondocument_pks; 
$fileNamedocument_imb   = Input::get('projectid').'-document-imb-'.time().'.'.$extensiondocument_imb; 


if(file_exists($destinationPath.$fileName) || file_exists($destinationPath.$fileNamedocument_ijin_warga) || file_exists($destinationPath.$fileNamedocument_pks) || file_exists($destinationPath.$fileNamedocument_imb))
    {
File::delete($destinationPath .$fileName);
File::delete($destinationPath .$fileNamedocument_ijin_warga);
File::delete($destinationPath .$fileNamedocument_pks);
File::delete($destinationPath .$fileNamedocument_imb);
    }   
    else
    {
$upload_success     = $file->move($destinationPath, $fileName);
$upload_success_ijin_warga     = $filedocument_ijin_warga->move($destinationPath, $fileNamedocument_ijin_warga);
$upload_success_pks     = $filedocument_pks->move($destinationPath, $fileNamedocument_pks);
$upload_success_imb     = $filedocument_imb->move($destinationPath, $fileNamedocument_imb);
if(!$upload_success || !$upload_success_ijin_warga || !$upload_success_pks || !$upload_success_imb)
{
File::delete($destinationPath .$fileName);
File::delete($destinationPath .$fileNamedocument_ijin_warga);
File::delete($destinationPath .$fileNamedocument_pks);
File::delete($destinationPath .$fileNamedocument_imb);
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
$masuk = array('project_id' => $request->project_id,'no_ban_bak' => $request->no_ban_bak,'date_ban_bak' => $request->date_ban_bak,'document_ban_bak' =>$fileName ,'ijin_warga_date' => $request->ijin_warga_date, 'document_ijin_warga' =>$fileNamedocument_ijin_warga, 'no_pks' => $request->no_pks, 'pks_date' => $request->pks_date, 'document_pks' => $fileNamedocument_pks, 'no_imb' => $request->no_imb, 'imb_date' => $request->imb_date, 'document_imb' => $fileNamedocument_imb); 
DokumenSITAC::create($masuk);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_sitac' ,'action' => 'insert', 'data' => json_encode($masuk)]);
return response()->json(['success'=>'Successfully']); 
}

    }
}
else
{
    return response()->json(['error'=>'Please, check your file type / size']); 
}
        
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




    public function update(Request $request)
    { 
$cekdata = DB::table('vjobsdocumentsitacrevisi')->where('id',Input::get('project_id'))->first();
if ($cekdata->status_id == '9') {
$valid = $this->validate($request, [ 
        'project_id' => 'required|max:255|unique:document_sitac,project_id,'.Input::get('documentsitacid'),
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'no_ban_bak' => 'required|max:255',
        'date_ban_bak' => 'required|date|date_format:Y-m-d',
        'ijin_warga_date' => 'required|date|date_format:Y-m-d',
        'no_pks' => 'required|max:255',  
        'pks_date' => 'required|date|date_format:Y-m-d', 
        'no_imb' => 'required|max:255',
        'imb_date' => 'required|max:255',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
{

$edit = array('project_id' => $request->project_id,'no_ban_bak' => $request->no_ban_bak,'date_ban_bak' => $request->date_ban_bak,'ijin_warga_date' => $request->ijin_warga_date, 'no_pks' => $request->no_pks, 'pks_date' => $request->pks_date, 'no_imb' => $request->no_imb, 'imb_date' => $request->imb_date);  
DokumenSITAC::where('id',Input::get('documentsitacid'))->update($edit);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_sitac' ,'action' => 'update', 'data' => json_encode($edit)]);
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
