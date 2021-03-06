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
use App\Models\ProjectStatus; 

class DokumenSISController extends Controller
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

    


        public function store(Request $request)
    {
$cekdata = DokumenSIS::where('project_id',Input::get('project_id'))->first();
if (!$cekdata) {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:document_sis,project_id',
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'document_sis' => 'required',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
        $file = Input::file('document_sis');
         $extension  = Input::file('document_sis')->getClientOriginalExtension(); // getting image extension
        if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-sis-'.time().'.'.$extension; // renameing image
       if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    }   

$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
$masuk = array('project_id' => $request->project_id, 'document_sis' => $fileName); 
DokumenSIS::create($masuk);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_sis' ,'action' => 'insert', 'data' => json_encode($masuk)]);
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
        'project_id' => 'required|max:255',
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'document_sis' => 'required',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
        $file = Input::file('document_sis');
         $extension  = Input::file('document_sis')->getClientOriginalExtension(); // getting image extension
        if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-sis-'.time().'.'.$extension; // renameing image
       if(file_exists($destinationPath.$fileName))
    {
File::delete($destinationPath .$fileName);
    }   

$upload_success     = $file->move($destinationPath, $fileName);
if(!$upload_success)
{
 return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
$masuk = array('project_id' => $request->project_id, 'document_sis' => $fileName); 
DokumenSIS::where('project_id',Input::get('project_id'))->update($masuk);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_sis' ,'action' => 'insert', 'data' => json_encode($masuk)]);
File::delete($destinationPath .$cekdata->document_sis);
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




    public function getSISDocument($id)
    {
$cek = DokumenSIS::where('project_id',$id)->first();
return response()->json($cek);
    }


    public function updateSISByAdmin(Request $request)
    { 

if(Input::get('id') == 0)
{

    $file = Input::file('document_sis');
    $extension  = Input::file('document_sis')->getClientOriginalExtension();
            if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
    {
         $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
         $fileName   = Input::get('projectid').'-document-sis-'.time().'.'.$extension; // renameing image
           if(file_exists($destinationPath.$fileName))
        {
    File::delete($destinationPath .$fileName);
        }  
    $upload_success     = $file->move($destinationPath, $fileName);
    if(!$upload_success)
    {
     return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
    }
    else
    {
    $masuk = array('project_id' => $request->project_id, 'document_sis' => $fileName); 
    DokumenSIS::create($masuk);
    Project::where('id',Input::get('project_id'))->update(['status_id'=>4]);
    $project = DB::table('vallproject')->where('id',Input::get('project_id'))->first();
    Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_sis' ,'action' => 'insert', 'data' => json_encode($masuk)]);
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

    $file = Input::file('document_sis');
    $extension  = Input::file('document_sis')->getClientOriginalExtension();
            if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
    {
         $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
         $fileName   = Input::get('projectid').'-document-sis-'.time().'.'.$extension; // renameing image
           if(file_exists($destinationPath.$fileName))
        {
    File::delete($destinationPath .$fileName);
        }  
    $upload_success     = $file->move($destinationPath, $fileName);
    if(!$upload_success)
    {
     return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
    }
    else
    {
    File::delete($destinationPath .Input::get('document_sis_old'));    
    $edit = array('document_sis' => $fileName); 
    DokumenSIS::where('id',Input::get('id'))->update($edit);
    $project = DB::table('vallproject')->where('id',Input::get('project_id'))->first();
    Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_sis' ,'action' => 'update', 'data' => json_encode($edit)]);
    return response()->json(['success'=>'Edit Successfully','project'=>$project]); 
    }
    
    }
    else
    {
        return response()->json(['error'=>'Please, check your file type / size']); 
    }
}
    }



    public function update(Request $request)
    { 
$cekdata = DB::table('vjobsdocumentsisrevisi')->where('id',Input::get('project_id'))->first();
if ($cekdata->status_id == '3') {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:document_sis,project_id,'.Input::get('documentsisid'),
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'document_sis' => 'required',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'filenya' => 'required',
        'status' => 'required|numeric|not_in:0',
        'documentsisid' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
        $file = Input::file('document_sis');
         $extension  = Input::file('document_sis')->getClientOriginalExtension(); // getting image extension
        if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-sis-'.time().'.'.$extension; // renameing image
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
$edit = array('document_sis' => $fileName); 
DokumenSIS::where('id',Input::get('documentsisid'))->update($edit);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_sis' ,'action' => 'update', 'data' => json_encode($edit)]);
     File::delete($destinationPath .Input::get('filenya'));
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

    
    public function delete(Request $request)
    {
        $id         = Input::get('kode');
        $projectid  = Input::get('projectid');
        $filename   = Input::get('file'); 

DokumenSIS::where('id',$id)->delete();
 $destinationPath = 'files/'.$projectid.'/'; // upload path
File::delete($destinationPath .$filename);
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
