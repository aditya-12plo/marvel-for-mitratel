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

class CuringController extends Controller
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


        public function DocumentCuringPerbaikan(Request $request)
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


        public function AddDocumentCuring(Request $request)
    {
$cekdata = Curing::where('project_id',Input::get('project_id'))->first();
if (!$cekdata) {
$valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:curing,project_id', 
        'curing_date' => 'required|date|date_format:Y-m-d',
        'curing_document' => 'required|mimes:pdf,jpg,png,jpeg', 
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
        $file = Input::file('curing_document');
         $extension  = Input::file('curing_document')->getClientOriginalExtension(); // getting image extension
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-curing-'.time().'.'.$extension; // renameing image
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
$masuk = array('project_id' => $request->project_id, 'curing_date' => $request->curing_date, 'curing_document' => $fileName); 
Curing::create($masuk);
 
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status')]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'Curing' ,'action' => 'insert', 'data' => json_encode($masuk)]);
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
        'curing_date' => 'required|date|date_format:Y-m-d',
        'curing_document' => 'required|mimes:pdf,jpg,png,jpeg', 
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
        $file = Input::file('curing_document');
         $extension  = Input::file('curing_document')->getClientOriginalExtension(); // getting image extension
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-curing-'.time().'.'.$extension; // renameing image
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
$masuk = array('project_id' => $request->project_id, 'curing_date' => $request->curing_date, 'curing_document' => $fileName); 
File::delete($destinationPath .$cekdata->curing_document);
Curing::where('id',$cekdata->id)->update($masuk);
 
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status')]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'Curing' ,'action' => 'update', 'data' => json_encode($masuk)]);
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


        public function RevisiDocumentCuring(Request $request)
    { 
$valid = $this->validate($request, [ 
        'curing_date' => 'required|date|date_format:Y-m-d',
        'curing_document' => 'nullable|mimes:pdf,jpg,png,jpeg', 
        'status' => 'required|numeric|not_in:0'
    ]);
if (!$valid)
    {
 if(Input::file('curing_document'))
 {
       $file = Input::file('curing_document');
         $extension  = Input::file('curing_document')->getClientOriginalExtension(); // getting image extension
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/png' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpg' || $file->getSize() <= 10000000 && $file->getClientMimeType() == 'image/jpeg')
{
     $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path
     $fileName   = Input::get('projectid').'-document-curing-'.time().'.'.$extension; // renameing image
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
File::delete($destinationPath .Input::get('curing_document_lama'));
$edit = array('curing_date' => $request->curing_date, 'curing_document' => $fileName);   
Curing::where('id',$request->id)->update($edit);
Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status')]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'Curing' ,'action' => 'update', 'data' => json_encode($edit)]);
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
 
$edit = array('curing_date' => $request->curing_date); 
Curing::where('id',$request->id)->update($edit);
 
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