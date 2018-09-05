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
use App\Models\BaksBauk;
use App\Models\BoqBaps;
use App\Models\Baps;

class BapsController extends Controller
{
        public function __construct()
    {
        $this->middleware('karyawan.auth');
        $this->data['title']  = 'Selamat Datang';
        $this->SendEmailController = app('App\Http\Controllers\SendEmailController');
    $this->data['tahunproject']  = DB::table('vtahun')->get();
    }

  public function AddDocumentBaps(Request $request)
    {
$cekdata = Baps::where('project_id',$request->project_id)->first();
if (count($cekdata) > 0) 
{ 
	return response()->json(['error'=>'Opps Something Wrong']);
}
else
{
      $valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:baps,project_id', 
        'projectid' => 'required|max:255', 
        'tgL_akhir_sewa' => 'required|date|date_format:Y-m-d', 
        'document_baps' => 'required|mimes:pdf', 
    ]);
if (!$valid)
{
$file = Input::file('document_baps'); 
$extension  = Input::file('document_baps')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-baps-'.time().'.'.$extension;
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
Baps::create(['project_id'=>$request->project_id,'tgL_akhir_sewa'=>$request->tgL_akhir_sewa,'document_baps'=>$fileName]);
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('kata'))]);
  Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]);
  return response()->json(['success'=>'Add Successfully']);
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
    }

  public function RevisiDocumentBaps(Request $request)
    {
$cekdata = BoqBaps::where('id',$request->id)->first();
if (count($cekdata) > 0) 
{
      $valid = $this->validate($request, [
        'projectid' => 'required|max:255', 
        'namafile' => 'required', 
        'tgL_akhir_sewa' => 'required|date|date_format:Y-m-d', 
    ]);
if (!$valid)
{
$file = Input::file('document_baps');

if($file)
{
$extension  = Input::file('document_baps')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-baps-'.time().'.'.$extension;
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
Baps::where('id',$request->id)->update(['tgL_akhir_sewa'=>$request->tgL_akhir_sewa,'document_baps'=>$fileName]);
  File::delete($destinationPath .$request->namafile);
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('kata'))]);
  Project::where('id',Input::get('project_id'))->update(['project_status_id'=>$ProjectStatus->id]);
  return response()->json(['success'=>'Add Successfully']);
}



}
else
{
return response()->json(['errorfile'=>'Please, check your file type / size']);  
}
}
else
{

Baps::where('id',$request->id)->update(['tgL_akhir_sewa'=>$request->tgL_akhir_sewa]);
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('kata'))]);
  Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]);
  return response()->json(['success'=>'Add Successfully']);


}

}
else
    {
 return response()->json('error', $valid);
    }

}
else
{
  return response()->json(['error'=>'Silahkan Isi form Proses Sebelumnya']);
}
    }







}