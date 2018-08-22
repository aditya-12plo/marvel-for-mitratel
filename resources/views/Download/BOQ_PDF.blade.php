<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
.page-break {
    page-break-after: always;
}
</style>
 <body style="padding:0;font-size: 10px;">
	


<h3><b> {{$header['title']}} 
<br>
PT. Dayamitrata Telkomsel
<br>
{{$header['boq_code']}}
</b></h3>



 <table border="1" style="padding:0;border-collapse: collapse;border: 1px solid black;"> 
<tr>
    <td rowspan="3" align="center"><b>no</b></td>
    <td rowspan="3" align="center"><b>Area</b></td>
    <td rowspan="3" align="center"><b>Regional</b></td>
    <td rowspan="3" align="center"><b>TP Site ID</b></td>
    <td rowspan="3" align="center"><b>TP Site Name</b></td>
    <td rowspan="3" align="center"><b>Telkomsel Site ID</b></td>
    <td rowspan="3" align="center"><b>Telkomsel Site Name</b></td>
    <td colspan="2" align="center"><b>Coordinate</b></td>
    <td colspan="5" align="center"><b>Planned Infrastructure</b></td>
    <td colspan="2" align="center"><p><b>Antenna Height</b></p>
    <p><b>Reuirement</b></p></td>
    <td rowspan="3" align="center"><b>Address</b></td>
    <td rowspan="3" align="center"><b>City</b></td>
    <td rowspan="3" align="center"><b>Province</b></td>
    <td rowspan="3" align="center"><b>Target RFI (after PO release/Days)</b></td>
    <td rowspan="3" align="center"><b>Power Supply Type</b></td>
    <td rowspan="3" align="center"><b>*Harga Sewa / Bulan (IDR)</b></td>
    <td rowspan="3" align="center"><b>*Harga Sewa / tahun (IDR)</b></td>
  </tr>
  <tr>
    <td rowspan="2" align="center"><b>Longitude</b></td>
    <td rowspan="2" align="center"><b>Latitude</b></td>
    <td rowspan="2" align="center"><p><b>Site Type</b></p>
    <p><b>(GF/RT)</b></p></td>
    <td rowspan="2" align="center"><p><b>Tower Type</b></p>
   <p><b> (SST 4L,</b></p>
    <p><b>  SST 3L,</b> </p>
    <p><b> Pole)</b></p></td>
    <td colspan="3" align="center"><b>Infrastructure Height (In meters)</b></td>
    <td rowspan="2" align="center"><b>RF (In meters)</b></td>
    <td rowspan="2" align="center" align="center"><b>MW (In meters)</b></td>
  </tr>
  <tr>
    <td align="center"><b>Roof Top Height (a)</b></td>
    <td align="center"><b>Tower Height(b)</b></td>
    <td align="center"><b>Total Height (a+b)</b></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

<!-- loop here -->
@php
$no=1;
$jml=0;
@endphp
@foreach ($detailproject as $b) 
  <tr>
    <td align="center">{{$no}}</td>
    <td>Area {{$b['area']}}</td>
    <td>{{$b['regional']}}</td>
    <td align="center">{{$b['projectid']}}</td>
    <td>{{$b['site_name_spk']}}</td>
    <td align="center">{{$b['site_id_actual']}}</td>
    <td>{{$b['site_name_actual']}}</td>
    <td align="center">{{$b['longitude_actual']}}</td>
    <td align="center">{{$b['latitude_actual']}}</td>
    <td align="center">{{$b['site_type']}}</td>
    <td align="center">{{$b['tower_type']}}</td>
    <td align="center">{{$b['roof_top_high']}}</td>
    <td align="center">{{$b['tower_high']}}</td>
    <td align="center">{{$b['tower_high'] + $b['roof_top_high']}}</td>
    <td align="center">{{$b['rf_in_meters']}}</td>
    <td align="center">{{$b['mw_in_meters']}}</td>
    <td>{{$b['address_actual']}}</td>
    <td>{{$b['city']}}</td>
    <td>{{$b['province']}}</td>
    <td>PO Release + {{$b['target_rfi']}} days</td>
    <td>PLN {{$b['power_capacity']}} KVA</td>
    <td align="right">{{number_format($b['harga_bulan'], 0 , '.' , ',')}}</td>
    <td align="right">{{number_format($b['harga_tahun'], 0 , '.' , ',')}}</td>
  </tr>
 @php 
 $no++; 
 $jml = $b['harga_tahun'] + $jml; 
 @endphp 
@endforeach 
<!-- loop here -->

  <tr> 
    <td colspan="21"> </td>
    <td align="center"><b>Grand Total</b></td>
    <td align="right"><b>{{number_format($jml, 0 , '.' , ',')}}</b></td>
  </tr>
			 	
        </table>
		
<p><b>*) Harga di luar biaya listrik</b></p>
<br>
<br>

 <table border="0" width="100%"> 
<tr>
<td width="20%"> </td>
<td><b>PT. TELKOMSEL</b></td>
<td colspan="1"><b>PT. Dayamitra Telekomunikasi</b></td> 
</tr>
<tr>
<td colspan="4" height="10%"> </td> 
</tr>
<tr>
<td width="20%"> </td>
<td><u><b>{{$header['nama_telkomsel']}}</b></u><br><b>{{$header['posisi_telkomsel']}}</b></td>
<td><u><b>{{$header['nama_manager']}}</b></u><br><b>{{$header['posisi_manager']}}</b></td>
<td><u><b>{{$header['nama_user']}}</b></u><br><b>{{$header['posisi_user']}}</b></td>
</tr>
</table>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
    </body>
</html>