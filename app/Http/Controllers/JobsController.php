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

class JobsController extends Controller
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

    
    public function GetDetailProjectCME($id)
    {

$query =  DB::table('vallproject')
         ->whereIn('id',explode(",",$id))->get();
return response()->json($query);

}


    public function homePage()
    {
$date = Carbon::now();  
// for national       
$total =  DB::table('vtotalproject')->where('years',$date->year)->first();     
$jumlahsemuanya =$total->jumlah;
$labeltotal = ['Dokumen RFC '.$total->jumlahrfc , 'Submit BOQ '.$total->jumlahboq , 'BOQ Verifikasi '.$total->jumlahboqverifikasi , 'BOQ Proses PR '.$total->jumlahboqprosespr , 'BOQ PO Release '.$total->jumlahboqrelease, 'DROP Site '.$total->jumlahdrop];
$resultTotal = [$total->jumlahrfc,$total->jumlahboq,$total->jumlahboqverifikasi,$total->jumlahboqprosespr ,$total->jumlahboqrelease,$total->jumlahdrop];  
$totallabel = ['labels'=>$labeltotal , 'result'=> $resultTotal];

$labeltotalproject = ['Dokumen KOM / SIS '.$total->jumlahsis , 'Dokumen SITAC '.$total->jumlahsitac , 'Dokumen RFC '.$total->jumlahrfc , 'Dokumen CME '.$total->cme];
$resultTotalproject = [$total->jumlahsis,$total->jumlahsitac,$total->jumlahrfc,$total->cme];  
$totallabelproject = ['labels'=>$labeltotalproject , 'result'=> $resultTotalproject];

//for area
$area =  DB::table('vtotalprojectarea')->where('years',$date->year)->get();

foreach($area as $ar)
{
    $areatitle[] = 'AREA '.$ar->area.' '.$ar->jumlah;
    $areajml[] = $ar->jumlah; 
}
$totalareanasional = ['labels'=>$areatitle , 'result'=> $areajml];

// for regional        
$regional =  DB::table('vtotalprojectregional')->where('years',$date->year)->get(); 
foreach($regional as $reg)
{
    $regionaltitle[] = $reg->regional.' '.$reg->jumlah;
    $regionaljml[] = $reg->jumlah; 
}
$totalregionalnasional = ['labels'=>$regionaltitle , 'result'=> $regionaljml];

 

return response()->json(['jumlahsemuanya'=>$jumlahsemuanya,'years'=>$date->year,'totallabels'=>$totallabel,'totalareanasional'=>$totalareanasional,'totalregionalnasional'=>$totalregionalnasional,'totallabelproject'=>$totallabelproject ]);
    

    }
     
    
    public function GetJobsDocumentSIS(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentsis')
         ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


    public function GetJobsRevisiDocumentSIS(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentsisrevisi')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


    public function GetJobsApprovalDocumentSIS(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsapprovaldocumentsis')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }



// DRM DOCUMENT

    
    public function GetJobsDocumentDRM(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentdrm')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


    
    public function GetJobsApprovalDocumentDRM(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsapprovaldocumentdrm')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }




    public function GetJobsRevisiDocumentDRM(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentdrmrevisi')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }



// SITAC DOCUMENT

    
    public function GetJobsDocumentSITAC(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentsitac')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }




    public function GetJobsApprovalDocumentSITAC(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsapprovaldocumentsitac')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }




    public function GetJobsRevisiDocumentSITAC(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentsitacrevisi')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }




// SITAC RFC

    
    public function GetJobsDocumentRFC(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentrfc')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }




    public function GetJobsApprovalDocumentRFC(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsapprovaldocumentrfc')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }



    public function GetJobsRevisiDocumentRFC(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentrfcrevisi')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }



    public function GetJobsBOQ(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobboq')
        ->where(function ($query) {
            $query->where('area', Auth::guard('karyawan')->user()->area)
                  ->orWhere('area', Auth::guard('karyawan')->user()->area2);
        }) 
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }

    public function GetJobsPO(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobpo')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }

// MAPPING SITE

 public function GetJobsMappingSite(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsmappingsite')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


 public function GetJobsMappingSiteApproved(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsapprovedmappingsite')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


// DROP SITE

 public function GetJobsApprovalDrop(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsapprovaldropsiteregional')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


 public function GetJobsApprovalDropHQ(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsapprovaldropsiteHQ')
        ->where(function ($query) {
    $query->where('area', Auth::guard('karyawan')->user()->area)
          ->orWhere('area', Auth::guard('karyawan')->user()->area2);
})
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }

// HISTORY DROP SITE

 public function HistoryDropSite(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vhistorydropsite')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


// MAPPING DROP SITE
 public function HistoryMappingSite(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vhistorymappingsite')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }




// submit boq
 public function GetJobsSubmitBOQ(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter; 
        $infratypenya = $request->infratypenya; 
        $towernya = $request->towernya; 
        $query =  DB::table('vjobsubmitboq')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && $infratypenya && $towernya) {
            $like = "%{$search}%";
            $query = $query
            ->where([['projectid', 'LIKE', $like],['infratype',$infratypenya],['tower_high',$towernya]])
            ->orWhere('regional', 'LIKE', $like);
        } 

        if (!$search && $infratypenya && $towernya) { 
            $query = $query
            ->where([['infratype',$infratypenya],['tower_high',$towernya]]);
        } 

        if (!$search && !$infratypenya && $towernya) { 
            $query = $query
            ->where('tower_high',$towernya);
        } 

        if (!$search && $infratypenya && !$towernya) { 
            $like = "%{$search}%";
            $query = $query
            ->where([['projectid', 'LIKE', $like],['tower_high',$towernya]])
            ->orWhere('regional', 'LIKE', $like);
        } 

        if ($search && $infratypenya && !$towernya) { 
            $like = "%{$search}%";
            $query = $query
            ->where([['projectid', 'LIKE', $like],['infratype',$infratypenya]])
            ->orWhere('regional', 'LIKE', $like);
        } 

        if ($search && !$infratypenya && !$towernya) { 
            $like = "%{$search}%";
             $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('regional', 'LIKE', $like);
        } 

        if (!$search && $infratypenya && !$towernya) { 
            $query = $query
            ->where('infratype',$infratypenya);
        } 

        if (!$search && !$infratypenya && $towernya) { 
            $query = $query
            ->where('tower_high',$towernya);
        } 

        return $query->paginate($perPage);
    }


 


 public function GetJobsSubmitBOQData(Request $request)
    { 
        $batch = $request->batch; 
        $years = $request->years;   
        $search = $request->filter; 
        $perPage = $request->per_page;

        $query =  DB::table('vjobsubmitboq')
        ->where([['area',Auth::guard('karyawan')->user()->area],['years',$years]])
        ->orderBy('id','DESC');

         return $query->paginate($perPage);
    }



// get infratype
 public function GetInfratype()
    {

$infratype = DB::table('vinfratype')->get();
 $data = array();
 foreach($infratype as $c)
 {
    $data[] = $c->infratype;
 }
 
      return response()->json($data);
    }



// get tower high
 public function GetTowerHigh()
    { 
$tower = DB::table('vtinggitower')->get(); 
 $data = array();
 foreach($tower as $c)
 {
    $data[] = $c->tower_high;
 }
 
      return response()->json($data);
    }


// get batch
 public function GetBatch()
    { 
$batch = DB::table('vallbatch')->get(); 
 
      return response()->json($batch);
    }


// get status project
 public function GetStatus()
    { 
$data = DB::table('status_group')->select('name','status_id')->orderBy('id','ASC')->get();  
 
  
      return response()->json($data);
    }



// boq approval by manager 
    public function GetJobsBOQApproval(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vboqsubmitdata')
            ->where(function ($query) {
    $query->where([['area', Auth::guard('karyawan')->user()->area],['status',0]])
          ->orWhere([['area', Auth::guard('karyawan')->user()->area2],['status',0]]);
})->orderBy('id','DESC');
 

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }

    // boq approval repair
    public function GetJobsSubmitBOQRepair(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vboqsubmitdata')
            ->where([['area', Auth::guard('karyawan')->user()->area],['status',1]])->orderBy('id','DESC');
 

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }

    // boq approved
    public function GetJobsSubmitBOQApproved(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vboqsubmitdata')
            ->where([['area', Auth::guard('karyawan')->user()->area],['status',2]])->orderBy('id','DESC');
 

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }



public function GetJobsSubmitBOQVerifikasi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vboqsubmitdataverifikasi')
            ->where([['area', Auth::guard('karyawan')->user()->area],['status',2]])->orderBy('id','DESC');
 

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }

public function GetJobsSubmitBOQProsesPR(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vboqsubmitdataprosespr')
            ->where([['area', Auth::guard('karyawan')->user()->area],['status',2]])->orderBy('id','DESC');
 

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


public function GetJobsSubmitBOQPORelease(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vboqsubmitdataporelease')
            ->where([['area', Auth::guard('karyawan')->user()->area],['status',2]])->orderBy('id','DESC');
 

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('boq_code', 'LIKE', $like)
            ->orWhere('title', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


public function GetJobsSiteOpening(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsiteopening')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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


public function GetJobsSiteOpeningRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsiteopeningrevisi')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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




public function GetJobsExcavation(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsiteexcavation')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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



public function GetJobsExcavationRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsiteexcavationrevisi')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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





public function GetJobsRebaring(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsiterebaring')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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



public function GetJobsRebaringRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsiterebaringrevisi')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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





public function GetJobsPouring(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsitepouring')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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




public function GetJobsPouringRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsitepouringrevisi')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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



public function GetJobsCuring(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsitecuring')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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



public function GetJobsCuringRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsitecuringrevisi')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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



public function GetJobsTowerErection(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsitetowererection')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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



public function GetJobsTowerErectionRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsitetowererectionrevisi')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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




public function GetJobsMEProcess(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsitemeprocess')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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




public function GetJobsMEProcessRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsitemeprocessrevisi')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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





public function GetJobsFenceYard(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsitefenceyard')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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




public function GetJobsFenceYardRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsitefenceyardrevisi')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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



public function GetJobsRfiBaut(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


 $query = DB::table('vsiterfibaut')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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


public function GetJobsRfiBautRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


$query = DB::table('vsiterfibautrevisi')
            ->where('regional', Auth::guard('karyawan')->user()->regional)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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




public function GetJobsApprovalDocumentCME(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


$query = DB::table('vsitecmeapproval')
            ->where('area', Auth::guard('karyawan')->user()->area)->orderBy('id','DESC');
 

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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




public function GetJobsApprovalDocumentBaksBauk(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;


$query = DB::table('vallprojectapprovalbaksbaukarea')
            ->where('area', Auth::guard('karyawan')->user()->area)->orderBy('id','DESC');
 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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






public function GetJobsRfiDetail(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;

 $query =  DB::table('vsitecrfidetail')
        ->where(function ($query) {
    $query->where('area', Auth::guard('karyawan')->user()->area)
          ->orWhere('area', Auth::guard('karyawan')->user()->area2);
})
        ->orderBy('id','DESC');

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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





public function GetJobsSubmitCMEApproval(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;

 $query =  DB::table('vsitecrfidetailapproval')
        ->where(function ($query) {
    $query->where('area', Auth::guard('karyawan')->user()->area)
          ->orWhere('area', Auth::guard('karyawan')->user()->area2);
})
        ->orderBy('id','DESC');

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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






public function GetJobsRfiDetailRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;

 $query =  DB::table('vsitecrfidetailrevisi')
        ->where(function ($query) {
    $query->where('area', Auth::guard('karyawan')->user()->area)
          ->orWhere('area', Auth::guard('karyawan')->user()->area2);
})
        ->orderBy('id','DESC');

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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





public function GetJobsSubmitCME(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya; 
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;

 $query =  DB::table('vsitesubmitcme')
        ->where(function ($query) {
    $query->where('area', Auth::guard('karyawan')->user()->area)
          ->orWhere('area', Auth::guard('karyawan')->user()->area2);
})
        ->orderBy('id','DESC');

 if (!empty($towernya))
  { 
   $query = $query->where('tower_high', $towernya);
  }

 if (!empty($infratype))
  { 
   $query = $query->where('infratype', $infratype);
  } 

 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like)
            ->orWhere('batchnya', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like);
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



// cme approval
    public function GetJobsApprovalDocumentCMESubmit(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vcmesubmitdata')
            ->where(function ($query) {
    $query->where('area', Auth::guard('karyawan')->user()->area)
          ->orWhere('area', Auth::guard('karyawan')->user()->area2);
})
        ->orderBy('id','DESC');
 

        if (!empty($search)) {
            $like = "%{$search}%";
            $query = $query->where('cme_code', 'LIKE', $like);
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




// cme revisi
    public function GetJobsApprovalDocumentCMESubmitRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vcmesubmitdatarevisi')
            ->where(function ($query) {
    $query->where('area', Auth::guard('karyawan')->user()->area)
          ->orWhere('area', Auth::guard('karyawan')->user()->area2);
})
        ->orderBy('id','DESC');
 

        if (!empty($search)) {
            $like = "%{$search}%";
            $query = $query->where('cme_code', 'LIKE', $like);
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




public function GetJobsSubmitCMERevisian(Request $request , $id)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;

 $query =  DB::table('vsitesubmitcme')
        ->where(function ($query) {
    $query->where('area', Auth::guard('karyawan')->user()->area)
          ->orWhere('area', Auth::guard('karyawan')->user()->area2);
})->whereNotIn('id',explode(",",$id))
        ->orderBy('id','DESC');


 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like);
  }


        return $query->paginate($perPage);
    }


// cme print
    public function GetJobsApprovedDocumentCME(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vsiteapprovedcme')
            ->where(function ($query) {
    $query->where('area', Auth::guard('karyawan')->user()->area)
          ->orWhere('area', Auth::guard('karyawan')->user()->area2);
})
        ->orderBy('id','DESC');
 

if (!empty($search)) {
            $like = "%{$search}%";
            $query = $query->where('cme_code', 'LIKE', $like);
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

// cme To Accrued
    public function GetJobsApprovedDocumentCMEToAccrued(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vsiteapprovedcmetoaccrued')
            ->where(function ($query) {
    $query->where('area', Auth::guard('karyawan')->user()->area)
          ->orWhere('area', Auth::guard('karyawan')->user()->area2);
})
        ->orderBy('id','DESC');
 

if (!empty($search)) {
            $like = "%{$search}%";
            $query = $query->where('cme_code', 'LIKE', $like);
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



// cme Accrued
    public function GetJobsApprovedDocumentCMEAccruedData(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vsiteapprovedcmeaccrueddata')
            ->where(function ($query) {
    $query->where('area', Auth::guard('karyawan')->user()->area)
          ->orWhere('area', Auth::guard('karyawan')->user()->area2);
})
        ->orderBy('id','DESC');
 

if (!empty($search)) {
            $like = "%{$search}%";
            $query = $query->where('cme_code', 'LIKE', $like);
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


    
    public function GetJobsDocumentBaksBauk(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentbaksbauk')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area],['regional',Auth::guard('karyawan')->user()->regional]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


    
    public function GetJobsDocumentBaksBaukRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vallprojectbaksbaukrevisi')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area],['regional',Auth::guard('karyawan')->user()->regional]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }



// boq baps
    public function GetJobsDocumentBoqBaps(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vsiteapprovedboqbapsadd')->orderBy('id','DESC');
 

if (!empty($search)) {
            $like = "%{$search}%";
            $query = $query->where('projectid', 'LIKE', $like);
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




    public function GetJobsDocumentBoqBapsRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vsiteapprovedboqbapsrevisi')->orderBy('id','DESC');
 

if (!empty($search)) {
            $like = "%{$search}%";
            $query = $query->where('projectid', 'LIKE', $like);
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



// baps
    public function GetJobsDocumentBaps(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vsiteapprovedbapsadd')->orderBy('id','DESC');
 

if (!empty($search)) {
            $like = "%{$search}%";
            $query = $query->where('projectid', 'LIKE', $like);
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




    public function GetJobsDocumentBapsRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vsiteapprovedboqbapsrevisi')->orderBy('id','DESC');
 

if (!empty($search)) {
            $like = "%{$search}%";
            $query = $query->where('projectid', 'LIKE', $like);
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




// invoice
    public function GetJobsDocumentInvoice(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vsiteapprovedinvoiceadd')->orderBy('id','DESC');
 

if (!empty($search)) {
            $like = "%{$search}%";
            $query = $query->where('projectid', 'LIKE', $like);
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



    public function GetJobsDocumentInvoiceRevisi(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
 $query = DB::table('vsiteapprovedboqbapsrevisi')->orderBy('id','DESC');
 

if (!empty($search)) {
            $like = "%{$search}%";
            $query = $query->where('projectid', 'LIKE', $like);
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



    public function GetJobsReportBisnis(Request $request)
    { 
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya;
        $statusnya = $request->statusnya;
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;

$query =  DB::table('vsitereportbisnis')->orderBy('id','DESC');

 
 if (!empty($search))
  {
    $like = "%{$search}%";
    $query = $query->where('projectid', 'LIKE', $like);
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




}
