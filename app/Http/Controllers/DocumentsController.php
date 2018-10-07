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
use App\Models\Documents;

class DocumentsController extends Controller
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
 

    public function index(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter; 

        $query = Documents::orderBy('id','DESC');

        if ($search) {
            $like = "%{$search}%";
            $query = $query->where('name', 'LIKE', $like);
        }

        return $query->paginate($perPage);
    }

    
    public function store(Request $request)
    {
        $valid = $this->validate($request, [
            'name' => 'required|max:255|unique:documents,name', 
            'filename' => 'required|max:10240'
        ]);
        if (!$valid)
        {
            $name = str_replace(' ', '_', $request->name);
            $file = Input::file('filename'); 
            $extension  = Input::file('filename')->getClientOriginalExtension();
            $destinationPath = 'documentsupload/'; // upload path   
            $fileName   = $name.'_'.time().'.'.$extension;
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
            Documents::create(['name'=>$request->name,'filename'=>$fileName]);
             return response()->json(['success'=>'Upload Successfully']);
                }

        }
        else
        {
            return response()->json('error', $valid);
        }


    }


    public function destroy($id)
    {
$cek = Documents::findOrFail($id);
if(!$cek)
{
 return response()->json(['error'=>'Data Not Found']);
}
else
{
$destinationPath = 'documentsupload/'; // upload path   
File::delete($destinationPath .$cek->filename);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'documents' ,'action' => 'delete', 'data' => json_encode($cek)]);
Documents::where('id',$id)->delete();
return response()->json(['success'=>'Delete Successfully']);

}
    }


    
    public function updateData(Request $request)
    {
        $valid = $this->validate($request, [
            'name' => 'required|max:255|unique:documents,name,'.$request->id,
            'filename_old' => 'required',
        ]);
        if (!$valid)
        {
            if(Input::file('filename'))
            {
                $name = str_replace(' ', '_', $request->name);
                $file = Input::file('filename'); 
                $extension  = Input::file('filename')->getClientOriginalExtension();
                $destinationPath = 'documentsupload/'; // upload path   
                $fileName   = $name.'_'.time().'.'.$extension;
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
                File::delete($destinationPath .$request->filename_old);        
                Documents::where('id',$request->id)->update(['name'=>$request->name,'filename'=>$fileName]);
                 return response()->json(['success'=>'Update Successfully']);
                    }
            }
            else
            {
                // $name = str_replace(' ', '_', $request->name);
                // $ext  = explode(".", $request->filename_old);
                // $fileName   = $name.'_'.time().'.'.$ext;
                // $destinationPath = 'documentsupload/'.$request->filename_old;  
                // $destinationNewPath = 'documentsupload/'.$fileName;
                // rename($destinationPath , $destinationNewPath); 
                // Documents::where('id',$request->id)->update(['name'=>$request->name,'filename'=>$fileName]);
                // return response()->json(['success'=>'Update Successfully']);
                Documents::where('id',$request->id)->update(['name'=>$request->name]);
                return response()->json(['success'=>'Update Successfully']);
            }

        }
        else
        {
            return response()->json('error', $valid);
        }


    }


}