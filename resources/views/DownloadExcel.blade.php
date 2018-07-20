<html>
    <body>
    
 <table border="1">
            <tr>
                <th colspan="7" align="center"><h1>BILL OF QUANTITY ACTUAL</h1></th>
            </tr>
            <tr>
                <td colspan="7"><h3><b> PROJECT ID : <?php echo $header['projectid']?></b></h3></td>
            </tr>
             <tr>
                <td colspan="7"><h3><b> DMT : <?php echo $header['no_doc']?></b></h3></td>
            </tr>
            <tr>
                <td colspan="7"></td>
            </tr>
            <tr>
                <td><b>PROC</b></td>
                <td><b>:</b></td>
                <td> <b> <?php echo $header['proc']?></b>   </td>
                <td></td>
                <td><b>UBIS</b></td>
                <td><b>:</b></td>
                <td><b> <?php echo $header['ubis']?> </b> </td>
            </tr>
            
            <tr>
                <td><b>INFRA TYPE</b></td>
                <td><b>:</b></td>
                <td> <b> <?php echo $header['infratype']?></b>   </td>
                <td></td>
                <td><b>TOWER PROVIDER</b></td>
                <td><b>:</b></td>
                <td><b> <?php echo $header['towerprovider']?> </b> </td>
            </tr>
            
            
            <tr>
                <td><b>TOWER</b></td>
                <td><b>:</b></td>
                <td> <b> <?php echo $header['tinggitower']?> </b>  </td>
                <td></td>
                <td><b> </b></td>
                <td><b> </b></td>
                <td><b> </b> </td>
            </tr>
            
            
            <tr>
                <td><b>LONGITUDE</b></td>
                <td><b>:</b></td>
                <td> <b> <?php echo $header['longitude']?> </b>  </td>
                <td></td>
                <td><b>LATITUDE</b></td>
                <td><b>:</b></td>
                <td><b> <?php echo $header['latituted']?> </b> </td>
            </tr>
            
            <tr>
                <td><b>SITENAME</b></td>
                <td><b>:</b></td>
                <td> <b> <?php echo $header['sitename']?></b>   </td>
                <td></td>
                <td><b>SITEID</b></td>
                <td><b>:</b></td>
                <td><b><?php echo $header['siteid']?></b> </td>
            </tr>
            
            <tr>
                <td><b>AREA</b></td>
                <td><b>:</b></td>
                <td> <b> <?php echo $header['area']?></b>   </td>
                <td></td>
                <td><b>REGIONAL</b></td>
                <td><b>:</b></td>
                <td> <b> <?php echo $header['regional']?> </b>  </td>
            </tr>
            
            <tr>
                <td><b>CLUSTER</b></td>
                <td><b>:</b></td>
                <td> <b> <?php echo $header['cluster']?> </b>  </td>
                <td></td>
                <td><b> </b></td>
                <td><b></b></td>
                <td><b> </b> </td>
            </tr>
            
            
            
            <tr>
                <td><b>PROVINSI</b></td>
                <td><b>:</b></td>
                <td> <b> <?php echo $header['provinsi']?> </b>  </td>
                <td><b></td>
                <td><b>KABUPATEN</b></td>
                <td><b>:</td>
                <td><b> <?php echo $header['kabupaten']?></b>  </td>
            </tr>
                 
            
            
            <tr>
                <td><b>MITRA</b></td>
                <td><b>:</b></td>
                <td> <b> <?php echo $header['mitra']?> </b>  </td>
                <td></td>
                <td><b> </b></td>
                <td><b> </b></td>
                <td><b> </b>  </td>
            </tr>
            
            
            
            <tr>
                <td colspan="7"></td>
            </tr>
            <tr>
                <td colspan="7"></td>
            </tr>
            
            
            <tr>
                <td align="center"><b>NO</b></td>
                <td align="center" colspan="2"><b>ITEM PEKERJAAN</b></td>
                <td align="center"><b>SATUAN</b></td>
                <td align="center"> <b> QTY PO </b>  </td>
                <td align="center"> <b>HARGA SATUAN </b></td>
                <td align="center"><b>TOTAL</b></td>
            </tr>
            
            
            <tr>
                <td align="center"><b>1</b></td>
                <td align="left" colspan="2"><b>Pekerjaan Pra-Implementasi</b></td>
                <td align="center"><b></b></td>
                <td align="center"> <b> </b>  </td>
                <td align="center"> <b> </b></td>
                <td align="center"><b></b></td>
            </tr>
            
            
      <tr>
        <td align="center"><b> </b></td>
        <td align="center"><b>1.1</b></td>
        <td align="left"><b>Site Investigation Survey (SIS)</b></td>
        <td align="center">LS</td>
        <td align="center">1</td>
        <td align="right"><?php echo number_format( $header['sis'], 2 , '.' , '' )?></td>
        <td align="right"><?php echo number_format( $header['sis'], 2 , '.' , '' )?></td>
      </tr>
            
      <tr>
        <td align="center"><b> </b></td>
        <td align="center"><b>1.2</b></td>
        <td align="left"><b>Site Acquisition dan Jasa Perolehan lahan</b></td>
        <td align="center">LS</td>
        <td align="center">1</td>
        <td align="right"><?php echo number_format( $header['sitac'], 2 , '.' , '' )?></td>
        <td align="right"><?php echo number_format( $header['sitac'], 2 , '.' , '' )?></td>
      </tr>
            
            
      <tr>
        <td align="center"><b> </b></td>
        <td align="center"><b>1.3</b></td>
        <td align="left"><b>Biaya Retribusi IMB</b></td>
        <td align="center">LS</td>
        <td align="center">1</td>
        <td align="right"><?php echo number_format( $header['imb'],2 , '.' , '' )?></td>
        <td align="right"><?php echo number_format( $header['imb'], 2 , '.' , '' )?></td>
      </tr>
	  
	  
      <tr>
        <td align="center"><b> </b></td>
        <td align="center"><b>1.4</b></td>
        <td align="left"><b>Biaya Retribusi IMB</b></td>
        <td align="center">LS</td>
        <td align="center">1</td>
        <td align="right"><?php echo number_format( $header['imb_jasa'],2 , '.' , '' )?></td>
        <td align="right"><?php echo number_format( $header['imb_jasa'], 2 , '.' , '' )?></td>
      </tr>
	  
	  
            
      <tr>
        <td align="left" colspan="7"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>
        
            
      <tr>
        <td align="center"><b>2</b></td>
        <td align="left" colspan="2"><b>Sewa Lahan (Include PPh)</b></td>
        <td align="center">LS</td>
        <td align="center"><?php echo $header['qty_lahan']?></td>
        <td align="right"><?php echo number_format( $header['lahan'], 2 , '.' , '' )?></td>
        <td align="right"><?php echo number_format( $header['qty_lahan'] * $header['lahan'], 2 , '.' , '' )?></td>
      </tr>
            
            
                
      <tr>
        <td align="left" colspan="7"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>
        
@if($header['infratype'] == 'UNTAPPED')           
      <tr>
        <td align="center"><b>3</b></td>
        <td align="left" colspan="2"><b>Tower <?php echo $header['tinggitower']?> M</b></td>
        <td align="center">LS</td>
        <td align="center">1</td>
        <td align="right"><?php echo number_format( $header['biayatower'], 2 , '.' , '' )?></td>
        <td align="right"><?php echo number_format( $header['biayatower'], 2 , '.' , '' )?></td>
      </tr>
@else
<?php
$biayatower = $standard['biayatower'];
$tonase = $standard['tonase'];
?>
 <tr>
        <td align="center"><b>3</b></td>
        <td align="left" colspan="2"><b>Tower <?php echo $header['tinggitower']?></b></td>
        <td align="center">LS</td>
        <td align="center"><?php echo $standard['tonase']?></td>
        <td align="right"><?php echo number_format( $standard['biayatower'], 2 , '.' , '' )?></td>
        <td align="right"><?php echo number_format( ($biayatower*$tonase), 2 , '.' , '' )?></td>
      </tr>
@endif  
            
            
                
      <tr>
        <td align="left" colspan="7"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>
        
              
      <tr>
        <td align="center"><b>4</b></td>
        <td align="left" colspan="2"><b>Pekerjaan Implementasi (Standard)</b></td>
        <td align="center"></td>
        <td align="center"></td>
        <td align="right"></td>
        <td align="right"></td>
      </tr>
@if($header['infratype'] == 'UNTAPPED')      
            <tr>
                <td align="center"><b> </b></td>
                <td align="center"><b>4.1</b></td>
                <td align="left"><b>CME</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right"><?php echo number_format($header['cme'], 2 , '.' , '' )?></td>
                <td align="right"><?php echo number_format($header['cme'], 2 , '.' , '' )?></td>
            </tr>    
            <tr>
                <td align="center"><b> </b></td>
                <td align="center"><b>4.2</b></td>
                <td align="left"><b>PLN Connect</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right"><?php echo number_format($header['pln'], 2 , '.' , '' )?></td>
                <td align="right"><?php echo number_format($header['pln'], 2 , '.' , '' )?></td>
            </tr>
<tr>
        <td align="left" colspan="7"><div style="height: 15px; overflow:hidden;"></div></td>
 </tr>  
<tr>
                <td align="center"><b>5</b></td>
                <td align="left" colspan="2"><b>Pekerjaan non standard</b></td>
                <td align="center"></td>
                <td align="left"> </td>
                <td align="left"></td>
                <td align="left"></td>
</tr> 
<tr>
                <td align="center"><b> </b></td>
                <td align="center"><b>5.1</b></td>
                <td align="left"><b>CME</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right"><?php echo number_format($header['addcme'], 2 , '.' , '' )?></td>
                <td align="right"><?php echo number_format($header['addcme'], 2 , '.' , '' )?></td>
</tr> 
<tr>
                <td align="center"><b> </b></td>
                <td align="center"><b>5.2</b></td>
                <td align="left"><b>PLN</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right"><?php echo number_format($header['addpln'], 2 , '.' , '' )?></td>
                <td align="right"><?php echo number_format($header['addpln'], 2 , '.' , '' )?></td>
</tr> 
<tr>
                <td align="center"><b> </b></td>
                <td align="center"><b>5.3</b></td>
                <td align="left"><b>Transport</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right"><?php echo number_format($header['addtransport'], 2 , '.' , '' )?></td>
                <td align="right"><?php echo number_format($header['addtransport'], 2 , '.' , '' )?></td>
</tr> 
<tr>
        <td align="left" colspan="7"><div style="height: 15px; overflow:hidden;"></div></td>
</tr>
<tr>
        <td colspan="5"><h4 align="center"><b>Total Pekerjaan Standard:</b></h4></td>
        <td colspan="2"><h4 align="right"><b><?php echo number_format(($header['sis']+$header['sitac']+$header['imb']+$header['imb_jasa']+($header['qty_lahan'] * $header['lahan'])+$header['biayatower']+$header['cme']+$header['pln']), 2 , '.' , '')?></b></h4></td>
      </tr>

      <tr>
        <td align="left" colspan="7"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>

      <tr>
        <td colspan="5"><h4 align="center"><b>Total Pekerjaan Non Standard :</b></h4></td>
        <td colspan="2"><h4 align="right"><b><?php echo number_format(($header['addcme']+$header['addpln']+$header['addtransport']), 2 , '.' , '')?></b></h4></td>
      </tr>
     
      <tr>
        <td align="left" colspan="7"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>

      <tr>
        <td colspan="5"><h4 align="center"><b>Total CAPEX :</b></h4></td>
        <td colspan="2"><h4 align="right"><b><?php echo number_format(($header['sis']+$header['sitac']+$header['imb']+$header['imb_jasa']+($header['qty_lahan'] * $header['lahan'])+$header['biayatower']+$header['cme']+$header['pln']+$header['addcme']+$header['addpln']+$header['addtransport']), 2 , '.' , '')?></b></h4></td>
      </tr>  
@else   
<tr>
                <td align="center"><b> </b></td>
                <td align="center"><b>4.1</b></td>
                <td align="left"><b>Erection Tower</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right"><?php echo number_format($standard['erection_tower'], 2 , '.' , '' )?></td>
                <td align="right"><?php echo number_format($standard['erection_tower'], 2 , '.' , '' )?></td>
</tr> 
<tr>
                <td align="center"><b> </b></td>
                <td align="center"><b>4.2</b></td>
                <td align="left"><b>Transportasi</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right"><?php echo number_format($standard['transportasi'], 2 , '.' , '' )?></td>
                <td align="right"><?php echo number_format($standard['transportasi'], 2 , '.' , '' )?></td>
</tr> 
<tr>
                <td align="center"><b> </b></td>
                <td align="center"><b>4.3</b></td>
                <td align="left"><b>Pondasi Greenfiled</b></td>
                <td align="center">LS</td>
                <td align="center"><?php echo $standard['pondasi_greenfiled']?></td>
                <td align="right"><?php echo number_format($standard['pondasi'], 2 , '.' , '' )?></td>
                <td align="right"><?php echo number_format(($standard['pondasi']*$standard['pondasi_greenfiled']), 2 , '.' , '' )?></td>
</tr> 
<tr>
                <td align="center"><b> </b></td>
                <td align="center"><b>4.4</b></td>
                <td align="left"><b>BTS Outdoor</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right"><?php echo number_format($standard['bts_outdoor'], 2 , '.' , '' )?></td>
                <td align="right"><?php echo number_format($standard['bts_outdoor'], 2 , '.' , '' )?></td>
</tr>  
<tr>
                <td align="center"><b> </b></td>
                <td align="center"><b>4.5</b></td>
                <td align="left"><b>ME</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right"><?php echo number_format($standard['me'], 2 , '.' , '' )?></td>
                <td align="right"><?php echo number_format($standard['me'], 2 , '.' , '' )?></td>
</tr>
<tr>
                <td align="center"><b> </b></td>
                <td align="center"><b>4.6</b></td>
                <td align="left"><b>F & Y (10mx12m)</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right"><?php echo number_format($standard['fy'], 2 , '.' , '' )?></td>
                <td align="right"><?php echo number_format($standard['fy'], 2 , '.' , '' )?></td>
</tr>
<tr>
                <td align="center"><b> </b></td>
                <td align="center"><b>4.7</b></td>
                <td align="left"><b>PLN Connect</b></td>
                <td align="center">LS</td>
                <td align="center">1</td>
                <td align="right"><?php echo number_format($standard['pln_connect'], 2 , '.' , '' )?></td>
                <td align="right"><?php echo number_format($standard['pln_connect'], 2 , '.' , '' )?></td>
</tr>  
<tr>
        <td align="left" colspan="7"><div style="height: 15px; overflow:hidden;"></div></td>
</tr>
<tr>
        <td align="center"><b>5</b></td>
        <td align="left" colspan="2"><b>Pekerjaan Non Standard <button type="button" class="button btn-primary" @click="addRow">+ Biaya</button></b></td>
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
        <td align="left"><b> </b></td>
        <td align="left"><b>5.<?php echo $no+1?></b></td>
        <td align="left"><b><?php echo $ad['pekerjaan']?></b></td>
        <td align="center"><?php echo $ad['satuan']?></td>
        <td align="center"><?php echo $ad['qty']?></td>
        <td align="right"><?php echo number_format($ad['harga'], 2 , '.' , '' )?></td>
        <td align="right"><?php echo number_format(($ad['harga']*$ad['qty']), 2 , '.' , '' )?></td>
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
        <td align="left" colspan="7"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>

      <tr>
        <td colspan="5"><h4 align="center"><b>Total Pekerjaan Standard :</b></h4></td>
        <td colspan="2"><h4 align="right"><b><?php echo number_format(($header['sis']+$header['sitac']+$header['imb']+$header['imb_jasa']+($header['qty_lahan'] * $header['lahan'])+($standard['tonase']*$standard['biayatower'])+$standard['erection_tower']+$standard['transportasi']+($standard['pondasi_greenfiled']*$standard['pondasi'])+$standard['bts_outdoor']+$standard['me']+$standard['fy']+$standard['pln_connect']), 2 , '.' , '')?></b></h4></td>
      </tr>

      <tr>
        <td align="left" colspan="7"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>

      <tr>
        <td colspan="5"><h4 align="center"><b>Total Pekerjaan Non Standard :</b></h4></td>
        <td colspan="2"><h4 align="right"><b><?php echo number_format($jumlahadd, 2 , '.' , '')?></b></h4></td>
      </tr>
<tr>
        <td align="left" colspan="7"><div style="height: 15px; overflow:hidden;"></div></td>
      </tr>

      <tr>
        <td colspan="5"><h4 align="center"><b>Total CAPEX :</b></h4></td>
        <td colspan="2"><h4 align="right"><b><?php echo number_format(($header['sis']+$header['sitac']+$header['imb']+$header['imb_jasa']+($header['qty_lahan'] * $header['lahan'])+($standard['tonase']*$standard['biayatower'])+$standard['erection_tower']+$standard['transportasi']+($standard['pondasi_greenfiled']*$standard['pondasi'])+$standard['bts_outdoor']+$standard['me']+$standard['fy']+$standard['pln_connect']+$jumlahadd), 2 , '.' , '')?></b></h4></td>
      </tr>

@endif  
      
        
<tr>
                <td colspan="7"></td>
            </tr>
            <tr>
                <td colspan="7"></td>
            </tr>
@if(count($pesan)>0)    
            @foreach($pesan as $ps)         
            <tr>
                <td colspan="7"><b><?php echo $ps['status'].' By '.$ps['name'].' ('.$ps['level'].')'.' Tanggal '.$ps['created_at'] ?></b></td>
            </tr>
@endforeach             
@endif      
<tr>
                <td colspan="7"></td>
            </tr>
            <tr>
                <td colspan="7"></td>
            </tr>
    @if(count($pesanreject)>0)  
            @foreach($pesanreject as $pr)           
            <tr>
                <td colspan="7"><b><?php echo $pr['status'].' By '.$pr['name'].' ('.$pr['level'].')'.' Tanggal '.$pr['created_at'] ?></b></td>
            </tr>
@endforeach             
@endif          
        </table>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    </body>
</html>