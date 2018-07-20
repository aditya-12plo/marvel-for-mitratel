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
    }

    


        public function store(Request $request ,$id)
    {
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
    else
    {
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
$this->SendEmailController->kirim($p['email'],Input::get('project_id'),Input::get('projectid'),Input::get('infratype'),strtoupper(Input::get('statusmessage')),strtoupper(Input::get('document')),Auth::guard('karyawan')->user()->name,Auth::guard('karyawan')->user()->posisi,strtoupper(Input::get('message')),strtoupper(Input::get('kata')));
}
}
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'document_sis' ,'action' => 'insert', 'data' => json_encode($masuk)]);
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




    public function update(Request $request, $id)
    {
        $cek = Project::findOrFail($id);
if(!$cek)
{
 return response()->json(['error'=>'Code Not Found']);
}
else
{
    if(Input::get('password') == '')
    {
$valid = $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required|max:255|unique:users,email,'.$id,
        'level' => 'in:REGIONAL,HQ',
        'posisi' => 'in:AM SUPPORT,ACCOUNT MANAGER,MANAGER MARKETING,MANAGER',
        'area' => 'in:1,2,3,4',
    ]);
    }
    else
    {
$valid = $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required|max:255|unique:users,email,'.$id,
        'password' => 'required|max:255',
        'level' => 'in:REGIONAL,HQ',
        'posisi' => 'in:AM SUPPORT,ACCOUNT MANAGER,MANAGER MARKETING,MANAGER',
        'area' => 'in:1,2,3,4',
    ]);
    }
if (!$valid)
    {
            if(Input::get('password') == '')
    {
if($request->level == 'REGIONAL' && $request->posisi == 'ACCOUNT MANAGER' || $request->level == 'REGIONAL' && $request->posisi == 'AM SUPPORT')
{
        $edit = array('name' => Input::get('name'), 'email' => Input::get('email'), 'level' => Input::get('level'), 'posisi' => Input::get('posisi'), 'regional' => strtoupper(Input::get('regional')), 'area' => Input::get('area'));
}
elseif($request->level == 'HQ' && $request->posisi == 'MANAGER' || $request->level == 'HQ' && $request->posisi == 'ACCOUNT MANAGER' || $request->level == 'REGIONAL' && $request->posisi == 'MANAGER MARKETING')
{
        $edit = array('name' => Input::get('name'), 'email' => Input::get('email'), 'level' => Input::get('level'), 'posisi' => Input::get('posisi'), 'regional' => '', 'area' => Input::get('area'));
}        
    }
    else
    {
if($request->level == 'REGIONAL' && $request->posisi == 'ACCOUNT MANAGER' || $request->level == 'REGIONAL' && $request->posisi == 'AM SUPPORT')
{        
         $edit = array('name' => Input::get('name'), 'email' => Input::get('email'), 'password' =>  Hash::make(Input::get('password')), 'level' => Input::get('level'), 'posisi' => Input::get('posisi'), 'regional' => strtoupper(Input::get('regional')), 'area' => Input::get('area'));
} 
elseif($request->level == 'HQ' && $request->posisi == 'MANAGER' || $request->level == 'HQ' && $request->posisi == 'ACCOUNT MANAGER' || $request->level == 'REGIONAL' && $request->posisi == 'MANAGER MARKETING')
{
         $edit = array('name' => Input::get('name'), 'email' => Input::get('email'), 'password' =>  Hash::make(Input::get('password')), 'level' => Input::get('level'), 'posisi' => Input::get('posisi'), 'regional' => '', 'area' => Input::get('area'));
}        
    }
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'users' ,'action' => 'update', 'data' => json_encode($cek)]);
$cek->update($edit);
UserExist::where("id",$id)->update($edit);
return response()->json(['success'=>'Edit Successfully']);
    }
else
    {
 return response()->json('error', $valid);
    }
} 
    }



    
}
