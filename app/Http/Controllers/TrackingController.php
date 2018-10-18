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

class TrackingController extends Controller
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

        $query =  DB::table('vallprojectbyyears')->orderBy('id','DESC');


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
   $query = $query->whereIn('status_id', [$statusnya])->orWhereIn('boq_status',[$statusnya])->orWhereIn('haki_status',[$statusnya]);
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




    public function historyPieChart($years)
    { 
// for national       
$total =  DB::table('vtotalproject')->where('years',$years)->first();     
$totalline =  DB::table('vbiayasewanational')->where('years',$years)->get();     

$labeltotal = ['Dokumen RFC '.$total->jumlahrfc , 'Submit BOQ '.$total->jumlahboq , 'BOQ Verifikasi '.$total->jumlahboqverifikasi , 'BOQ Proses PR '.$total->jumlahboqprosespr , 'BOQ PO Release '.$total->jumlahboqrelease, 'DROP Site '.$total->jumlahdrop];
$resultTotal = [$total->jumlahrfc,$total->jumlahboq,$total->jumlahboqverifikasi,$total->jumlahboqprosespr ,$total->jumlahboqrelease,$total->jumlahdrop];  
$totallabel = ['labels'=>$labeltotal , 'result'=> $resultTotal];

$labeltotalproject = ['Dokumen KOM / SIS '.$total->jumlahsis , 'Dokumen SITAC '.$total->jumlahsitac , 'Dokumen RFC '.$total->jumlahrfc , 'Dokumen CME '.$total->cme];
$resultTotalproject = [$total->jumlahsis,$total->jumlahsitac,$total->jumlahrfc,$total->cme];  
$totallabelproject = ['labels'=>$labeltotalproject , 'result'=> $resultTotalproject];

$labeltotalprojectinvoice = ['Dokumen BAKS-BAUK '.$total->jumlahbaksbauk , 'Invoice '.$total->jumlahinvoice];
$resultTotalprojectinvoice = [$total->jumlahbaksbauk,$total->jumlahinvoice];  
$totallabelprojectinvoice= ['labels'=>$labeltotalprojectinvoice , 'result'=> $resultTotalprojectinvoice];

$jumlahsemuanya =$total->jumlah;

foreach($totalline as $arN)
{
    $labelslineavg[] = $arN->infratype.' Rp. '.number_format($arN->jumlah, 2 , '.' , ',' );
    $totaljmlN[] =$arN->jumlah;
}
$totallineavg = ['labels'=> $labelslineavg, 'result'=> $totaljmlN];

//for area
$area =  DB::table('vtotalprojectarea')->where('years',$years)->get();
$arealine =  DB::table('vbiayasewaarea')->where('years',$years)->get();

foreach($area as $ar)
{
    $areatitle[] = 'AREA '.$ar->area.' '.$ar->jumlah;
    $areajml[] = $ar->jumlah; 
}
$totalareanasional = ['labels'=>$areatitle , 'result'=> $areajml];

foreach($arealine as $arl)
{
    $areatitleline[] = 'AREA '.$arl->area.' Rp. '.number_format($arl->jumlah, 2 , '.' , ',' );
    $areajmlline[] = $arl->jumlah; 
}
$totalareanasional = ['labels'=>$areatitle , 'result'=> $areajml];
$totalareanasionalline = ['labels'=>$areatitleline , 'result'=> $areajmlline];

// for regional        
$regional =  DB::table('vtotalprojectregional')->where('years',$years)->get(); 
$regionalline =  DB::table('vbiayasewaregional')->where('years',$years)->get(); 
foreach($regional as $reg)
{
    $regionaltitle[] = $reg->regional.' '.$reg->jumlah;
    $regionaljml[] = $reg->jumlah; 
}
foreach($regionalline as $regl)
{
    $regionaltitleline[] = $regl->regional.' Rp. '.number_format($regl->jumlah, 2 , '.' , ',' );
    $regionaljmlline[] = $regl->jumlah; 
}
$totalregionalnasional = ['labels'=>$regionaltitle , 'result'=> $regionaljml];
$totalregionalnasionalline = ['labels'=>$regionaltitleline , 'result'=> $regionaljmlline];

 

return response()->json(['jumlahsemuanya'=>$jumlahsemuanya,'totallabelsbyyears'=>$totallabel,'totalareabyyears'=>$totalareanasional,'totalregionalbyyears'=>$totalregionalnasional, 'totalchartmbadian'=>$totallabelprojectinvoice, 'totallineavg'=>$totallineavg , 'totalareanasionalline'=>$totalareanasionalline, 'totalregionalnasionalline'=>$totalregionalnasionalline,'totallabelproject'=>$totallabelproject ]);

    }



    public function TrackingSiteByYears(Request $request,$years)
    { 
       $perPage = $request->per_page;
        $search = $request->filter;
        $infratype = $request->infratypenya;
        $statusnya = $request->statusnya;
        $towernya = $request->towernya;
        $min = $request->min;
        $max = $request->max;

$query =  DB::table('vallproject')->where('years',$years)->orderBy('id','DESC');


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



}