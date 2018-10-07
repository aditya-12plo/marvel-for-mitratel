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

class BaksBaukController extends Controller
{
        public function __construct()
    {
        $this->middleware('karyawan.auth');
        $this->data['title']  = 'Selamat Datang';
        $this->SendEmailController = app('App\Http\Controllers\SendEmailController');
    $this->data['tahunproject']  = DB::table('vtahun')->get();
    }


    public function RevisiDocumentBaksBauk(Request $request)
    {  
$valid = $this->validate($request, [  
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'no_baks' => 'required|max:255',
        'date_baks' => 'required|date|date_format:Y-m-d',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
{

$edit = array('no_baks' => $request->no_baks,'date_baks' => $request->date_baks);  
BaksBauk::where('id',Input::get('baksbaukid'))->update($edit);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'baks_bauk' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Successfully']);
}
else
    {
 return response()->json('error', $valid);
    }
  
 
    }

   public function uploaddokumenBaks(Request $request)
    {
 
$valid = $this->validate($request, [
        'id' => 'required|numeric|not_in:0', 
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'document_baks' => 'required|mimes:pdf', 
    ]);
if (!$valid)
    {
$file = Input::file('document_baks'); 
$extension  = Input::file('document_baks')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-baks-'.time().'.'.$extension;
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
  BaksBauk::where('id',Input::get('id'))->update(['document_baks'=>$fileName]);
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




   public function uploaddokumenWctr(Request $request)
    {
 
$valid = $this->validate($request, [
        'id' => 'required|numeric|not_in:0', 
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'document_wctr' => 'required|mimes:pdf', 
    ]);
if (!$valid)
    {
$file = Input::file('document_wctr'); 
$extension  = Input::file('document_wctr')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-wctr-'.time().'.'.$extension;
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
  BaksBauk::where('id',Input::get('id'))->update(['document_wctr'=>$fileName]);
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




   public function uploaddokumenBoqProject(Request $request)
    {
 
$valid = $this->validate($request, [
        'id' => 'required|numeric|not_in:0', 
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'document_boq_project' => 'required|mimes:pdf', 
    ]);
if (!$valid)
    {
$file = Input::file('document_boq_project'); 
$extension  = Input::file('document_boq_project')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-boq-project-'.time().'.'.$extension;
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
  BaksBauk::where('id',Input::get('id'))->update(['document_boq_project'=>$fileName]);
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




   public function uploaddokumenRfiCertificate(Request $request)
    {
 
$valid = $this->validate($request, [
        'id' => 'required|numeric|not_in:0', 
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'document_rfi_certificate' => 'required|mimes:pdf', 
    ]);
if (!$valid)
    {
$file = Input::file('document_rfi_certificate'); 
$extension  = Input::file('document_rfi_certificate')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-rfi-certificate-'.time().'.'.$extension;
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
  BaksBauk::where('id',Input::get('id'))->update(['document_rfi_certificate'=>$fileName]);
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


        public function AddDocumentBaksBauk(Request $request)
    {
$cekdata = BaksBauk::where('project_id',Input::get('project_id'))->first();
if (!$cekdata) {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:baks_bauk,project_id',
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'no_baks' => 'required|max:255',
        'date_baks' => 'required|date|date_format:Y-m-d',
        'document_baks' => 'required', 
        'document_wctr' => 'required', 
        'document_boq_project' => 'required',  
        'document_rfi_certificate' => 'required',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
$file = Input::file('document_baks');
$filedocument_wctr = Input::file('document_wctr');
$filedocument_boq_project = Input::file('document_boq_project');
$filedocument_rfi_certificate = Input::file('document_rfi_certificate');
$extension  = Input::file('document_baks')->getClientOriginalExtension(); 
$extensiondocument_wctr  = Input::file('document_wctr')->getClientOriginalExtension(); 
$extensiondocument_boq_project  = Input::file('document_boq_project')->getClientOriginalExtension(); 
$extensiondocument_rfi_certificate  = Input::file('document_rfi_certificate')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' && $filedocument_wctr->getSize() <= 10000000 && $filedocument_wctr->getClientMimeType() == 'application/pdf' && $filedocument_boq_project->getSize() <= 10000000 && $filedocument_boq_project->getClientMimeType() == 'application/pdf' && $filedocument_rfi_certificate->getSize() <= 10000000 && $filedocument_rfi_certificate->getClientMimeType() == 'application/pdf')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
$fileName   = Input::get('projectid').'-document-baks-'.time().'.'.$extension; 
$fileNamedocument_wctr   = Input::get('projectid').'-document-wctr-'.time().'.'.$extensiondocument_wctr; 
$fileNamedocument_boq_project   = Input::get('projectid').'-document-boq-project-'.time().'.'.$extensiondocument_boq_project; 
$fileNamedocument_rfi_certificate   = Input::get('projectid').'-rfi-certificate-'.time().'.'.$extensiondocument_rfi_certificate; 


if(file_exists($destinationPath.$fileName) || file_exists($destinationPath.$fileNamedocument_wctr) || file_exists($destinationPath.$fileNamedocument_boq_project) || file_exists($destinationPath.$fileNamedocument_rfi_certificate))
    {
File::delete($destinationPath .$fileName);
File::delete($destinationPath .$fileNamedocument_wctr);
File::delete($destinationPath .$fileNamedocument_boq_project);
File::delete($destinationPath .$fileNamedocument_rfi_certificate);
    }   

$upload_success     = $file->move($destinationPath, $fileName);
$upload_success_ijin_warga     = $filedocument_wctr->move($destinationPath, $fileNamedocument_wctr);
$upload_success_pks     = $filedocument_boq_project->move($destinationPath, $fileNamedocument_boq_project);
$upload_success_imb     = $filedocument_rfi_certificate->move($destinationPath, $fileNamedocument_rfi_certificate);
if(!$upload_success || !$upload_success_ijin_warga || !$upload_success_pks || !$upload_success_imb)
{
File::delete($destinationPath .$fileName);
File::delete($destinationPath .$fileNamedocument_wctr);
File::delete($destinationPath .$fileNamedocument_boq_project);
File::delete($destinationPath .$fileNamedocument_rfi_certificate);
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
$masuk = array('project_id' => $request->project_id,'no_baks' => $request->no_baks,'date_baks' => $request->date_baks,'document_baks' =>$fileName ,'document_wctr' =>$fileNamedocument_wctr,'document_boq_project' => $fileNamedocument_boq_project, 'document_rfi_certificate' => $fileNamedocument_rfi_certificate); 
BaksBauk::create($masuk);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'baks_bauk' ,'action' => 'insert', 'data' => json_encode($masuk)]);
return response()->json(['success'=>'Successfully']); 
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



    public function RevisiDocumentBAKSBAUKByAdmin(Request $request)
    {
        if(Input::get('id') == 0)
        {
            $valid = $this->validate($request, [
                'project_id' => 'required|max:255|unique:baks_bauk,project_id', 
                'projectid' => 'required|max:255',
                'no_baks' => 'required|max:255',
                'date_baks' => 'required|date|date_format:Y-m-d',
                'document_baks' => 'required|mimes:pdf',  
                'document_wctr' => 'required|mimes:pdf',  
                'document_boq_project' => 'required|mimes:pdf',  
                'document_rfi_certificate' => 'required|mimes:pdf',  
            ]);
            if (!$valid)
            {
                $file = Input::file('document_baks');
                $filedocument_wctr = Input::file('document_wctr');
                $filedocument_boq_project = Input::file('document_boq_project');
                $filedocument_rfi_certificate = Input::file('document_rfi_certificate');
                $extension  = Input::file('document_baks')->getClientOriginalExtension(); 
                $extensiondocument_wctr  = Input::file('document_wctr')->getClientOriginalExtension(); 
                $extensiondocument_boq_project  = Input::file('document_boq_project')->getClientOriginalExtension(); 
                $extensiondocument_rfi_certificate  = Input::file('document_rfi_certificate')->getClientOriginalExtension(); 
                if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' && $filedocument_wctr->getSize() <= 10000000 && $filedocument_wctr->getClientMimeType() == 'application/pdf' && $filedocument_boq_project->getSize() <= 10000000 && $filedocument_boq_project->getClientMimeType() == 'application/pdf' && $filedocument_rfi_certificate->getSize() <= 10000000 && $filedocument_rfi_certificate->getClientMimeType() == 'application/pdf')
                {
                     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
                $fileName   = Input::get('projectid').'-document-baks-'.time().'.'.$extension; 
                $fileNamedocument_wctr   = Input::get('projectid').'-document-wctr-'.time().'.'.$extensiondocument_wctr; 
                $fileNamedocument_boq_project   = Input::get('projectid').'-document-boq-project-'.time().'.'.$extensiondocument_boq_project; 
                $fileNamedocument_rfi_certificate   = Input::get('projectid').'-rfi-certificate-'.time().'.'.$extensiondocument_rfi_certificate; 
                
                
                if(file_exists($destinationPath.$fileName) || file_exists($destinationPath.$fileNamedocument_wctr) || file_exists($destinationPath.$fileNamedocument_boq_project) || file_exists($destinationPath.$fileNamedocument_rfi_certificate))
                    {
                File::delete($destinationPath .$fileName);
                File::delete($destinationPath .$fileNamedocument_wctr);
                File::delete($destinationPath .$fileNamedocument_boq_project);
                File::delete($destinationPath .$fileNamedocument_rfi_certificate);
                    }   
                
                $upload_success     = $file->move($destinationPath, $fileName);
                $upload_success_ijin_warga     = $filedocument_wctr->move($destinationPath, $fileNamedocument_wctr);
                $upload_success_pks     = $filedocument_boq_project->move($destinationPath, $fileNamedocument_boq_project);
                $upload_success_imb     = $filedocument_rfi_certificate->move($destinationPath, $fileNamedocument_rfi_certificate);
                if(!$upload_success || !$upload_success_ijin_warga || !$upload_success_pks || !$upload_success_imb)
                {
                File::delete($destinationPath .$fileName);
                File::delete($destinationPath .$fileNamedocument_wctr);
                File::delete($destinationPath .$fileNamedocument_boq_project);
                File::delete($destinationPath .$fileNamedocument_rfi_certificate);
                 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
                }
                else
                {
                $masuk = array('project_id' => $request->project_id,'no_baks' => $request->no_baks,'date_baks' => $request->date_baks,'document_baks' =>$fileName ,'document_wctr' =>$fileNamedocument_wctr,'document_boq_project' => $fileNamedocument_boq_project, 'document_rfi_certificate' => $fileNamedocument_rfi_certificate); 
                BaksBauk::create($masuk);
                Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'baks_bauk' ,'action' => 'insert', 'data' => json_encode($masuk)]);
                $project = DB::table('vallproject')->where('id',Input::get('project_id'))->first();
                return response()->json(['success'=>'Edit Successfully','project'=>$project]); 
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
            $valid = $this->validate($request, [
                'project_id' => 'required|max:255|unique:baks_bauk,project_id,'.$request->id, 
                'projectid' => 'required|max:255',
                'no_baks' => 'required|max:255',
                'date_baks' => 'required|date|date_format:Y-m-d',  
            ]);
            if (!$valid)
            {
 $edit = array('no_baks' => $request->no_baks, 'date_baks' => $request->date_baks); 

 BaksBauk::where('id',Input::get('id'))->update($edit); 
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'baks_bauk' ,'action' => 'update', 'data' => json_encode($edit)]);
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