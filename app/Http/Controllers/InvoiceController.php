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
use App\Models\Invoice;

class InvoiceController extends Controller
{
        public function __construct()
    {
        $this->middleware('karyawan.auth');
        $this->data['title']  = 'Selamat Datang';
        $this->SendEmailController = app('App\Http\Controllers\SendEmailController');
    $this->data['tahunproject']  = DB::table('vtahun')->get();
    }



  public function AddDocumentInvoice(Request $request)
    {
$cekdata = Invoice::where('project_id',$request->project_id)->first();
if (count($cekdata) > 0) 
{ 
	return response()->json(['error'=>'Opps Something Wrong']);
}
else
{
      $valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:invoice,project_id', 
        'projectid' => 'required|max:255', 
        'no_kontrak' => 'required|numeric|digits_between:1,255', 
        'no_receive' => 'required|numeric|digits_between:1,255', 
        'no_invoice' => 'required|max:255', 
        'tgl_invoice' => 'required|date|date_format:Y-m-d',  
    ]);
if (!$valid)
{
Invoice::create(['project_id'=>$request->project_id,'no_receive'=>$request->no_receive,'no_kontrak'=>$request->no_kontrak,'no_invoice'=>$request->no_invoice,'tgl_invoice'=>$request->tgl_invoice]);
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('kata'))]);
  Project::where('id',Input::get('project_id'))->update(['status_id'=>Input::get('status'),'project_status_id'=>$ProjectStatus->id]);
  return response()->json(['success'=>'Add Successfully']);
 
}
else
    {
 return response()->json('error', $valid);
    }
}
    }



  public function AddDocumentRevisiInvoice(Request $request)
    {
$cekdata = Invoice::where('id',$request->id)->first();
if (count($cekdata) > 0) 
{
      $valid = $this->validate($request, [
        'projectid' => 'required|max:255', 
         'projectid' => 'required|max:255', 
        'no_kontrak' => 'required|numeric|digits_between:1,255', 
        'no_receive' => 'required|numeric|digits_between:1,255', 
        'no_invoice' => 'required|max:255', 
        'tgl_invoice' => 'required|date|date_format:Y-m-d', 
    ]);
if (!$valid)
{ 
Invoice::where('id',$request->id)->update(['no_receive'=>$request->no_receive,'no_kontrak'=>$request->no_kontrak,'no_invoice'=>$request->no_invoice,'tgl_invoice'=>$request->tgl_invoice]);
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('kata'))]);
  Project::where('id',Input::get('project_id'))->update(['project_status_id'=>$ProjectStatus->id]);
  return response()->json(['success'=>'Add Successfully']);
 
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