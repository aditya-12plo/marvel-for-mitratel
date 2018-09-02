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
use App\Models\PO;

class POController extends Controller
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

        public function AddPO(Request $request)
    {
$valid = $this->validate($request, [
        'project_id' => 'required|numeric|not_in:0',  
        'projectid' => 'required',
        'po_date' => 'required|date|date_format:Y-m-d',
        'no_po' => 'required|max:255',
        'document' => 'required|max:255',
        'status' => 'required|numeric|not_in:0',
    ]);
if (!$valid)
    {  
PO::create(['project_id'=>Input::get('project_id') , 'no_po'=>Input::get('no_po') ,  'po_date'=>Input::get('po_date')]);
Project::where('id',Input::get('project_id'))->update(['boq_status'=>Input::get('status')]);
return response()->json(['success'=>'Successfully']); 
    }
else
{
return response()->json('error', $valid);
}

    }

}