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

class TowerErectionController extends Controller
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



    public function RevisiDocumentTowerErectionByAdmin(Request $request)
    {
        if(Input::get('id') == 0)
        {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:tower_erection,project_id', 
        'projectid' => 'required|max:255',
        'tower_erection_date' => 'required|date|date_format:Y-m-d',
        'tower_erection_document' => 'required|mimes:pdf,jpg,png,jpeg', 
    ]);
if (!$valid)
    {
        $file = Input::file('tower_erection_document');
         $extension  = Input::file('tower_erection_document')->getClientOriginalExtension(); // getting image extension
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-tower-erection-'.time().'.'.$extension; // renameing image
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
$masuk = array('project_id' => $request->project_id, 'tower_erection_date' => $request->tower_erection_date, 'tower_erection_document' => $fileName); 
TowerErection::create($masuk);
 
Project::where('id',Input::get('project_id'))->update(['status_id'=>33]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'tower_erection' ,'action' => 'insert', 'data' => json_encode($masuk)]);
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
    'project_id' => 'required|max:255|unique:tower_erection,project_id,'.$request->id, 
    'projectid' => 'required|max:255',
    'tower_erection_date' => 'required|date|date_format:Y-m-d',
]);
if (!$valid)
{

$edit = array('tower_erection_date' => $request->tower_erection_date); 
TowerErection::where('id',Input::get('id'))->update($edit);

Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'tower-erection' ,'action' => 'update', 'data' => json_encode($edit)]);
$project = DB::table('vallproject')->where('id',Input::get('project_id'))->first();
return response()->json(['success'=>'Edit Successfully','project'=>$project]);   
 
}
else
{
return response()->json('error', $valid);
}
}
    }


    public function uploaddokumenTowerErectionByAdmin(Request $request)
    { 
$valid = $this->validate($request, [ 
        'project_id' => 'required',
        'projectid' => 'required',
        'tower_erection_document_old' => 'required',
        'tower_erection_document' => 'required|mimes:pdf,jpg,png,jpeg'
    ]);
if (!$valid)
    {
       $file = Input::file('tower_erection_document');
         $extension  = Input::file('tower_erection_document')->getClientOriginalExtension(); // getting image extension
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-tower-erection-'.time().'.'.$extension; // renameing image
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
File::delete($destinationPath .Input::get('tower_erection_document_old'));
$edit = array('tower_erection_document' => $fileName);   
TowerErection::where('id',$request->id)->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'tower-erection' ,'action' => 'update', 'data' => json_encode($edit)]);
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



        public function DocumentTowerErectionPerbaikan(Request $request)
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


        public function AddDocumentTowerErection(Request $request)
    {
$cekdata = TowerErection::where('project_id',Input::get('project_id'))->first();
if (!$cekdata) {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:tower_erection,project_id', 
        'tower_erection_date' => 'required|date|date_format:Y-m-d',
        'tower_erection_document' => 'required|mimes:pdf,jpg,png,jpeg', 
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
$file = Input::file('tower_erection_document');
$extension  = Input::file('tower_erection_document')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-tower-erection-'.time().'.'.$extension; // renameing image
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
$masuk = array('project_id' => $request->project_id, 'tower_erection_date' => $request->tower_erection_date, 'tower_erection_document' => $fileName); 
TowerErection::create($masuk);
 
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status')]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'tower_erection' ,'action' => 'insert', 'data' => json_encode($masuk)]);
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
        'tower_erection_date' => 'required|date|date_format:Y-m-d',
        'tower_erection_document' => 'required|mimes:pdf,jpg,png,jpeg', 
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
        $file = Input::file('tower_erection_document');
         $extension  = Input::file('tower_erection_document')->getClientOriginalExtension(); // getting image extension
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-tower-erection-'.time().'.'.$extension; // renameing image
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
$masuk = array('project_id' => $request->project_id, 'tower_erection_date' => $request->tower_erection_date, 'tower_erection_document' => $fileName); 
File::delete($destinationPath .$cekdata->tower_erection_document);
TowerErection::where('id',$cekdata->id)->update($masuk);
 
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status')]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'tower_erection' ,'action' => 'update', 'data' => json_encode($masuk)]);
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


        public function RevisiDocumentTowerErection(Request $request)
    { 
$valid = $this->validate($request, [ 
        'tower_erection_date' => 'required|date|date_format:Y-m-d',
        'tower_erection_document' => 'nullable|mimes:pdf,jpg,png,jpeg', 
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
 if(Input::file('tower_erection_document'))
 {
$file = Input::file('tower_erection_document');
$extension  = Input::file('tower_erection_document')->getClientOriginalExtension();

if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-tower-erection-'.time().'.'.$extension; // renameing image
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
File::delete($destinationPath .Input::get('tower_erection_document_lama'));
$edit = array('tower_erection_date' => $request->tower_erection_date, 'tower_erection_document' => $fileName);   
TowerErection::where('id',$request->id)->update($edit);
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status')]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'tower_erection' ,'action' => 'update', 'data' => json_encode($edit)]);
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
 
$edit = array('tower_erection_date' => $request->tower_erection_date); 
TowerErection::where('id',$request->id)->update($edit);
 
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status')]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'Curing' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Successfully']); 
 
 
 }  	
 
        
    }
else
    {
 return response()->json('error', $valid);
    }
  
    }


}