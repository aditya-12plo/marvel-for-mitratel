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
use App\Models\ProjectStatus;

class DokumenDRMController extends Controller
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

    
    public function getDRMDocument($id)
    {
$cek = DokumenDRM::where('project_id',$id)->first();
return response()->json($cek);
    }


    public function updateDRMByAdmin(Request $request)
    { 
$cekdata = DokumenDRM::where('project_id',Input::get('project_id'))->first();
if(count($cekdata) > 0)
{ 
$valid = $this->validate($request, [ 
        'project_id' => 'required|max:255|unique:document_drm,project_id,'.Input::get('id'),
        'projectid' => 'required|max:255',
        'site_id_actual' => 'required|max:255',
        'site_name_actual' => 'required|max:255',
        'city' => 'required|max:255',
        'address_actual' => 'required',
        'longitude_actual' => 'required|max:255',
        'latitude_actual' => 'required|max:255',
        'province' => 'required|max:255', 
        'kom_date' => 'required|date|date_format:Y-m-d',
        'drm_date' => 'required|date|date_format:Y-m-d', 
    ]);
if (!$valid)
    {
$file = Input::file('document_kom');
$filedrm = Input::file('document_drm');

if($file && $filedrm)
{
$extension  = Input::file('document_kom')->getClientOriginalExtension(); 
$extensiondrm  = Input::file('document_drm')->getClientOriginalExtension();

 $file = Input::file('document_kom');
        $filedrm = Input::file('document_drm');
         $extension  = Input::file('document_kom')->getClientOriginalExtension(); 
         $extensiondrm  = Input::file('document_drm')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $filedrm->getSize() <= 10000000 && $filedrm->getClientMimeType() == 'application/pdf')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-kom-'.time().'.'.$extension; 
     $fileNameDRM   = Input::get('projectid').'-document-drm-'.time().'.'.$extensiondrm; 

       if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
File::delete($destinationPath .$fileNameDRM);
    }   
    else
    {
$upload_success     = $file->move($destinationPath, $fileName);
$upload_success_drm     = $filedrm->move($destinationPath, $fileNameDRM);
if(!$upload_success || !$upload_success_drm)
{
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{

File::delete($destinationPath .$cekdata->document_kom);
File::delete($destinationPath .$cekdata->document_drm);

$edit = array('site_id_actual' => $request->site_id_actual,'site_name_actual' => $request->site_name_actual,'province' => $request->province,'city' => $request->city, 'address_actual' => $request->address_actual, 'longitude_actual' => $request->longitude_actual, 'latitude_actual' => $request->latitude_actual, 'kom_date' => $request->kom_date, 'drm_date' => $request->drm_date, 'document_kom' => $fileName, 'document_drm' => $fileNameDRM); 
DokumenDRM::where('id',Input::get('id'))->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_drm' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Edit Successfully']); 
}

    }
}
else
{
    return response()->json(['error'=>'Please, check your file type / size']); 
}
        
}
elseif($file && !$filedrm)
{
$extension  = Input::file('document_kom')->getClientOriginalExtension(); 

$file = Input::file('document_kom'); 
$extension  = Input::file('document_kom')->getClientOriginalExtension();  
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-kom-'.time().'.'.$extension; 
 

       if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName); 
    }   
    else
    {
$upload_success     = $file->move($destinationPath, $fileName); 
if(!$upload_success)
{
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
File::delete($destinationPath .$cekdata->document_kom); 
$edit = array('site_id_actual' => $request->site_id_actual,'site_name_actual' => $request->site_name_actual,'province' => $request->province,'city' => $request->city, 'address_actual' => $request->address_actual, 'longitude_actual' => $request->longitude_actual, 'latitude_actual' => $request->latitude_actual, 'kom_date' => $request->kom_date, 'drm_date' => $request->drm_date, 'document_kom' => $fileName); 
DokumenDRM::where('id',Input::get('id'))->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_drm' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Edit Successfully']); 
}

    }
}
else
{
    return response()->json(['error'=>'Please, check your file type / size']); 
}
  
}
elseif(!$file && $filedrm)
{ 
$extensiondrm  = Input::file('document_drm')->getClientOriginalExtension();

$filedrm = Input::file('document_drm');  
$extensiondrm  = Input::file('document_drm')->getClientOriginalExtension(); 
if ($filedrm->getSize() <= 10000000 && $filedrm->getClientMimeType() == 'application/pdf')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
      $fileNameDRM   = Input::get('projectid').'-document-drm-'.time().'.'.$extensiondrm; 


       if(file_exists($destinationPath.$fileNameDRM))
    {
 File::delete($destinationPath .$fileNameDRM);
    }   
    else
    {
 $upload_success_drm     = $filedrm->move($destinationPath, $fileNameDRM);
if(!$upload_success_drm)
{
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
 File::delete($destinationPath .$cekdata->document_drm);
$edit = array('site_id_actual' => $request->site_id_actual,'site_name_actual' => $request->site_name_actual,'province' => $request->province,'city' => $request->city, 'address_actual' => $request->address_actual, 'longitude_actual' => $request->longitude_actual, 'latitude_actual' => $request->latitude_actual, 'kom_date' => $request->kom_date, 'drm_date' => $request->drm_date, 'document_drm' => $fileNameDRM); 
DokumenDRM::where('id',Input::get('id'))->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_drm' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Edit Successfully']); 
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
 
$edit = array('project_id' => $request->project_id,'site_id_actual' => $request->site_id_actual,'site_name_actual' => $request->site_name_actual,'province' => $request->province,'city' => $request->city, 'address_actual' => $request->address_actual, 'longitude_actual' => $request->longitude_actual, 'latitude_actual' => $request->latitude_actual, 'kom_date' => $request->kom_date, 'drm_date' => $request->drm_date); 
DokumenDRM::where('id',Input::get('id'))->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_drm' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Successfully']); 
 

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
        'project_id' => 'required|max:255|unique:document_drm,project_id', 
        'projectid' => 'required|max:255',
        'site_id_actual' => 'required|max:255',
        'site_name_actual' => 'required|max:255',
        'city' => 'required|max:255',
        'address_actual' => 'required',
        'longitude_actual' => 'required|max:255',
        'latitude_actual' => 'required|max:255',
        'province' => 'required|max:255', 
        'kom_date' => 'required|date|date_format:Y-m-d',
        'drm_date' => 'required|date|date_format:Y-m-d',
        'document_kom' => 'required',
        'document_drm' => 'required',  
    ]);
if (!$valid)
    {
        $file = Input::file('document_kom');
        $filedrm = Input::file('document_drm');
         $extension  = Input::file('document_kom')->getClientOriginalExtension(); 
         $extensiondrm  = Input::file('document_drm')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $filedrm->getSize() <= 10000000 && $filedrm->getClientMimeType() == 'application/pdf')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-kom-'.time().'.'.$extension; 
     $fileNameDRM   = Input::get('projectid').'-document-drm-'.time().'.'.$extensiondrm; 

if(file_exists($destinationPath.$fileName) || file_exists($destinationPath.$fileNameDRM))
    {
File::delete($destinationPath .$fileName);
File::delete($destinationPath .$fileNameDRM);
    }   

$upload_success     = $file->move($destinationPath, $fileName);
$upload_success_drm     = $filedrm->move($destinationPath, $fileNameDRM);
if(!$upload_success || !$upload_success_drm)
{
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
$masuk = array('project_id' => $request->project_id,'site_id_actual' => $request->site_id_actual,'site_name_actual' => $request->site_name_actual,'province' => $request->province,'city' => $request->city, 'address_actual' => $request->address_actual, 'longitude_actual' => $request->longitude_actual, 'latitude_actual' => $request->latitude_actual, 'kom_date' => $request->kom_date, 'drm_date' => $request->drm_date, 'document_kom' => $fileName, 'document_drm' => $fileNameDRM); 
DokumenDRM::create($masuk);
  
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_drm' ,'action' => 'insert', 'data' => json_encode($masuk)]);
return response()->json(['success'=>'Add Successfully']); 
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

    }

        public function store(Request $request)
    {
$cekdata = DokumenDRM::where('project_id',Input::get('project_id'))->first();
if (!$cekdata) {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:document_drm,project_id',
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'site_id_actual' => 'required|max:255',
        'site_name_actual' => 'required|max:255',
        'city' => 'required|max:255',
        'address_actual' => 'required',
        'longitude_actual' => 'required|max:255',
        'latitude_actual' => 'required|max:255',
        'province' => 'required|max:255', 
        'kom_date' => 'required|date|date_format:Y-m-d',
        'drm_date' => 'required|date|date_format:Y-m-d',
        'document_kom' => 'required',
        'document_drm' => 'required', 
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
        $file = Input::file('document_kom');
        $filedrm = Input::file('document_drm');
         $extension  = Input::file('document_kom')->getClientOriginalExtension(); 
         $extensiondrm  = Input::file('document_drm')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $filedrm->getSize() <= 10000000 && $filedrm->getClientMimeType() == 'application/pdf')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-kom-'.time().'.'.$extension; 
     $fileNameDRM   = Input::get('projectid').'-document-drm-'.time().'.'.$extensiondrm; 


       if(file_exists($destinationPath.$fileName) || file_exists($destinationPath.$fileNameDRM))
    {
File::delete($destinationPath .$fileName);
File::delete($destinationPath .$fileNameDRM);
    }   
    else
    {
$upload_success     = $file->move($destinationPath, $fileName);
$upload_success_drm     = $filedrm->move($destinationPath, $fileNameDRM);
if(!$upload_success || !$upload_success_drm)
{
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
$masuk = array('project_id' => $request->project_id,'site_id_actual' => $request->site_id_actual,'site_name_actual' => $request->site_name_actual,'province' => $request->province,'city' => $request->city, 'address_actual' => $request->address_actual, 'longitude_actual' => $request->longitude_actual, 'latitude_actual' => $request->latitude_actual, 'kom_date' => $request->kom_date, 'drm_date' => $request->drm_date, 'document_kom' => $fileName, 'document_drm' => $fileNameDRM); 
DokumenDRM::create($masuk);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_drm' ,'action' => 'insert', 'data' => json_encode($masuk)]);
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
$cekdata = DB::table('vjobsdocumentdrmrevisi')->where('id',Input::get('project_id'))->first();
if ($cekdata->status_id == '6') {
$valid = $this->validate($request, [ 
        'project_id' => 'required|max:255|unique:document_drm,project_id,'.Input::get('documentdrmid'),
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'site_id_actual' => 'required|max:255',
        'site_name_actual' => 'required|max:255',
        'city' => 'required|max:255',
        'address_actual' => 'required',
        'longitude_actual' => 'required|max:255',
        'latitude_actual' => 'required|max:255',
        'province' => 'required|max:255', 
        'kom_date' => 'required|date|date_format:Y-m-d',
        'drm_date' => 'required|date|date_format:Y-m-d', 
        'infratype' => 'required',
        'document' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0',
        'documentdrmid' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
$file = Input::file('document_kom');
$filedrm = Input::file('document_drm');

if($file && $filedrm)
{
$extension  = Input::file('document_kom')->getClientOriginalExtension(); 
$extensiondrm  = Input::file('document_drm')->getClientOriginalExtension();

 $file = Input::file('document_kom');
        $filedrm = Input::file('document_drm');
         $extension  = Input::file('document_kom')->getClientOriginalExtension(); 
         $extensiondrm  = Input::file('document_drm')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $filedrm->getSize() <= 10000000 && $filedrm->getClientMimeType() == 'application/pdf')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-kom-'.time().'.'.$extension; 
     $fileNameDRM   = Input::get('projectid').'-document-drm-'.time().'.'.$extensiondrm; 


File::delete($destinationPath .$cekdata->document_kom);
File::delete($destinationPath .$cekdata->document_drm);
       if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
File::delete($destinationPath .$fileNameDRM);
    }   
    else
    {
$upload_success     = $file->move($destinationPath, $fileName);
$upload_success_drm     = $filedrm->move($destinationPath, $fileNameDRM);
if(!$upload_success || !$upload_success_drm)
{
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
$edit = array('project_id' => $request->project_id,'site_id_actual' => $request->site_id_actual,'site_name_actual' => $request->site_name_actual,'province' => $request->province,'city' => $request->city, 'address_actual' => $request->address_actual, 'longitude_actual' => $request->longitude_actual, 'latitude_actual' => $request->latitude_actual, 'kom_date' => $request->kom_date, 'drm_date' => $request->drm_date, 'document_kom' => $fileName, 'document_drm' => $fileNameDRM); 
DokumenDRM::where('id',Input::get('documentdrmid'))->update($edit);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_drm' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Successfully']); 
}

    }
}
else
{
    return response()->json(['error'=>'Please, check your file type / size']); 
}
        
}
elseif($file && !$filedrm)
{
$extension  = Input::file('document_kom')->getClientOriginalExtension(); 

$file = Input::file('document_kom'); 
$extension  = Input::file('document_kom')->getClientOriginalExtension();  
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-kom-'.time().'.'.$extension; 
 

File::delete($destinationPath .$cekdata->document_kom); 
       if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName); 
    }   
    else
    {
$upload_success     = $file->move($destinationPath, $fileName); 
if(!$upload_success)
{
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
$edit = array('project_id' => $request->project_id,'site_id_actual' => $request->site_id_actual,'site_name_actual' => $request->site_name_actual,'province' => $request->province,'city' => $request->city, 'address_actual' => $request->address_actual, 'longitude_actual' => $request->longitude_actual, 'latitude_actual' => $request->latitude_actual, 'kom_date' => $request->kom_date, 'drm_date' => $request->drm_date, 'document_kom' => $fileName); 
DokumenDRM::where('id',Input::get('documentdrmid'))->update($edit);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_drm' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Successfully']); 
}

    }
}
else
{
    return response()->json(['error'=>'Please, check your file type / size']); 
}
  
}
elseif(!$file && $filedrm)
{ 
$extensiondrm  = Input::file('document_drm')->getClientOriginalExtension();

$filedrm = Input::file('document_drm');  
$extensiondrm  = Input::file('document_drm')->getClientOriginalExtension(); 
if ($filedrm->getSize() <= 10000000 && $filedrm->getClientMimeType() == 'application/pdf')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
      $fileNameDRM   = Input::get('projectid').'-document-drm-'.time().'.'.$extensiondrm; 


 File::delete($destinationPath .$cekdata->document_drm);
       if(file_exists($destinationPath.$fileNameDRM))
    {
 File::delete($destinationPath .$fileNameDRM);
    }   
    else
    {
 $upload_success_drm     = $filedrm->move($destinationPath, $fileNameDRM);
if(!$upload_success_drm)
{
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
$edit = array('project_id' => $request->project_id,'site_id_actual' => $request->site_id_actual,'site_name_actual' => $request->site_name_actual,'province' => $request->province,'city' => $request->city, 'address_actual' => $request->address_actual, 'longitude_actual' => $request->longitude_actual, 'latitude_actual' => $request->latitude_actual, 'kom_date' => $request->kom_date, 'drm_date' => $request->drm_date, 'document_drm' => $fileNameDRM); 
DokumenDRM::where('id',Input::get('documentdrmid'))->update($edit);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_drm' ,'action' => 'update', 'data' => json_encode($edit)]);
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
 
$edit = array('project_id' => $request->project_id,'site_id_actual' => $request->site_id_actual,'site_name_actual' => $request->site_name_actual,'province' => $request->province,'city' => $request->city, 'address_actual' => $request->address_actual, 'longitude_actual' => $request->longitude_actual, 'latitude_actual' => $request->latitude_actual, 'kom_date' => $request->kom_date, 'drm_date' => $request->drm_date); 
DokumenDRM::where('id',Input::get('documentdrmid'))->update($edit);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_drm' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Successfully']); 
 

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


        public function delete(Request $request)
    {
        $id         = Input::get('kode');
        $projectid  = Input::get('projectid');
        $document_kom   = Input::get('document_kom'); 
        $document_drm   = Input::get('document_drm'); 

 $destinationPath = 'files/'.$projectid.'/'; // upload path
File::delete($destinationPath .$document_kom);
File::delete($destinationPath .$document_drm);
DokumenDRM::where('id',$id)->delete();
return response()->json(['success'=>'Successfully']);
    }


   public function ApprovedMassal(Request $request)
    {
$valid = $this->validate($request, [
        'id' => 'required',
        'statusmessage' => 'required',
        'kata' => 'required',
        'document' => 'required',
        'status' => 'required|numeric|not_in:0',
    ]);
if (!$valid)
    {

$detailnya = explode(",", $request->id);
$emailusernya = array();
for($x=0;$x < count($detailnya);$x++) {
$ProjectStatus = ProjectStatus::create(['project_id' =>$detailnya[$x],'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('kata'))]);  
$showUser = User::where([['level', Auth::guard('karyawan')->user()->level],['posisi','MANAGER MARKETING'],['area',Auth::guard('karyawan')->user()->area]])->get();
$cekproject = Project::where('id',$detailnya[$x])->first();
if(count($showUser) > 0)
{
foreach ($showUser as $p) {
Pesan::create(['project_id' => $detailnya[$x], 'sender_id'=>Auth::guard('karyawan')->user()->id ,'users_id' => $p['id'], 'status' => strtoupper(Input::get('statusmessage')), 'message'=>strtoupper(Input::get('message'))]);
 // send email is off
//$this->SendEmailController->kirim($p['email'],$detailnya[$x],$cekproject->projectid,$cekproject->infratype,strtoupper(Input::get('statusmessage')),strtoupper(Input::get('document')),Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,strtoupper(Input::get('message')),strtoupper(Input::get('kata')));
}
}
Project::where('id',$detailnya[$x])->update(['status_id'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]);


}


return response()->json(['success'=>'Successfully']);
    }
else
    {
 return response()->json('error', $valid);
    } 
    }

    
}
