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
use App\Models\BaksBauk;
use App\Models\BoqBaps;
use App\Models\Baps;
use App\Models\Invoice;


class ProjectController extends Controller
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
    $this->data['tahunproject']  = DB::table('vtahun')->get();
    }

    
    public function index(Request $request)
    { 
        $perPage = $request->per_page;
         $search = $request->filter;
         $infratype = $request->infratypenya;
         $statusnya = $request->statusnya;
         $towernya = $request->towernya;
         $min = $request->min;
         $max = $request->max;
 
 $query =  DB::table('vallproject')->orderBy('id','DESC');
 
 
  if (!empty($towernya))
   { 
    $query = $query->where('tower_high', $towernya);
   }
 
  if (!empty($infratype))
   { 
    $query = $query->where('infratype', $infratype);
   }
  if (!empty($statusnya))
   { 
    $query = $query->whereIn('status_id', [$statusnya]);
   }
 
  if (!empty($search))
   {
     $like = "%{$search}%";
     $query = $query->where('projectid', 'LIKE', $like)
             ->orWhere('batchnya', 'LIKE', $like)
             ->orWhere('no_wo', 'LIKE', $like)
             ->orWhere('regional', 'LIKE', $like);
   }
 
  if (!empty($min) && empty($max))
   { 
    $query = $query->whereDate('created_at','=',$min);
   }
  
  if (empty($min) && !empty($max))
   { 
    $query = $query->whereDate('created_at','=',$max);
   }
  
  if (!empty($min) && !empty($max))
   { 
    $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
   }
  
         return $query->paginate($perPage);
    }


        public function store(Request $request)
    {
$valid = $this->validate($request, [
        'projectid' => 'required|max:255|unique:project,projectid',
        'no_wo' => 'required|max:255',
        'wo_date' => 'date_format:"Y-m-d"|required',
        'batch' => 'required|numeric|not_in:0',
        'years' => 'required|numeric|not_in:0',
        'infratype' => 'required|in:UNTAPPED,B2S',
        'area' => 'required|in:1,2,3,4',
        'regional' => 'required|max:255',
        'site_id_spk' => 'required|max:255',
        'site_name_spk' => 'required|max:255',
        'address_spk' => 'required',
        'longitude_spk' => 'required|max:255',
        'latitude_spk' => 'required|max:255',
        'status_id' => 'required|numeric|not_in:0',
        'project_status_id' => 'required|numeric',
    ]);
if (!$valid)
    {
$masuk = array('projectid' => strtoupper($request->projectid), 'no_wo' => strtoupper($request->no_wo) , 'wo_date' => $request->wo_date , 'batch' => $request->batch ,'years' =>$request->years, 'infratype' => $request->infratype, 'area' =>  strtoupper($request->area), 'regional' =>  strtoupper($request->regional), 'site_id_spk' =>  strtoupper($request->site_id_spk), 'site_name_spk' =>  strtoupper($request->site_name_spk), 'address_spk' =>  strtoupper($request->address_spk),  'longitude_spk' =>  strtoupper($request->longitude_spk),  'latitude_spk' =>  strtoupper($request->latitude_spk), 'status_id' => $request->status_id, 'project_status_id' => $request->project_status_id); 
Project::create($masuk);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'project' ,'action' => 'insert', 'data' => json_encode($masuk)]);
return response()->json(['success'=>'Add Successfully']);        
    }
else
    {
 return response()->json('error', $valid);
    } 
    }



    public function update(Request $request, $id)
    { 

    }

     public function destroy($id)
    {
$cek = Project::findOrFail($id);
if(!$cek)
{
 return response()->json(['error'=>'Data Not Found']);
}
else
{
    $destinationPath = 'files/'.$cek->projectid; // upload path
    File::delete($destinationPath);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'project' ,'action' => 'delete', 'data' => json_encode($cek)]);
Project::where('id',$id)->delete();
DokumenSIS::where('project_id',$id)->delete(); 
DokumenDRM::where('project_id',$id)->delete(); 
DokumenSITAC::where('project_id',$id)->delete(); 
DokumenRFC::where('project_id',$id)->delete(); 
BOQ::where('project_id',$id)->delete(); 
SiteOpening::where('project_id',$id)->delete(); 
Excavation::where('project_id',$id)->delete(); 
Rebaring::where('project_id',$id)->delete(); 
Pouring::where('project_id',$id)->delete(); 
Curing::where('project_id',$id)->delete(); 
TowerErection::where('project_id',$id)->delete(); 
MEProcess::where('project_id',$id)->delete(); 
FenceYard::where('project_id',$id)->delete(); 
RfiBaut::where('project_id',$id)->delete(); 
RfiDetail::where('project_id',$id)->delete();
BaksBauk::where('project_id',$id)->delete();
BoqBaps::where('project_id',$id)->delete();
Baps::where('project_id',$id)->delete();
Invoice::where('project_id',$id)->delete();
return response()->json(['success'=>'Delete Successfully']);

}
    }


         public function GetProjectDetail($id)
    {
$sis =  DokumenSIS::select('id','document_sis','created_at')->where('project_id',$id)->first();
$drm =  DokumenDRM::select('site_id_actual','site_name_actual','province','city','address_actual','longitude_actual','latitude_actual','kom_date','drm_date','document_kom','document_drm','created_at')->where('project_id',$id)->first();
$sitac =  DokumenSITAC::select('no_ban_bak','date_ban_bak','document_ban_bak','ijin_warga_date','document_ijin_warga','no_pks','pks_date','document_pks','no_imb','imb_date','document_imb','created_at')->where('project_id',$id)->first();
$rfc =  DokumenRFC::select('no_rfc','rfc_date','document_rfc','id_pln','target_rfi','power_capacity','created_at')->where('project_id',$id)->first();
$boq =  BOQ::select('site_type','tower_type','roof_top_high','tower_high','rf_in_meters','mw_in_meters','created_at')->where('project_id',$id)->first();
return response()->json(['sis'=>$sis,'drm'=>$drm,'sitac'=>$sitac,'rfc'=>$rfc,'boq'=>$boq]);
    }



         public function deleteAll($id)
    {
$get =  Project::whereIn('id',explode(",",$id))->get();
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'project' ,'action' => 'delete', 'data' => json_encode($get)]);
Project::whereIn('id',explode(",",$id))->delete();
return response()->json(['success'=>"Deleted Successfully."]);
    }






     public function uploadproject(Request $request)
    {
         $valid = $this->validate($request, [
        'file_name' => 'required|mimes:xlsx',
    ]);
         if(!$valid)
         {
            $extension  = Input::file('file_name')->getClientOriginalExtension(); // getting image extension
if($extension == 'xlsx')
{
           $x = 0;
            $path = $request->file('file_name')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            if(!empty($data) && $data->count()){
                foreach ($data->toArray() as $key => $value) {
                    if(!empty($value)){
                        
                        foreach ($value as $key => $v) {   

$insert[] = ['projectid' => strtoupper($v['projectid']), 
'no_wo' => strtoupper($v['no_wo']), 
'wo_date' => strtoupper($v['wo_date']), 
'batch' => strtoupper($v['batch']), 
'years' => strtoupper($v['years']), 
'infratype' => strtoupper($v['infratype']), 
'area' => strtoupper($v['area']), 
'regional' => strtoupper($v['regional']), 
'site_id_spk' => strtoupper($v['site_id_spk']), 
'site_name_spk' => strtoupper($v['site_name_spk']), 
'address_spk' => strtoupper($v['address_spk']), 
'longitude_spk' => strtoupper($v['longitude_spk']), 
'latitude_spk' => strtoupper($v['latitude_spk']), 
'status_id' => 1, 
'project_status_id' => 0, 
'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()];  
$rules[$key.'.projectid'] = 'required|max:200|unique:project,projectid';        
$rules[$key.'.wo_date'] = 'date_format:"Y-m-d"|required';      
$rules[$key.'.batch'] =  'required|numeric|not_in:0';        
$rules[$key.'.years'] =  'required|numeric|not_in:0';  
$rules[$key.'.infratype'] =  'required|in:UNTAPPED,B2S';   
$rules[$key.'.area'] =  'required|in:1,2,3,4';    
$rules[$key.'.regional'] =  'required|max:255';    
$rules[$key.'.site_id_spk'] =  'required|max:255';    
$rules[$key.'.site_name_spk'] =  'required|max:255';    
$rules[$key.'.address_spk'] =  'required';    
$rules[$key.'.longitude_spk'] =  'required|max:255'; 
$rules[$key.'.latitude_spk'] =  'required|max:255'; 

        }
                            
                        }
                    }

                    if(!empty($insert))
                    {
$validator = Validator::make($insert, $rules);
if($validator->fails()) {
return response()->json(['file_name'=>'Silahkan perbaiki file yang anda masukan','errornya'=>$validator->errors()]);
//return response()->json(['file_name'=>'Silahkan perbaiki file yang anda masukan','errornya'=>$validator->errors()]);
} else {                     
DB::table('project')->insert($insert);
return response()->json(['success'=>'Upload Successfully']);                       
}                   
                    }
                    else
                    {
                        return response()->json(['error'=>'Tidak Data yang dimasukan']);
                    }
            
                }
     
                
            }
else
{
    return response()->json(['file_name'=>'File upload hanya berektensi .xlsx']);
}
         }
         else
         {
            return response()->json('error', $valid);
         }
    }



         public function GetAllDetailProject($id)
    {
$project = DB::table('vallproject')->where('id',$id)->first();
$pesan = DB::table('vjobcommunication') 
            ->where('project_id',$id)
            ->orderBy('id','ASC')
            ->get();

return response()->json(['project'=>$project,'komunikasi'=>$pesan]);
         
    }




        public function updateprojectByAdmin(Request $request)
    {
$valid = $this->validate($request, [
        'projectid' => 'required|max:255|unique:project,projectid,'.$request->id,
        'no_wo' => 'required|max:255',
        'wo_date' => 'date_format:"Y-m-d"|required',
        'batch' => 'required|numeric|not_in:0',
        'years' => 'required|numeric|not_in:0',
        'infratype' => 'required|in:UNTAPPED,B2S',
        'area' => 'required|in:1,2,3,4',
        'regional' => 'required|max:255',
        'site_id_spk' => 'required|max:255',
        'site_name_spk' => 'required|max:255',
        'address_spk' => 'required',
        'longitude_spk' => 'required|max:255',
        'latitude_spk' => 'required|max:255',
    ]);
if (!$valid)
    {
$edit = array('projectid' => strtoupper($request->projectid), 'no_wo' => strtoupper($request->no_wo) , 'wo_date' => $request->wo_date , 'batch' => $request->batch ,'years' =>$request->years, 'infratype' => $request->infratype, 'area' =>  strtoupper($request->area), 'regional' =>  strtoupper($request->regional), 'site_id_spk' =>  strtoupper($request->site_id_spk), 'site_name_spk' =>  strtoupper($request->site_name_spk), 'address_spk' =>  strtoupper($request->address_spk),  'longitude_spk' =>  strtoupper($request->longitude_spk),  'latitude_spk' =>  strtoupper($request->latitude_spk)); 
Project::where('id',$request->id)->update($edit);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'project' ,'action' => 'update', 'data' => json_encode($edit)]);
return response()->json(['success'=>'Edit Successfully']);        
    }
else
    {
 return response()->json('error', $valid);
    } 
    }


    
}
