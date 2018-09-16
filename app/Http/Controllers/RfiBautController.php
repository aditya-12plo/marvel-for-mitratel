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
use App\Models\DokumenRFC;
use App\Models\BOQ;
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
use App\Models\ProjectStatus;

class RfiBautController extends Controller
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




    public function RevisiDocumentRFIBAUTByAdmin(Request $request)
    {
        if(Input::get('id') == 0)
        {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:rfi_baut,project_id', 
        'projectid' => 'required|max:255',
        'rfi_date' => 'required|date|date_format:Y-m-d',
        'rfi_document' => 'required|mimes:pdf,jpg,png,jpeg', 
        'baut_date' => 'required|date|date_format:Y-m-d',
        'baut_document' => 'required|mimes:pdf,jpg,png,jpeg', 
    ]);
if (!$valid)
    {
        $file = Input::file('rfi_document');
         $extension  = Input::file('rfi_document')->getClientOriginalExtension(); // getting image extension
         $file2 = Input::file('baut_document');
          $extension2  = Input::file('baut_document')->getClientOriginalExtension(); // getting image extension
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg' || $file2->getSize() <= 10000000 && $file2->getClientMimeType() == 'application/pdf' || $file2->getSize() <= 10000000 && $file2->getClientMimeType() == 'image/png' || $file2->getSize() <= 10000000 && $file2->getClientMimeType() == 'image/jpg' || $file2->getSize() <= 10000000 && $file2->getClientMimeType() == 'image/jpeg')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-rfi-'.time().'.'.$extension; // renameing image
     $fileName2   = Input::get('projectid').'-document-baut-'.time().'.'.$extension2; // renameing image
       if(file_exists($destinationPath.$fileName) || file_exists($destinationPath.$fileName2))
    {
File::delete($destinationPath .$fileName);
File::delete($destinationPath .$fileName2);
    } 
    
$upload_success     = $file->move($destinationPath, $fileName);
$upload_success2     = $file2->move($destinationPath, $fileName2);
if(!$upload_success || !$upload_success2)
{
    File::delete($destinationPath .$fileName);
    File::delete($destinationPath .$fileName2);
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
$masuk = array('project_id' => $request->project_id, 'rfi_date' => $request->rfi_date, 'rfi_document' => $fileName, 'baut_date' => $request->baut_date, 'baut_document' => $fileName2); 
RfiBaut::create($masuk);
 
Project::where('id',Input::get('project_id'))->update(['status_id'=>41]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'rfi_baut' ,'action' => 'insert', 'data' => json_encode($masuk)]);
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
    'project_id' => 'required|max:255|unique:rfi_baut,project_id,'.$request->id, 
    'projectid' => 'required|max:255',
    'baut_date' => 'required|date|date_format:Y-m-d',
    'rfi_date' => 'required|date|date_format:Y-m-d',
]);
if (!$valid)
{

$edit = array('baut_date' => $request->baut_date,'rfi_date' => $request->rfi_date); 
RfiBaut::where('id',Input::get('id'))->update($edit);

Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'rfi_baut' ,'action' => 'update', 'data' => json_encode($edit)]);
$project = DB::table('vallproject')->where('id',Input::get('project_id'))->first();
return response()->json(['success'=>'Edit Successfully','project'=>$project]);   
 
}
else
{
return response()->json('error', $valid);
}
}
    }



    public function uploaddokumenBAUTByAdmin(Request $request)
    { 
$valid = $this->validate($request, [ 
        'project_id' => 'required',
        'projectid' => 'required',
        'baut_document_old' => 'required',
        'baut_document' => 'required|mimes:pdf,jpg,png,jpeg'
    ]);
if (!$valid)
    {
       $file = Input::file('baut_document');
         $extension  = Input::file('baut_document')->getClientOriginalExtension(); // getting image extension
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-baut-'.time().'.'.$extension; // renameing image
       if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    } 

$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
 File::delete($destinationPath .$fileName);
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
File::delete($destinationPath .Input::get('baut_document_old'));
$edit = array('baut_document' => $fileName);   
RfiBaut::where('id',$request->id)->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'rfi_baut' ,'action' => 'update', 'data' => json_encode($edit)]);
$project = DB::table('vallproject')->where('id',Input::get('project_id'))->first();
return response()->json(['success'=>'Edit Successfully','namafilenya'=>$fileName]);   
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



    public function uploaddokumenRFIByAdmin(Request $request)
    { 
$valid = $this->validate($request, [ 
        'project_id' => 'required',
        'projectid' => 'required',
        'rfi_document_old' => 'required',
        'rfi_document' => 'required|mimes:pdf,jpg,png,jpeg'
    ]);
if (!$valid)
    {
       $file = Input::file('rfi_document');
         $extension  = Input::file('rfi_document')->getClientOriginalExtension(); // getting image extension
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-rfi-'.time().'.'.$extension; // renameing image
       if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    } 

$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
 File::delete($destinationPath .$fileName);
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
File::delete($destinationPath .Input::get('rfi_document_old'));
$edit = array('rfi_document' => $fileName);   
RfiBaut::where('id',$request->id)->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'rfi_baut' ,'action' => 'update', 'data' => json_encode($edit)]);
$project = DB::table('vallproject')->where('id',Input::get('project_id'))->first();
return response()->json(['success'=>'Edit Successfully','namafilenya'=>$fileName]);   
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





        public function DocumentRfiBautPerbaikan(Request $request)
    {
$valid = $this->validate($request, [
        'id' => 'required|numeric|not_in:0',  
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {  
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status')]);
return response()->json(['success'=>'Successfully']); 
    }
else
{
return response()->json('error', $valid);
}

    }


        public function AddDocumentRfiBaut(Request $request)
    {
$cekdata = RfiBaut::where('project_id',Input::get('project_id'))->first();
if (!$cekdata) {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:rfi_baut,project_id', 
        'rfi_date' => 'required|date|date_format:Y-m-d',
        'baut_date' => 'required|date|date_format:Y-m-d',
        'rfi_document' => 'required|mimes:pdf,jpg,png,jpeg', 
        'baut_document' => 'required|mimes:pdf,jpg,png,jpeg', 
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
$file = Input::file('rfi_document');
$filebaut = Input::file('baut_document');
$extension  = Input::file('rfi_document')->getClientOriginalExtension(); 
$extensionbaut  = Input::file('baut_document')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg' || $filebaut->getSize() <= 10000000 && $filebaut->getClientMimeType() == 'application/pdf' || $filebaut->getSize() <= 10000000 && $filebaut->getClientMimeType() == 'image/png' || $filebaut->getSize() <= 10000000 && $filebaut->getClientMimeType() == 'image/jpg' || $filebaut->getSize() <= 10000000 && $filebaut->getClientMimeType() == 'image/jpeg')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
$fileName   = Input::get('projectid').'-document-rfi-'.time().'.'.$extension;
$fileNameBaut   = Input::get('projectid').'-document-baut-'.time().'.'.$extensionbaut;

       if(file_exists($destinationPath.$fileName) || file_exists($destinationPath.$fileNameBaut))
    {
File::delete($destinationPath .$fileName);
File::delete($destinationPath .$fileNameBaut);
    } 

$upload_success     = $file->move($destinationPath, $fileName);
$upload_successBaut     = $filebaut->move($destinationPath, $fileNameBaut);
if(!$upload_success || !$upload_successBaut)
{
File::delete($destinationPath .$fileName);
File::delete($destinationPath .$fileNameBaut);  
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
$masuk = array('project_id' => $request->project_id, 'rfi_date' => $request->rfi_date, 'rfi_document' => $fileName, 'baut_date' => $request->baut_date, 'baut_document' => $fileNameBaut); 
RfiBaut::create($masuk);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'rfi_baut' ,'action' => 'insert', 'data' => json_encode($masuk)]);
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
$valid = $this->validate($request, [
        'rfi_date' => 'required|date|date_format:Y-m-d',
        'baut_date' => 'required|date|date_format:Y-m-d',
        'rfi_document' => 'required|mimes:pdf,jpg,png,jpeg', 
        'baut_document' => 'required|mimes:pdf,jpg,png,jpeg', 
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
$file = Input::file('rfi_document');
$filebaut = Input::file('baut_document');
$extension  = Input::file('rfi_document')->getClientOriginalExtension(); 
$extensionbaut  = Input::file('baut_document')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg' || $filebaut->getSize() <= 10000000 && $filebaut->getClientMimeType() == 'application/pdf' || $filebaut->getSize() <= 10000000 && $filebaut->getClientMimeType() == 'image/png' || $filebaut->getSize() <= 10000000 && $filebaut->getClientMimeType() == 'image/jpg' || $filebaut->getSize() <= 10000000 && $filebaut->getClientMimeType() == 'image/jpeg')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
$fileName   = Input::get('projectid').'-document-rfi-'.time().'.'.$extension; 
$fileNameBaut   = Input::get('projectid').'-document-baut-'.time().'.'.$extensionbaut; 


if(file_exists($destinationPath.$fileName) || file_exists($destinationPath.$fileNameBaut))
    {
File::delete($destinationPath .$fileName);
File::delete($destinationPath .$fileNameBaut);
    } 
    
$upload_success     = $file->move($destinationPath, $fileName);
$upload_successBaut     = $filebaut->move($destinationPath, $fileNameBaut);

if(!$upload_success)
{
File::delete($destinationPath .$fileName);
File::delete($destinationPath .$fileNameBaut);
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
$masuk = array('project_id' => $request->project_id, 'rfi_date' => $request->rfi_date, 'rfi_document' => $fileName, 'baut_date' => $request->baut_date, 'baut_document' => $fileNameBaut); 
File::delete($destinationPath .$cekdata->rfi_document);
File::delete($destinationPath .$cekdata->baut_document);
RfiBaut::where('id',$cekdata->id)->update($masuk);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'rfi_baut' ,'action' => 'update', 'data' => json_encode($masuk)]);
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
    }




        public function RevisiDocumentCME(Request $request)
    { 
$valid = $this->validate($request, [ 
        'siteopeningid' => 'required|numeric|not_in:0',
        'site_opening_date' => 'required|date|date_format:Y-m-d', 
        'excavationid' => 'required|numeric|not_in:0',
        'excavation_date' => 'required|date|date_format:Y-m-d', 
        'pouringid' => 'required|numeric|not_in:0',
        'pouring_date' => 'required|date|date_format:Y-m-d', 
        'curingid' => 'required|numeric|not_in:0',
        'curing_date' => 'required|date|date_format:Y-m-d', 
        'towererectionid' => 'required|numeric|not_in:0',
        'tower_erection_date' => 'required|date|date_format:Y-m-d', 
        'meprocessid' => 'required|numeric|not_in:0',
        'm_e_process_date' => 'required|date|date_format:Y-m-d', 
        'rfibautid' => 'required|numeric|not_in:0',
        'rfi_date' => 'required|date|date_format:Y-m-d', 
        'baut_date' => 'required|date|date_format:Y-m-d', 
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {  
SiteOpening::where('id',$request->siteopeningid)->update(['site_opening_date'=>$request->site_opening_date]);
Excavation::where('id',$request->excavationid)->update(['excavation_date'=>$request->excavation_date]);
Pouring::where('id',$request->pouringid)->update(['pouring_date'=>$request->pouring_date]);
Curing::where('id',$request->curingid)->update(['curing_date'=>$request->curing_date]);
TowerErection::where('id',$request->towererectionid)->update(['tower_erection_date'=>$request->tower_erection_date]);
MEProcess::where('id',$request->meprocessid)->update(['m_e_process_date'=>$request->m_e_process_date]);
RfiBaut::where('id',$request->rfibautid)->update(['rfi_date'=>$request->rfi_date,'baut_date'=>$request->baut_date]);

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



  public function uploadrfi_document(Request $request)
    {
      $valid = $this->validate($request, [
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'rfi_document' => 'required|mimes:pdf,jpg,png,jpeg', 
    ]);
if (!$valid)
    { 
$file = Input::file('rfi_document'); 
$extension  = Input::file('rfi_document')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-rfi-'.time().'.'.$extension;
    if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    }

$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
 return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
RfiBaut::where('id',$request->id)->update(['rfi_document'=>$fileName]);
File::delete($destinationPath .$request->namafile);
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





  public function uploadbaut_document(Request $request)
    {
      $valid = $this->validate($request, [
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'baut_document' => 'required|mimes:pdf,jpg,png,jpeg', 
    ]);
if (!$valid)
    { 
$file = Input::file('baut_document'); 
$extension  = Input::file('baut_document')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-baut-'.time().'.'.$extension;
    if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    }

$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
 return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
RfiBaut::where('id',$request->id)->update(['baut_document'=>$fileName]);
File::delete($destinationPath .$request->namafile);
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






  public function uploadm_e_process_document(Request $request)
    {
      $valid = $this->validate($request, [
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'm_e_process_document' => 'required|mimes:pdf,jpg,png,jpeg', 
    ]);
if (!$valid)
    { 
$file = Input::file('m_e_process_document'); 
$extension  = Input::file('m_e_process_document')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-me-process-'.time().'.'.$extension;
    if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    }

$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
 return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
MEProcess::where('id',$request->id)->update(['m_e_process_document'=>$fileName]);
File::delete($destinationPath .$request->namafile);
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







  public function uploadtower_erection_document(Request $request)
    {
      $valid = $this->validate($request, [
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'tower_erection_document' => 'required|mimes:pdf,jpg,png,jpeg', 
    ]);
if (!$valid)
    { 
$file = Input::file('tower_erection_document'); 
$extension  = Input::file('tower_erection_document')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-me-process-'.time().'.'.$extension;
    if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    }

$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
 return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
TowerErection::where('id',$request->id)->update(['tower_erection_document'=>$fileName]);
File::delete($destinationPath .$request->namafile);
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







  public function uploadcuring_document(Request $request)
    {
      $valid = $this->validate($request, [
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'curing_document' => 'required|mimes:pdf,jpg,png,jpeg', 
    ]);
if (!$valid)
    { 
$file = Input::file('curing_document'); 
$extension  = Input::file('curing_document')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-me-process-'.time().'.'.$extension;
    if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    }

$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
 return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
Curing::where('id',$request->id)->update(['curing_document'=>$fileName]);
File::delete($destinationPath .$request->namafile);
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





  public function uploadpouring_document(Request $request)
    {
      $valid = $this->validate($request, [
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'pouring_document' => 'required|mimes:pdf,jpg,png,jpeg', 
    ]);
if (!$valid)
    { 
$file = Input::file('pouring_document'); 
$extension  = Input::file('pouring_document')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-me-process-'.time().'.'.$extension;
    if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    }

$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
 return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
Pouring::where('id',$request->id)->update(['pouring_document'=>$fileName]);
File::delete($destinationPath .$request->namafile);
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






  public function uploadexcavation_document(Request $request)
    {
      $valid = $this->validate($request, [
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'excavation_document' => 'required|mimes:pdf,jpg,png,jpeg', 
    ]);
if (!$valid)
    { 
$file = Input::file('excavation_document'); 
$extension  = Input::file('excavation_document')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-me-process-'.time().'.'.$extension;
    if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    }

$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
 return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
Excavation::where('id',$request->id)->update(['excavation_document'=>$fileName]);
File::delete($destinationPath .$request->namafile);
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






  public function uploaddocument_site_opening(Request $request)
    {
      $valid = $this->validate($request, [
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'document_site_opening' => 'required|mimes:pdf,jpg,png,jpeg', 
    ]);
if (!$valid)
    { 
$file = Input::file('document_site_opening'); 
$extension  = Input::file('document_site_opening')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-me-process-'.time().'.'.$extension;
    if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    }

$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
 return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
SiteOpening::where('id',$request->id)->update(['document_site_opening'=>$fileName]);
File::delete($destinationPath .$request->namafile);
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



   public function ApprovedCMEMassal(Request $request)
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