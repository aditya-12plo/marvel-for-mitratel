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
use App\Models\DokumenRFC;
use App\Models\ProjectStatus;

class DokumenRFCController extends Controller
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

     public function uploaddokumenRFC(Request $request)
    {
$cekdata = DB::table('vjobsdocumentrfcrevisi')->where('id',Input::get('project_id'))->first();
if ($cekdata->status_id == '12') {
$valid = $this->validate($request, [
        'id' => 'required|numeric|not_in:0', 
        'projectid' => 'required|max:255',
        'namafile' => 'required',
        'document_rfc' => 'required|mimes:pdf', 
    ]);
if (!$valid)
    {
$file = Input::file('document_rfc'); 
$extension  = Input::file('document_rfc')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-rfc-'.time().'.'.$extension;
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
  DokumenRFC::where('id',Input::get('id'))->update(['document_rfc'=>$fileName]);
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
$cekdata = DokumenRFC::where('project_id',Input::get('project_id'))->first();
if (!$cekdata) {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:document_rfc,project_id',
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'document_rfc' => 'required',
        'no_rfc' => 'required|max:255',
        'id_pln' => 'required|max:255',
        'target_rfi' => 'required|numeric|not_in:0',
        'power_capacity' => 'required|max:255',
        'rfc_date' => 'required|date|date_format:Y-m-d',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
        $file = Input::file('document_rfc');
         $extension  = Input::file('document_rfc')->getClientOriginalExtension(); // getting image extension
        if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-rfc-'.time().'.'.$extension; // renameing image
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
$masuk = array('project_id' => $request->project_id, 'no_rfc' => $request->no_rfc , 'rfc_date' => $request->rfc_date ,'document_rfc' => $fileName , 'id_pln' => $request->id_pln , 'target_rfi' =>$request->target_rfi ,'power_capacity'=>$request->power_capacity); 
DokumenRFC::create($masuk);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_rfc' ,'action' => 'insert', 'data' => json_encode($masuk)]);
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
$cekdata = DB::table('vjobsdocumentrfcrevisi')->where('id',Input::get('project_id'))->first();
if ($cekdata->status_id == '12') {
$valid = $this->validate($request, [ 
        'project_id' => 'required|max:255|unique:document_rfc,project_id,'.Input::get('documentrfcid'),
        'statusmessage' => 'required|max:255',
        'projectid' => 'required|max:255',
        'no_rfc' => 'required|max:255',
        'id_pln' => 'required|max:255',
        'target_rfi' => 'required|numeric|not_in:0',
        'power_capacity' => 'required|max:255',
        'rfc_date' => 'required|date|date_format:Y-m-d',
        'document' => 'required',
        'infratype' => 'required',
        'message' => 'required',
        'kata' => 'required',
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
{

$edit = array('project_id' => $request->project_id, 'no_rfc' => $request->no_rfc , 'rfc_date' => $request->rfc_date , 'id_pln' => $request->id_pln , 'target_rfi' =>$request->target_rfi ,'power_capacity'=>$request->power_capacity);  
DokumenRFC::where('id',Input::get('documentrfcid'))->update($edit);
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
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_rfc' ,'action' => 'update', 'data' => json_encode($edit)]);
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


        public function delete(Request $request)
    {
        $id         = Input::get('kode');
        $projectid  = Input::get('projectid');
        $document_rfc   = Input::get('document_rfc');  

 $destinationPath = 'files/'.$projectid.'/'; // upload path
File::delete($destinationPath .$document_rfc); 
DokumenRFC::where('id',$id)->delete();
return response()->json(['success'=>'Successfully']);
    }

    
}
