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
        'tgl_mulai_sewa' => 'required|date|date_format:Y-m-d',
        'tgl_target_rfi' => 'required|date|date_format:Y-m-d', 
        'document_boq_baps' => 'required|mimes:pdf',
        'tgL_akhir_sewa' => 'required|date|date_format:Y-m-d', 
        'document_baps' => 'required|mimes:pdf', 
        'no_kontrak' => 'required|numeric|digits_between:1,255', 
        'no_receive' => 'required|numeric|digits_between:1,255', 
        'no_invoice' => 'required|max:255', 
        'tgl_invoice' => 'required|date|date_format:Y-m-d',  
    ]);
if (!$valid)
{

    $file = Input::file('document_boq_baps'); 
    $extension  = Input::file('document_boq_baps')->getClientOriginalExtension(); 
    $fileBaps = Input::file('document_baps'); 
    $extensionBaps  = Input::file('document_baps')->getClientOriginalExtension(); 
    if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $fileBaps->getSize() <= 10000000 && $fileBaps->getClientMimeType() == 'application/pdf')
    { 
    $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
    $fileName   = Input::get('projectid').'-document-boq-baps-'.time().'.'.$extension;
    $fileNameBaps   = Input::get('projectid').'-document-baps-'.time().'.'.$extensionBaps;
        if(file_exists($destinationPath.$fileName) || file_exists($destinationPath.$fileNameBaps))
        {
    File::delete($destinationPath .$fileName);
    File::delete($destinationPath .$fileNameBaps);
        }
    $upload_success     = $file->move($destinationPath, $fileName);
    $upload_success_baps     = $fileBaps->move($destinationPath, $fileNameBaps);
    if(!$upload_success || !$upload_success_baps)
    {
    File::delete($destinationPath .$fileName);
    File::delete($destinationPath .$fileNameBaps);
     return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
    }
    else
    {
        Invoice::create(['project_id'=>$request->project_id,'no_receive'=>$request->no_receive,'no_kontrak'=>$request->no_kontrak,'no_invoice'=>$request->no_invoice,'tgl_invoice'=>$request->tgl_invoice,'tgl_mulai_sewa'=>$request->tgl_mulai_sewa,'tgl_target_rfi'=>$request->tgl_target_rfi,'document_boq_baps'=>$fileName,'tgL_akhir_sewa'=>$request->tgL_akhir_sewa,'document_baps'=>$fileNameBaps]);
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



  public function AddDocumentRevisiInvoice(Request $request)
    { 
      $valid = $this->validate($request, [
        'projectid' => 'required|max:255',  
         'tgl_mulai_sewa' => 'required|date|date_format:Y-m-d',
         'tgl_target_rfi' => 'required|date|date_format:Y-m-d', 
         'tgL_akhir_sewa' => 'required|date|date_format:Y-m-d', 
        'no_kontrak' => 'required|numeric|digits_between:1,255', 
        'no_receive' => 'required|numeric|digits_between:1,255', 
        'no_invoice' => 'required|max:255', 
        'tgl_invoice' => 'required|date|date_format:Y-m-d', 
    ]);
if (!$valid)
{ 
Invoice::where('id',$request->id)->update(['tgl_mulai_sewa'=>$request->tgl_mulai_sewa,'tgl_target_rfi'=>$request->tgl_target_rfi,'tgL_akhir_sewa'=>$request->tgL_akhir_sewa,'no_receive'=>$request->no_receive,'no_kontrak'=>$request->no_kontrak,'no_invoice'=>$request->no_invoice,'tgl_invoice'=>$request->tgl_invoice]);
$ProjectStatus = ProjectStatus::create(['project_id' => Input::get('project_id'),'users_id' => Auth::guard('karyawan')->user()->id , 'document'=>strtoupper(Input::get('document')),'status'=>strtoupper(Input::get('statusmessage')),'message'=>strtoupper(Input::get('kata'))]);
  Project::where('id',Input::get('project_id'))->update(['project_status_id'=>$ProjectStatus->id]);
  return response()->json(['success'=>'Add Successfully']);
 
}
else
    {
 return response()->json('error', $valid);
    }
 

    }



    public function uploaddokumenBoqBaps(Request $request)
    {
      $valid = $this->validate($request, [
        'projectid' => 'required|max:255',
        'document_boq_baps' => 'required|mimes:pdf', 
    ]);
if (!$valid)
    { 
$file = Input::file('document_boq_baps'); 
$extension  = Input::file('document_boq_baps')->getClientOriginalExtension(); 
if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf')
{ 
$destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
$fileName   = Input::get('projectid').'-document-boq-baps-'.time().'.'.$extension;
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
 File::delete($destinationPath .Input::get('namafile'));
 Invoice::where('id',Input::get('id'))->update(['document_boq_baps'=>$fileName]);
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



    public function uploaddokumenBaps(Request $request)
    {
      $valid = $this->validate($request, [
        'projectid' => 'required|max:255',
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
 return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
}
else
{
 File::delete($destinationPath .Input::get('namafile'));
 Invoice::where('id',Input::get('id'))->update(['document_baps'=>$fileName]);
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




    public function uploadinvoice(Request $request)
    {
         $valid = $this->validate($request, [
        'file_name' => 'required|mimes:xlsx,xls',
    ]);
         if(!$valid)
         {
            $extension  = Input::file('file_name')->getClientOriginalExtension(); // getting image extension
if($extension == 'xlsx' || $extension == 'xls')
{
            $x = 0;
            $path = $request->file('file_name')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            if(!empty($data) && $data->count()){
                foreach ($data->toArray() as $key => $value) {
                    if(!empty($value)){
                        
                        foreach ($value as $key => $v) {
    $cek = Project::where('projectid',strtoupper($v['projectid']))->first();
    if($cek)
    {
        $insert[] = [
            'project_id' => $cek->id, 
            'projectid' => strtoupper($v['projectid']), 
            'tgl_mulai_sewa' => strtoupper($v['tgl_mulai_sewa']), 
            'tgL_akhir_sewa' => strtoupper($v['tgl_akhir_sewa']), 
            'tgl_target_rfi' => strtoupper($v['tgl_target_rfi']), 
            'no_receive' => strtoupper($v['no_receive']), 
            'no_kontrak' => strtoupper($v['no_kontrak']), 
            'no_invoice' => strtoupper($v['no_invoice']), 
            'tgl_invoice' => strtoupper($v['tgl_invoice']), 
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()];  
            $masuk[] = [
                'project_id' => $cek->id,  
                'tgl_mulai_sewa' => strtoupper($v['tgl_mulai_sewa']), 
                'tgL_akhir_sewa' => strtoupper($v['tgl_akhir_sewa']), 
                'tgl_target_rfi' => strtoupper($v['tgl_target_rfi']), 
                'no_receive' => strtoupper($v['no_receive']), 
                'no_kontrak' => strtoupper($v['no_kontrak']), 
                'no_invoice' => strtoupper($v['no_invoice']), 
                'tgl_invoice' => strtoupper($v['tgl_invoice']), 
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()]; 
                 
                $project_id[] =$cek->id;  

            $rules[$key.'.projectid'] = 'required|max:200|unique:v_check_invoice_data,projectid';        
            $rules[$key.'.tgl_mulai_sewa'] = 'date_format:"Y-m-d"|required';           
            $rules[$key.'.tgL_akhir_sewa'] = 'date_format:"Y-m-d"|required';           
            $rules[$key.'.tgl_target_rfi'] = 'date_format:"Y-m-d"|required';        
            $rules[$key.'.no_receive'] =  'required|numeric|digits_between:1,255|unique:v_check_invoice_data,no_receive';        
            $rules[$key.'.no_kontrak'] =  'required|numeric|digits_between:1,255|unique:v_check_invoice_data,no_kontrak';  
            $rules[$key.'.tgl_invoice'] =  'date_format:"Y-m-d"|required';  
            $rules[$key.'.no_invoice'] =  'required|max:255|unique:v_check_invoice_data,no_invoice';            
    }                            
  

        }
                            
                        }
                    }

                    if(!empty($insert))
                    {
$validator = Validator::make($insert, $rules);
if($validator->fails()) {
return response()->json(['file_name'=>'Silahkan perbaiki file yang anda masukan','errornya'=>$validator->errors()]); 
} else { 
$tempArr = array_unique(array_column($masuk, 'project_id'));  
$out= array_intersect_key($masuk, $tempArr);  
$comma_separated = $project_id;  
DB::table('invoice')->insert($out); 
DB::table('project')->whereIn('id', $comma_separated)->update(array('status_id' => 54));          
return response()->json(['success'=>'Successfully' , 'invoice'=>$insert]);                       
}                   
                    }
                    else
                    {
                        return response()->json(['error'=>'Tidak Data yang dimasukan']);
                    }
            
                }
                else
                {
                    return response()->json(['error'=>'Tidak Data yang dimasukan']);
                }
     
                
            }
else
{
    return response()->json(['file_name'=>'File upload hanya berektensi .xlsx / .xls']);
}
         }
         else
         {
            return response()->json('error', $valid);
         }
    }


    public function RevisiDocumentInvoiceByAdmin(Request $request)
    { 
        if(Input::get('id') == 0)
        {
            
      $valid = $this->validate($request, [
        'project_id' => 'required|max:255|unique:invoice,project_id', 
        'projectid' => 'required|max:255', 
        'tgl_mulai_sewa' => 'required|date|date_format:Y-m-d',
        'tgl_target_rfi' => 'required|date|date_format:Y-m-d', 
        'document_boq_baps' => 'required|mimes:pdf',
        'tgL_akhir_sewa' => 'required|date|date_format:Y-m-d', 
        'document_baps' => 'required|mimes:pdf', 
        'no_kontrak' => 'required|numeric|digits_between:1,255', 
        'no_receive' => 'required|numeric|digits_between:1,255', 
        'no_invoice' => 'required|max:255', 
        'tgl_invoice' => 'required|date|date_format:Y-m-d',  
    ]);
if (!$valid)
{

    $file = Input::file('document_boq_baps'); 
    $extension  = Input::file('document_boq_baps')->getClientOriginalExtension(); 
    $fileBaps = Input::file('document_baps'); 
    $extensionBaps  = Input::file('document_baps')->getClientOriginalExtension(); 
    if ($file->getSize() <= 10000000 && $file->getClientMimeType() == 'application/pdf' || $fileBaps->getSize() <= 10000000 && $fileBaps->getClientMimeType() == 'application/pdf')
    { 
    $destinationPath = 'files/'.Input::get('projectid').'/'; // upload path   
    $fileName   = Input::get('projectid').'-document-boq-baps-'.time().'.'.$extension;
    $fileNameBaps   = Input::get('projectid').'-document-baps-'.time().'.'.$extensionBaps;
        if(file_exists($destinationPath.$fileName) || file_exists($destinationPath.$fileNameBaps))
        {
    File::delete($destinationPath .$fileName);
    File::delete($destinationPath .$fileNameBaps);
        }
    $upload_success     = $file->move($destinationPath, $fileName);
    $upload_success_baps     = $fileBaps->move($destinationPath, $fileNameBaps);
    if(!$upload_success || !$upload_success_baps)
    {
    File::delete($destinationPath .$fileName);
    File::delete($destinationPath .$fileNameBaps);
     return response()->json(['errorfile'=>'File Upload Gagal, Silahkan Ulangi']);
    }
    else
    {
    $masuk = array('project_id'=>$request->project_id,'no_receive'=>$request->no_receive,'no_kontrak'=>$request->no_kontrak,'no_invoice'=>$request->no_invoice,'tgl_invoice'=>$request->tgl_invoice,'tgl_mulai_sewa'=>$request->tgl_mulai_sewa,'tgl_target_rfi'=>$request->tgl_target_rfi,'document_boq_baps'=>$fileName,'tgL_akhir_sewa'=>$request->tgL_akhir_sewa,'document_baps'=>$fileNameBaps); 
    Invoice::create($masuk);
    Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'invoice' ,'action' => 'insert', 'data' => json_encode($masuk)]);
    $project = DB::table('vallproject')->where('id',Input::get('project_id'))->first();
    return response()->json(['success'=>'Successfully','project'=>$project]); 
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
            
            $valid = $this->validate($request, [
              'project_id' => 'required|max:255|unique:invoice,project_id,'.Input::get('id'),
              'projectid' => 'required|max:255', 
              'tgl_mulai_sewa' => 'required|date|date_format:Y-m-d',
              'tgl_target_rfi' => 'required|date|date_format:Y-m-d',  
              'tgL_akhir_sewa' => 'required|date|date_format:Y-m-d',  
              'no_kontrak' => 'required|numeric|digits_between:1,255', 
              'no_receive' => 'required|numeric|digits_between:1,255', 
              'no_invoice' => 'required|max:255', 
              'tgl_invoice' => 'required|date|date_format:Y-m-d',  
          ]);
      if (!$valid)
      { 
          $edit = array('no_receive'=>$request->no_receive,'no_kontrak'=>$request->no_kontrak,'no_invoice'=>$request->no_invoice,'tgl_invoice'=>$request->tgl_invoice,'tgl_mulai_sewa'=>$request->tgl_mulai_sewa,'tgl_target_rfi'=>$request->tgl_target_rfi,'tgL_akhir_sewa'=>$request->tgL_akhir_sewa); 
          Invoice::where('id',Input::get('id'))->update($edit);
          Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'invoice' ,'action' => 'update', 'data' => json_encode($edit)]);
          $project = DB::table('vallproject')->where('id',Input::get('project_id'))->first();
          return response()->json(['success'=>'Successfully','project'=>$project]); 
          }
              else
          {
              return response()->json('error', $valid);
          }

        }
    }



}