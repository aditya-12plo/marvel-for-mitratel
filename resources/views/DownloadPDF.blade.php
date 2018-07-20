<html>
    <body style="padding:0;font-size: 10px;">
	
 <table border="0" style="padding:0;">
            <tr>
                <th colspan="8" align="center"><h1>BILL OF QUANTITY ACTUAL</h1></th>
            </tr>
            <tr>
                <td colspan="8"><h3><b> PROJECT ID : {{$header['projectid']}}</b></h3></td>
            </tr>
             <tr>
                <td colspan="8"><h3><b> DMT : {{$header['no_doc']}}</b></h3></td>
            </tr>
            <tr>
                <td colspan="8"></td>
            </tr>
			<tr>
                <td colspan="3"><b>PROC</b></td>
                <td> <b> : {{$header['proc']}}</b>   </td>
                <td></td>
                <td colspan="2"><b>UBIS</b></td>
                <td><b> : {{$header['ubis']}} </b> </td>
            </tr>
			
			<tr>
                <td colspan="3"><b>INFRA TYPE</b></td>
                <td> <b> : {{$header['infratype']}}</b>   </td>
                <td></td>
                <td colspan="2"><b>TOWER PROVIDER</b></td>
                <td><b> : {{$header['towerprovider']}} </b> </td>
            </tr>
			
			
            <tr>
                <td colspan="3"><b>TOWER</b></td>
                <td> <b> : {{$header['tinggitower']}}  </b>  </td>
                <td></td>
                <td colspan="2"><b></b></td>
                <td><b> </b> </td>
            </tr>
            
            
            <tr>
                <td colspan="3"><b>LONGITUDE</b></td>
                <td> <b> : {{$header['longitude']}} </b>  </td>
                <td></td>
                <td colspan="2"><b>LATITUDE</b></td>
                <td><b> : {{$header['latituted']}} </b> </td>
            </tr>
            
			<tr>
                <td colspan="3"><b>SITENAME</b></td>
                <td> <b> : {{$header['sitename']}}</b>   </td>
                <td></td>
                <td colspan="2"><b>SITEID</b></td>
                <td><b>: {{$header['siteid']}}</b> </td>
            </tr>
			
			<tr>
                <td colspan="3"><b>AREA</b></td>
                <td> <b>:  {{$header['area']}}</b>   </td>
                <td></td>
                <td colspan="2"><b>REGIONAL</b></td>
                <td> <b> : {{$header['regional']}} </b>  </td>
            </tr>
			
			<tr>
                <td colspan="3"><b>CLUSTER</b></td>
                <td> <b> : {{$header['cluster']}} </b>  </td>
                <td></td>
                <td colspan="2"><b></b></td>
                <td> <b> </b> </td>
            </tr>
			
			
			
			<tr>
                <td colspan="3"><b>PROVINSI</b></td> 
                <td> <b> :{{$header['provinsi']}} </b>  </td>
                <td><b></td>
                <td colspan="2"><b>KABUPATEN</b></td>
                <td><b> : {{$header['kabupaten']}}</b>  </td>
            </tr>
			
            
            <tr>
                <td colspan="3"><b>MITRA</b></td>
                
                <td> <b>: {{$header['mitra']}} </b>  </td>
                <td></td>
                <td colspan="2"><b> </b></td>
                
                <td> <b>  </b>  </td>
            </tr>
            
            
            
            <tr>
                <td colspan="8"></td>
            </tr>
            <tr>
                <td colspan="8"><div style="height: 15px; overflow:hidden;"></div></td>
            </tr>
            
            
			<tr>
                <td align="center"><b>NO</b></td>
                <td align="center" colspan="3"><b>ITEM PEKERJAAN</b></td>
                <td align="center"><b>SATUAN</b></td>
                <td align="center"> <b> QTY PO </b>  </td>
                <td align="center"> <b>HARGA SATUAN </b></td>
                <td align="center"><b>TOTAL</b></td>
            </tr>
			
            
			<tr>
                <td align="center"><b>1</b></td>
                <td align="left" colspan="3"><b>Pekerjaan Pra-Implementasi</b></td>
                <td align="center"><b></b></td>
                <td align="center"> <b> </b>  </td>
                <td align="center"> <b> </b></td>
                <td align="center"><b></b></td>
            </tr>
			
            
	  <tr>
        <td align="center"><b></b></td>
        <td align="center"><b>1.1</b></td>
        <td align="left" colspan="2"><b>Site Investigation Survey (SIS)</b></td>
        <td align="center">LS</td>
        <td align="center">1</td>
        <td align="right">Rp. {{number_format( $header['sis'], 2 , '.' , ',' )}}</td>
        <td align="right">Rp. {{number_format( $header['sis'], 2 , '.' , ',' )}}</td>
      </tr>
			
	  <tr>
        <td align="center"><b></b></td>
        <td align="center"><b>1.2</b></td>
        <td align="left" colspan="2"><b>Site Acquisition dan Jasa Perolehan lahan</b></td>
        <td align="center">LS</td>
        <td align="center">1</td>
        <td align="right">Rp. {{number_format( $header['sitac'], 2 , '.' , ',' )}}</td>
        <td align="right">Rp. {{number_format( $header['sitac'], 2 , '.' , ',' )}}</td>
      </tr>
			
			
	  <tr>
        <td align="center"><b></b></td>
        <td align="center"><b>1.3</b></td>
        <td align="left" colspan="2"><b>Biaya Retribusi IMB</b></td>
        <td align="center">LS</td>
        <td align="center">1</td>
        <td align="right">Rp. {{number_format( $header['imb'],2 , '.' , ',' )}}</td>
        <td align="right">Rp. {{number_format( $header['imb'], 2 , '.' , ',' )}}</td>
      </tr>
			
	  <tr>
        <td align="center"><b></b></td>
        <td align="center"><b>1.4</b></td>
        <td align="left" colspan="2"><b>Biaya Jasa Pengurusan IMB </b></td>
        <td align="center">LS</td>
        <td align="center">1</td>
        <td align="right">Rp. {{number_format( $header['imb_jasa'],2 , '.' , ',' )}}</td>
        <td align="right">Rp. {{number_format( $header['imb_jasa'], 2 , '.' , ',' )}}</td>
      </tr>
			
	  <tr>
        <td align="left" colspan="8"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>
	  	
            
	  <tr>
        <td align="center"><b>2</b></td>
        <td align="left" colspan="3"><b>Sewa Lahan (Include PPh)</b></td>
        <td align="center">LS</td>
        <td align="center">{{ $header['qty_lahan'] }}</td>
        <td align="right">Rp. {{number_format( $header['lahan'], 2 , '.' , ',' )}}</td>
        <td align="right">Rp. {{number_format( $header['qty_lahan'] * $header['lahan'], 2 , '.' , ',' )}}</td>
      </tr>
			
			
				
	  <tr>
        <td align="left" colspan="8"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>
	  	
      	
			
			
				
	  <tr>
        <td align="left" colspan="8"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>
	  	
      
@if($header['infratype'] == 'UNTAPPED')           
	  <tr>
        <td align="center"><b>3</b></td>
        <td align="left" colspan="3"><b>Tower {{$header['tinggitower']}}</b></td>
        <td align="center">LS</td>
        <td align="center">1</td>
        <td align="right">Rp. {{number_format( $header['biayatower'], 2 , '.' , ',' )}}</td>
        <td align="right">Rp. {{number_format( $header['biayatower'], 2 , '.' , ',' )}}</td>
      </tr>
@else
 <tr>
        <td align="center"><b>3</b></td>
        <td align="left" colspan="3"><b>Tower {{$header['tinggitower']}}</b></td>
        <td align="center">LS</td>
        <td align="center">{{$standard['tonase']}}</td>
        <td align="right">Rp. {{number_format( $standard['biayatower'], 2 , '.' , ',' )}}</td>
        <td align="right">Rp. {{number_format( ($header['biayatower']*$standard['tonase']), 2 , '.' , ',' )}}</td>
      </tr>
@endif	
	<tr>
        <td align="left" colspan="8"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>
	  	
              
	  <tr>
        <td align="center"><b>4</b></td>
        <td align="left" colspan="3"><b>Pekerjaan Implementasi (Standart)</b></td>
        <td align="center"></td>
        <td align="center"></td>
        <td align="right"></td>
        <td align="right"></td>
      </tr>
	  
	  @if($header['infratype'] == 'UNTAPPED')	     
			<tr>
                <td align="center"><b></b></td>
                <td align="center"><b>4.1</b></td>
                <td align="left" colspan="2"><b>CME</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right">Rp. {{number_format($header['cme'], 2 , '.' , ',' )}}</td>
                <td align="right">Rp. {{number_format($header['cme'], 2 , '.' , ',' )}}</td>
            </tr>    
			<tr>
                <td align="center"><b></b></td>
                <td align="center"><b>4.2</b></td>
                <td align="left" colspan="2"><b>PLN Connect</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right">Rp. {{number_format($header['pln'], 2 , '.' , ',' )}}</td>
                <td align="right">Rp. {{number_format($header['pln'], 2 , '.' , ',' )}}</td>
            </tr>
<tr>
        <td align="left" colspan="8"><div style="height: 15px; overflow:hidden;"></div></td>
 </tr>	
<tr>
                <td align="center"><b>5</b></td>
                <td align="left" colspan="3"><b>Pekerjaan non standard</b></td>
                <td align="center"></td>
                <td align="left"> </td>
                <td align="left"></td>
                <td align="left"></td>
</tr> 
<tr>
                <td align="center"><b></b></td>
                <td align="center"><b>5.1</b></td>
                <td align="left" colspan="2"><b>CME</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right">Rp. {{number_format($header['addcme'], 2 , '.' , ',' )}}</td>
                <td align="right">Rp. {{number_format($header['addcme'], 2 , '.' , ',' )}}</td>
</tr> 
<tr>
                <td align="center"><b></b></td>
                <td align="center"><b>5.2</b></td>
                <td align="left" colspan="2"><b>PLN</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right">Rp. {{number_format($header['addpln'], 2 , '.' , ',' )}}</td>
                <td align="right">Rp. {{number_format($header['addpln'], 2 , '.' , ',' )}}</td>
</tr> 
<tr>
                <td align="center"><b></b></td>
                <td align="center"><b>5.3</b></td>
                <td align="left" colspan="2"><b>Transport</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right">Rp. {{number_format($header['addtransport'], 2 , '.' , ',' )}}</td>
                <td align="right">Rp. {{number_format($header['addtransport'], 2 , '.' , ',' )}}</td>
</tr> 
<tr>
        <td align="left" colspan="8"><div style="height: 15px; overflow:hidden;"></div></td>
</tr>
<tr>
        <td align="center" colspan="6"><h4><b>Total Pekerjaan Standard :</b></h4></td>
        <td align="right" colspan="2"><h4><b>Rp. {{number_format(($header['sis']+$header['sitac']+$header['imb']+$header['imb_jasa']+($header['qty_lahan'] * $header['lahan'])+$header['biayatower']+$header['cme']+$header['pln']), 2 , '.' , ',')}}</b></h4></td>
      </tr>

	  <tr>
        <td align="left" colspan="8"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>

	  <tr>
        <td align="center" colspan="6"><h4><b>Total Pekerjaan Non Standard :</b></h4></td>
        <td align="right" colspan="2"><h4><b>Rp. {{number_format(($header['addcme']+$header['addpln']+$header['addtransport']), 2 , '.' , ',')}}</b></h4></td>
      </tr>
	 
	  <tr>
        <td align="left" colspan="8"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>

	  <tr>
        <td align="center" colspan="6"><h4><b>Total CAPEX :</b></h4></td>
        <td align="right" colspan="2"><h4><b>Rp. {{number_format(($header['sis']+$header['sitac']+$header['imb']+$header['imb_jasa']+($header['qty_lahan'] * $header['lahan'])+$header['biayatower']+$header['cme']+$header['pln']+$header['addcme']+$header['addpln']+$header['addtransport']), 2 , '.' , ',')}}</b></h4></td>
      </tr>  
@else	
<tr>
                <td align="center"><b>2</b></td>
                <td align="center"><b>4.1</b></td>
                <td align="left" colspan="2"><b>Erection Tower</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right">Rp. {{number_format($standard['erection_tower'], 2 , '.' , ',' )}}</td>
                <td align="right">Rp. {{number_format($standard['erection_tower'], 2 , '.' , ',' )}}</td>
</tr> 
<tr>
                <td align="center"><b></b></td>
                <td align="center"><b>4.2</b></td>
                <td align="left" colspan="2"><b>Transportasi</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right">Rp. {{number_format($standard['transportasi'], 2 , '.' , ',' )}}</td>
                <td align="right">Rp. {{number_format($standard['transportasi'], 2 , '.' , ',' )}}</td>
</tr> 
<tr>
                <td align="center"><b></b></td>
                <td align="center"><b>4.3</b></td>
                <td align="left" colspan="2"><b>Pondasi Greenfiled</b></td>
                <td align="center">LS</td>
                <td align="center">{{$standard['pondasi_greenfiled']}}</td>
                <td align="right">Rp. {{number_format($standard['pondasi'], 2 , '.' , ',' )}}</td>
                <td align="right">Rp. {{number_format(($standard['pondasi']*$standard['pondasi_greenfiled']), 2 , '.' , ',' )}}</td>
</tr> 
<tr>
                <td align="center"><b></b></td>
                <td align="center"><b>4.4</b></td>
                <td align="left" colspan="2"><b>BTS Outdoor</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right">Rp. {{number_format($standard['bts_outdoor'], 2 , '.' , ',' )}}</td>
                <td align="right">Rp. {{number_format($standard['bts_outdoor'], 2 , '.' , ',' )}}</td>
</tr>  
<tr>
                <td align="center"><b></b></td>
                <td align="center"><b>4.5</b></td>
                <td align="left" colspan="2"><b>ME</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right">Rp. {{number_format($standard['me'], 2 , '.' , ',' )}}</td>
                <td align="right">Rp. {{number_format($standard['me'], 2 , '.' , ',' )}}</td>
</tr>
<tr>
                <td align="center"><b></b></td>
                <td align="center"><b>4.6</b></td>
                <td align="left" colspan="2"><b>F & Y (10mx12m)</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right">Rp. {{number_format($standard['fy'], 2 , '.' , ',' )}}</td>
                <td align="right">Rp. {{number_format($standard['fy'], 2 , '.' , ',' )}}</td>
</tr>
<tr>
                <td align="center"><b></b></td>
                <td align="center"><b>4.7</b></td>
                <td align="left" colspan="2"><b>PLN Connect</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right">Rp. {{number_format($standard['pln_connect'], 2 , '.' , ',' )}}</td>
                <td align="right">Rp. {{number_format($standard['pln_connect'], 2 , '.' , ',' )}}</td>
</tr>  
<tr>
        <td align="left" colspan="8"><div style="height: 15px; overflow:hidden;"></div></td>
</tr>
<tr>
        <td align="center"><b>5</b></td>
        <td align="left" colspan="3"><b>Pekerjaan Non Standard</b></td>
        <td align="center"></td>
        <td align="center"></td>
        <td align="right"></td>
        <td align="right"></td>
      </tr>
@if(count($additional)>0)
@php 
$no=0; 
$total=0; 
$jumlahadd=0; 
@endphp	
			@foreach($additional as $ad)
		<tr>
        <td align="left"><b></b></td>
        <td align="left"><b>5.{{$no+1}}</b></td>
        <td align="left" colspan="2"><b>{{$ad['pekerjaan']}}</b></td>
        <td align="center">{{$ad['satuan']}}</td>
        <td align="center">{{$ad['qty']}}</td>
        <td align="right">Rp. {{number_format($ad['harga'], 2 , '.' , ',' )}}</td>
        <td align="right">Rp. {{number_format(($ad['harga']*$ad['qty']), 2 , '.' , ',' )}}</td>
      </tr>
@php 
$total = $ad['harga']*$ad['qty'];
$jumlahadd += $total;  
@endphp	  
@endforeach	
@else
@php 
$jumlahadd=0; 
@endphp		
@endif	

<tr>
        <td align="left" colspan="8"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>

	  <tr>
        <td align="center" colspan="6"><h4><b>Total Pekerjaan Standard :</b></h4></td>
        <td align="right" colspan="2"><h4><b>Rp. {{number_format(($header['sis']+$header['sitac']+$header['imb']+$header['imb_jasa']+($header['qty_lahan'] * $header['lahan'])+($standard['tonase']*$standard['biayatower'])+$standard['erection_tower']+$standard['transportasi']+($standard['pondasi_greenfiled']*$standard['pondasi'])+$standard['bts_outdoor']+$standard['me']+$standard['fy']+$standard['pln_connect']), 2 , '.' , ',')}}</b></h4></td>
      </tr>

	  <tr>
        <td align="left" colspan="8"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>

	  <tr>
        <td align="center" colspan="6"><h4><b>Total Pekerjaan Non Standard :</b></h4></td>
        <td align="right" colspan="2"><h4><b>Rp. {{number_format($jumlahadd, 2 , '.' , ',')}}</b></h4></td>
      </tr>
<tr>
        <td align="left" colspan="8"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>

	  <tr>
        <td align="center" colspan="6"><h4><b>Total CAPEX :</b></h4></td>
        <td align="right" colspan="2"><h4><b>Rp. {{number_format(($header['sis']+$header['sitac']+$header['imb']+$header['imb_jasa']+($header['qty_lahan'] * $header['lahan'])+($standard['tonase']*$standard['biayatower'])+$standard['erection_tower']+$standard['transportasi']+($standard['pondasi_greenfiled']*$standard['pondasi'])+$standard['bts_outdoor']+$standard['me']+$standard['fy']+$standard['pln_connect']+$jumlahadd), 2 , '.' , ',')}}</b></h4></td>
      </tr>

@endif	
<tr>
                <td colspan="8"></td>
            </tr>
            <tr>
                <td colspan="8"><div style="height: 25px; overflow:hidden;"></div></td>
            </tr>
@if(count($pesan)>0)	
			@foreach($pesan as $ps)			
            <tr>
                <td colspan="8"><b>{{$ps['status'].' By '.$ps['name'].' ('.$ps['level'].')'.' Tanggal '.$ps['created_at'] }}</b></td>
            </tr>
@endforeach				
@endif		
<tr>
                <td colspan="8"><div style="height: 15px; overflow:hidden;"></div></td>
            </tr>
            <tr>
                <td colspan="8"></td>
            </tr>
	@if(count($pesanreject)>0)	
			@foreach($pesanreject as $pr)			
            <tr>
                <td colspan="8"><b>{{$pr['status'].' By '.$pr['name'].' ('.$pr['level'].')'.' Tanggal '.$pr['created_at'] }}</b></td>
            </tr>
@endforeach				
@endif			
        </table>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
    </body>
</html>