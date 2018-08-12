<template>
 <div> 
  <loading :show="isLoading"></loading>
<form method="POST" class="form" enctype="multipart/form-data" action="" @submit.prevent="submitData()"> 
<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header" align="center">Edit BOQ Project ID {{this.rowDatanya.project.projectid}}</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
<button type="button" class="btn btn-raised btn-warning" @click="backLink()"> <i class="ft-arrow-left position-left"></i> Kembali</button>
<button type="submit" class="btn btn-raised btn-primary">
  <i class="fa fa-check-square-o"></i> Save
</button> 
<button type="button" @click="drop()" class="btn btn-raised btn-danger">
    <i class="ft-trash-2"></i> Drop
</button>
                </div>
                <div class="card-body">
                    <div class="px-3">
              <div class="form-body">
                            <div class="row">  



<!-- Ducument BOQ --> 
<div class="col-xl-12 col-lg-12 col-md-12 mb-1">
<fieldset class="form-group">
<label for="documentsis"><h4>DOKUMEN RFC</h4></label>
</fieldset>
</div>                              
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_type">TIPE SITE</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'site_type')" class="form-control" placeholder="TIPE SITE" v-model="forms.site_type" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_type']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tower_type">TIPE TOWER</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'tower_type')" class="form-control" placeholder="TIPE SITE" v-model="forms.tower_type" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['tower_type']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="roof_top_high">ROOF TOP HIGHT</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'roof_top_high')" class="form-control" placeholder="ROOF TOP HIGHT" v-model="forms.roof_top_high">
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['roof_top_high']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tower_high">TINGGI TOWER</label>
                                        <br>
<money v-model="forms.tower_high" class="form-control border-input" placeholder="Tinggi Tower" v-bind="tower"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['tower_high']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
 
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rf_in_meters">RF IN METERS</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'rf_in_meters')" class="form-control" placeholder="RF IN METERS" v-model="forms.rf_in_meters" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['rf_in_meters']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="mw_in_meters">MW IN METERS</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'mw_in_meters')" class="form-control" placeholder="MW IN METERS" v-model="forms.mw_in_meters" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['mw_in_meters']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
 
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="harga_bulan">Harga Sewa / Bulan</label>
                                        <br>
<money v-model="forms.harga_bulan" class="form-control border-input" placeholder="Harga Sewa / Bulan" v-bind="duit"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['harga_bulan']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="harga_tahun">Harga Sewa / Tahun</label>
                                        <br>
<money v-model="forms.harga_tahun" class="form-control border-input" placeholder="Harga Sewa / Tahun" v-bind="duit"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['harga_tahun']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_spk">KOMUNIKASI PROJECT</label>
                                        <br>
                                        
<div v-if="this.komunikasi.length > 0">
<button type="button" class="btn btn-raised btn-success" @click="modal.set('komunikasiproject', true)">
  <i class="ft-message-square"></i> Lihat Komunikasi
</button>
</div>

  

                                    </fieldset>
                                </div>
<!-- Ducument BOQ -->

 

<!-- Project -->
                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="projectid"><h4>PROJECT DETAIL</h4></label>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="projectid">PROJECT ID</label>
                                        <br>
{{this.rowDatanya.project.projectid}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_wo">NO WO</label>
                                        <br>
{{this.rowDatanya.project.no_wo}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="wo_date">WO DATE</label>
                                        <br>
{{this.rowDatanya.project.wo_date}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="batch">BATCH</label>
                                        <br>
{{this.rowDatanya.project.batchnya}} 
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="infratype">INFRATYPE</label>
                                        <br>
{{this.rowDatanya.project.infratype}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="area">AREA</label>
                                        <br>
{{this.rowDatanya.project.area}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="regional">REGIONAL</label>
                                        <br>
{{this.rowDatanya.project.regional}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_id_spk">SITE ID SPK</label>
                                        <br>
{{this.rowDatanya.project.site_id_spk}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_name_spk">SITE NAME SPK</label>
                                        <br>
{{this.rowDatanya.project.site_name_spk}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_spk">ALAMAT SPK</label>
                                        <br>
{{this.rowDatanya.project.address_spk}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_spk">KOORDINAT SPK</label>
                                        <br>
Longitude : {{this.rowDatanya.project.longitude_spk}}
<br>
Latitude : {{this.rowDatanya.project.latitude_spk}}
<br>
<a :href="'http://www.google.com/maps/place/'+this.rowDatanya.project.latitude_spk+','+this.rowDatanya.project.longitude_spk" target="_blank"><button type="button" class="btn btn-raised btn-success">
  <i class="ft-navigation"></i> Maps
</button></a>
                                    </fieldset>
                                </div>


<!-- Project -->

<!-- Ducument SIS -->
                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="documentsis"><h4>DOKUMEN SIS</h4></label><br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_sis" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>
                                    </fieldset>
                                </div>
<!-- Ducument SIS -->


<!-- Ducument DRM -->

                                    <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="documentsis"><h4>Dokumen DRM</h4></label> 

                                        </fieldset>
                                    </div>
                                    

<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_id_actual">AKTUAL SITE ID</label>
 <br>
{{this.rowDatanya.project.site_id_actual}}
                                    </fieldset>
                                </div>

  <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_name_actual">AKTUAL SITE NAME</label>
                                        <br>
{{this.rowDatanya.project.site_name_actual}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="province">PROVINSI</label>
                                        <br>
{{this.rowDatanya.project.province}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="city">KOTA</label>
                                        <br>
{{this.rowDatanya.project.city}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_actual">ALAMAT</label>
                                        <br>
{{this.rowDatanya.project.address_actual}}
                                    </fieldset>
                                </div>
                               

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_spk">KOORDINAT AKTUAL</label>
                                        <br>
Longitude : {{this.rowDatanya.project.longitude_actual}}
<br>
Latitude : {{this.rowDatanya.project.latitude_actual}}
<br>
<a :href="'http://www.google.com/maps/place/'+this.rowDatanya.project.latitude_actual+','+this.rowDatanya.project.longitude_actual" target="_blank"><button type="button" class="btn btn-raised btn-success">
  <i class="ft-navigation"></i> Maps
</button></a>
                                    </fieldset>
                                </div>



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="kom_date">TANGGAL KOM</label>
                                        <br>
{{this.rowDatanya.project.kom_date}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_kom">DOKUMEN KOM</label>
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_kom" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>
 
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="drm_date">TANGGAL DRM</label>
                                        <br>
{{this.rowDatanya.project.drm_date}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_drm">DOKUMEN DRM</label>
                                        <br> 
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_drm" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>                                        
                                    </fieldset>
                                </div>
<!-- Ducument DRM -->



<!-- Ducument SITAC --> 
<div class="col-xl-12 col-lg-12 col-md-12 mb-1">
<fieldset class="form-group">
<label for="documentsis"><h4>DOKUMEN SITAC</h4></label>
</fieldset>
</div>                              
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_ban_bak">NO BAN / BAK</label>
                                        <br>
{{this.rowDatanya.project.no_ban_bak}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="date_ban_bak">TANGGAL DOKUMEN BAN / BAK</label>
                                        <br>
{{this.rowDatanya.project.date_ban_bak}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_ban_bak">DOKUMEN BAN / BAK</label>
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_ban_bak" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="ijin_warga_date">TANGGAL DOKUMEN IJIN WARGA</label>
                                        <br>
{{this.rowDatanya.project.ijin_warga_date}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_ijin_warga">DOKUMEN IJIN WARGA</label>
                                        <br> 
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_ijin_warga" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                </div>
   
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_pks">NO PKS</label>
                                        <br>
{{this.rowDatanya.project.no_pks}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="pks_date">TANGGAL DOKUMEN PKS</label>
                                        <br>
{{this.rowDatanya.project.pks_date}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_pks">DOKUMEN PKS</label>
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_pks" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                </div>

 
 
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_imb">NO IMB</label>
                                        <br>
{{this.rowDatanya.project.no_imb}}
                                    </fieldset>
                                </div>
 

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
<label for="imb_date">TANGGAL IMB</label>
                                        <br>
{{this.rowDatanya.project.imb_date}}
                                    </fieldset>
                                </div>

    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_imb">DOKUMEN IMB</label>
                                        <br> 
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_imb" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                </div>
 
<!-- Ducument SITAC -->

<!-- Ducument RFC --> 
<div class="col-xl-12 col-lg-12 col-md-12 mb-1">
<fieldset class="form-group">
<label for="documentsis"><h4>DOKUMEN RFC</h4></label>
</fieldset>
</div>                              
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_rfc">NO DOKUMEN RFC</label>
                                        <br>
{{this.rowDatanya.project.no_rfc}}
</fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rfc_date">TANGGAL DOKUMEN RFC</label>
                                        <br>
{{this.rowDatanya.project.rfc_date}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_rfc">DOKUMEN RFC</label>
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_rfc" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
           <label for="target_rfi">TARGET RFI</label>
                                        <br>
 PO Release + <b>{{this.rowDatanya.project.target_rfi}}</b>  Days                           
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
         <label for="power_capacity">POWER CAPACITY</label>
                                        <br> 
 PLN <b>{{this.rowDatanya.project.power_capacity}}</b> KVA 
                                    </fieldset>
                                </div>
       
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
         <label for="id_pln">ID PLN</label>
                                        <br> 
 {{this.rowDatanya.project.id_pln}}
                                    </fieldset>
                                </div>
        
<!-- Ducument RFC -->
                 


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
            </form>
<!-- Basic Inputs end -->
 

<!-- @drop -->
        <modal  v-if="modal.get('drop')" @close="modal.set('drop', false)">
        <template slot="header" align="center"><h4 align="center">Kirim Komunikasi Project</h4></template>
        <template slot="body" >

            <form method="POST" action="" @submit.prevent="dropData()">
                <div class="modal-body">
                
<div class="col-sm-12" v-if="this.komunikasi.length > 0">             
<div v-for="(row,index) in this.komunikasi" style="border: 1px solid grey;">              
                    <!-- form Group -->
                    <div class="form-group">
                        <label for="pengirim">Pengirim : {{row.name}}</label><br>
                        <label for="jabatan">Posisi : {{row.posisi}}</label><br>
                        <label for="stts">Status : {{row.status}}</label><br>
                        <label for="pesan">Pesan : {{row.message}}</label><br>
                        <label for="time">Waktu : {{row.created_at}}</label><br>
                    </div>
</div>
</div>
<div class="col-sm-12" v-else>
 <!-- form Group -->
                    <div class="form-group">
                        <label for="pengirim">Belum Ada Komunikasi Project</label><br>
                    </div>
</div>

                   <div class="form-group">
  <label for="message">Pesan:</label>
  <textarea v-model="message" class="form-control" rows="5" id="message" placeholder="Pesan" required></textarea>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya"><span style="color:red;">{{ error }}</span></li></ul></div>
  </div>

                

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('drop', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </template>
        </modal>



 

<!-- @komunikasiproject -->
<modal  v-if="modal.get('komunikasiproject')" @close="modal.set('komunikasiproject', false)">
        <template slot="header" align="center"><h4 align="center">Komunikasi Project</h4></template>
        <template slot="body" >
                <div class="modal-body">

<div class="col-sm-12" v-if="this.komunikasi.length > 0">             
<div v-for="(row,index) in this.komunikasi" style="border: 1px solid grey;">              
                    <!-- form Group -->
                    <div class="form-group">
                        <label for="pengirim">Pengirim : {{row.name}}</label><br>
                        <label for="jabatan">Posisi : {{row.posisi}}</label><br>
                        <label for="stts">Status : {{row.status}}</label><br>
                        <label for="pesan">Pesan : {{row.message}}</label><br>
                        <label for="time">Waktu : {{row.created_at}}</label><br>
                    </div>
</div>
</div>
<div class="col-sm-12" v-else>
 <!-- form Group -->
                    <div class="form-group">
                        <label for="pengirim">Belum Ada Komunikasi Project</label><br>
                    </div>
</div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('komunikasiproject', false)" >Close</button>
                    
                </div>
                </form>
        </template>
        </modal>
        
<!-- komunikasiproject -->
 </div> 
</template>



<script>
 class Errors{
            constructor(){
                this.errors = {};
            }
            get(field){
                if(this.errors[field]){
                    return  this.errors[field][0];
                }
            }
            record(errors){
                this.errors = errors.response.data;
            }
            any(){
                return Object.keys(this.errors).length > 0;
            }
            has(field){
                return this.errors.hasOwnProperty(field);
            }
            clear(field){
                if(field) delete this.errors[field];
                this.errors = {};
            }
            clearAll(){
                this.errors = "";
            }
        }

        class CrudForm {
            constructor(data) {
                this.originalData = data;
                for(let field in data){
                    this[field] = data[field];
                }
            }
            reset(){
                for(let field in this.originalData){
                    this[field] = '';
                }
            }
            /*  Set a value to the temp , verify if has this item and update  */
            setFillItem(item , index){
                for(let field in this.originalData){
                    if(field in item){
                        this[field] = item[field];
                    }else{
                        // if is index
                        if(field == 'index'){ this[field] = index; }
                    }
                }
            }
            data(){
                let data = Object.assign({} , this);
                delete data.originalData;
                delete data.errors;
                return data;
            }
        }



         /* ------------------------------------------------------------------------------------- CRUD MODAL
         ---------------------------------------------------------------------------------------------------- */
        class CrudModal{
            constructor(data){
                this.modal = data;
            }
            get(value){
                if(this.modal[value]){
                    return this.modal[value];
                }
            }
            set(data , value){
                this.modal[data] = value;
            }
        }


        //   COMPONENT MODAL
        const Modal = {
            template: `   <transition name="modal">
                                <div class="modal">
                                <div class="modal-mask">
                                  <div class="modal-wrapper">
                                    <div :class="modalStyle">
                                    <a class="close-modal" @click="$emit('close')" ></a>
                                      <div class="modal-header">
                                           <p class="modal-card-title"><slot name="header" class="modal-card-title "></slot></p>
                                      </div>
                                        <slot name="body">
                                          default body
                                        </slot>
                                    </div>
                                  </div>
                                </div>
                                </div>
                              </transition>` ,
            props: {
                modalsize: {type: String},
            } ,
            computed: {
                modalStyle() {
                    return this.modalsize == null ? 'modal-container' : this.modalsize + ' modal-container';
                },
                created(){

                }
            }
        };        

import accounting from 'accounting'
import moment from 'moment'
import '!!vue-style-loader!css-loader!vue-toast/dist/vue-toast.min.css'
import VueToast from 'vue-toast'
import myDatepicker from 'vue-datepicker'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import Vue from 'vue'
import {Money} from 'v-money'
import loading from '../Loading'
import VueEvents from 'vue-events' 
Vue.use(VueEvents)
Vue.component('custom-actions', require('../Button/BooksCustomActions.vue'))
window.axios = require('axios')
window.eventBus = new Vue()

export default {
        props: {
      rowDatanya: {
        type: Object,
        required: true
      },
      typenya: {
        type: String,
        required: true
      }
    },
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
    'vue-toast': VueToast,
    'date-picker': myDatepicker,
  loading, 
  Money,
  },
 data () {
    return {
        
    tower: {
        decimal: ',',
        thousands: '.',
        prefix: '',
        suffix: ' M',
        precision: 0,
        masked: false
        },
    duit: {
        decimal: ',',
        thousands: '.',
        prefix: 'Rp. ',
        suffix: '',
        precision: 0,
        masked: false
        },
  isLoading: false,
  modal:new CrudModal({komunikasiproject: false,approve: false, drop: false}),
    formErrors:{},
     file_name:'',
     document_ijin_warga:'',
     document_pks:'',
     document_imb:'',
     message:'',
    rfc_date: {
        time: ''
      }, 
  GetLevel:'', 
    option: {
        type: 'day',
        week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        format: 'YYYY-MM-DD',
        placeholder: 'YYYY-MM-DD',
        inputStyle: {
          'display': 'inline-block',
          'padding': '6px',
          'line-height': '22px',
          'font-size': '16px',
          'border': '2px solid #fff',
          'box-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.2)',
          'border-radius': '2px',
          'color': '#5F5F5F'
        },
        color: {
          header: '#B799DA',
          headerText: '#f00'
        },
        buttons: {
          ok: 'Ok',
          cancel: 'Cancel'
        },
        overlayOpacity: 0.5, // 0.5 as default 
        dismissible: true // as true as default 
      },
    position: 'up right',
    closeBtn: true,
  forms: new CrudForm({id:'' , project_id:'' , documentboqid:'' , site_type:'' , tower_type:'' , roof_top_high:'' , tower_high:'' , rf_in_meters:'' , mw_in_meters:'', harga_bulan:'' , harga_tahun:'' , created_at:''}), 
    errors: new Errors() ,
    errorNya: [], 
    komunikasi:[] ,
    dataNya: {name : '', level:''}, 
    loading: false,
      moreParams: {}
    }
  },
 watch: {
        },
        methods: {
               dataAction () {
      if(this.typenya === "edit-boq-detail")
      {
           this.forms = this.rowDatanya.project;
           this.GetKomunikasi(this.rowDatanya.project.id);
      }
      else
      {
      this.$router.push('/page-not-found');
      }
        
      },
                  ApproveItem(){

                   this.errorNya = '';
                   this.message = '';
                this.modal.set('approve', true); 
               
            }  , 
             drop(){

                   this.errorNya = '';
                   this.message = '';
                this.modal.set('drop', true); 
               
            }  ,
     newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name = files[0];
                
           }, 
              resetforms() {
            this.errorNya='';
            this.forms.reset();
                this.errors.clearAll();
        },
            success(kata) {
      this.$swal({
  position: 'top-end',
  type: 'success',
  title: kata,
  showConfirmButton: false,
  timer: 1500
})
    },
            backLink() {
 this.$router.push('/boq-submit');
            } ,
    allcap (e, o, prop) {
  const start = e.target.selectionStart;
    e.target.value = e.target.value.toUpperCase();
    this.$set(o, prop, e.target.value);
    e.target.setSelectionRange(start, start);
    },
    formatDate (value, fmt = 'DD-MM-YYYY HH:mm:ss') {
      return (value == null)
        ? ''
        : moment(value, 'DD-MM-YYYY HH:mm:ss').format(fmt)
    },    
     error(kata) {
      this.$swal({
  position: 'top-end',
  type: 'error',
  title: kata,
  showConfirmButton: false,
  timer: 1500
})
    },
    
 question(kata) {
      this.$swal(
'Ooppss?',
 kata,
  'question'
)
    },   
    submitData() {
      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {    
    this.isLoading = true; 
   var masuk = {'project_id':this.rowDatanya.project.id , 'projectid':this.rowDatanya.project.projectid,'documentboqid':this.rowDatanya.project.documentboqid,'kata':'Project '+this.rowDatanya.project.projectid+' Menunggu Approval Anda','infratype':this.rowDatanya.project.infratype,'site_type':this.forms.site_type,'tower_type':this.forms.tower_type,'roof_top_high':this.forms.roof_top_high,'tower_high':this.forms.tower_high,'rf_in_meters': this.forms.rf_in_meters,'mw_in_meters': this.forms.mw_in_meters,'harga_bulan': this.forms.harga_bulan,'harga_tahun': this.forms.harga_tahun,'status': 14};
                axios.put('/karyawan/EditBOQ/'+ this.rowDatanya.project.documentboqid, masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success);
                 this.isLoading = false;
                 this.backLink();
                      } 
                      else 
                      {
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
                      } 
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    }) 
}
})
            },

   

dropData() {
        this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
   let masuk = new FormData();
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('kata', 'DROP Project '+this.rowDatanya.project.projectid+' Menunggu Approval Anda')
   masuk.set('infratype', this.rowDatanya.project.infratype)
   masuk.set('message', this.message)
   masuk.set('statusmessage', 'APPROVAL DROP PROJECT') 
   masuk.set('document', 'DROP PROJECT')
   masuk.set('status', 106)
                axios.post('/karyawan/DropProjectHQ', masuk)
                    .then(response => {     
                 this.success(response.data.success);
                 this.isLoading = false;
                 this.backLink();
                      
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })
  }
})
            },
 
  GetKomunikasi(id){
                axios.get('/karyawan/GetKomunikasiProject/'+id).then((response) => {
                    this.komunikasi = response.data;
                });
            },
    
  },
   events: {

  },
  created: function() {
        },
              mounted() {
            this.dataAction();

        }, 
}


</script>



<style>
.modal {
    display: none;
    height: 100%;
    left: 0;
    position: fixed;
    top: 0;
    width: 100%;
}
.modal.open {
   display: block;
}
.modal-backdrop {
z-index: -1;
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}
.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
.modal-content {
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
  opacity: 1;
  height: auto;
  min-height: 100%;
  border-radius: 0;
}
.modal-dialog {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}
.modal-container {
  width: 90%;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}
.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}
.modal-body {
  margin: 20px 0;
   max-height: calc(100vh - 210px);
    overflow-y: auto;
}
.modal-default-button {
  float: right;
}

.modal-enter {
  opacity: 0;
}
.modal-leave-active {
  opacity: 0;
}
.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>