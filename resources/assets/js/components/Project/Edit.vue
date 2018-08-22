<template>
 <div> 
<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header" align="center">Perubahan Data Project ID {{this.rowDatanya.project.projectid}}</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
<button type="button" class="btn btn-raised btn-warning" @click="backLink()"> <i class="ft-arrow-left position-left"></i> Kembali</button>
                </div>
                <div class="card-body">


<div class="form-body">
    <div class="row">

<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Detail Project</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="rubahProject()" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>



<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-info">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen SIS</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="rubahSIS()" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>



<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-warning">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen DRM</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="rubahDRM()" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>


<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-danger">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen SITAC</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="rubahSITAC()" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>




                </div>
                </div>



                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Inputs end -->







<!-- @edit project -->
<modal  v-if="modal.get('editProject')" @close="modal.set('editProject', false)">
        <template slot="header" align="center"><h4 align="center">Edit Detail Project</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahProjectsubmitData()">
                <div class="modal-body">

<div class="col-sm-12">        
<div class="form-body">
                            <div class="row">
                                <div class="col-sm-6 mb-1">
                                    <fieldset class="form-group">
                                        <label for="projectid">Project ID</label>
<input type="text" @input="allcap($event, forms, 'projectid')" class="form-control" placeholder="Project ID" v-model="forms.projectid" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['projectid']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

<div class="col-sm-6 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_wo">No WO</label>
<input type="text" @input="allcap($event, forms, 'no_wo')" class="form-control" placeholder="No WO" v-model="forms.no_wo"  required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_wo']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
                                
                                <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="wo_date">WO Date</label>
<date-picker :date="woDate" :option="option" class="form-control" required></date-picker>                              
<div class="help-block"><ul role="alert">
  <li v-for="error of errorNya['wo_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
                                

                                <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="batch">Batch</label>
 <select class="form-control border-input" v-model="forms.batch" required >
<option value="" selected>Pilih Batch</option>
<option v-for="(n,index) in 25" :value="n">{{ n }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['batch']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="years">Tahun Batch</label>
 <select class="form-control border-input" v-model="forms.years" required >
<option value="" selected>Pilih Tahun Batch</option>
<option v-for="n in getYears(2010)" :value="n">{{ n }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['years']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>



<div class="col-xl-2 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
                                        <label for="infratype">Infratype</label>
<select class="form-control border-input" v-model="forms.infratype" required >
<option value="" selected>Pilih Infratype</option>
<option v-for="pilihinfratype in pilihaninratype" :value="pilihinfratype">{{ pilihinfratype }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['infratype']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>



<div class="col-xl-2 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
                                        <label for="area">Area</label>
<select class="form-control border-input" v-model="forms.area" required >
<option value="" selected>Pilih Area User</option>
<option v-for="piliharea in pilihanarea" :value="piliharea">{{ piliharea }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['area']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
                                        <label for="regional">Regional</label>
<input type="text" @input="allcap($event, forms, 'regional')" class="form-control" placeholder="Regional" v-model="forms.regional" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['regional']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
                                        <label for="site_id_spk">Site ID SPK</label>
<input type="text" @input="allcap($event, forms, 'site_id_spk')" class="form-control" placeholder="Site ID SPK" v-model="forms.site_id_spk" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_id_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
                                        <label for="site_name_spk">Site Name SPK</label>
<input type="text" @input="allcap($event, forms, 'site_name_spk')" class="form-control" placeholder="Site Name SPK" v-model="forms.site_name_spk" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_name_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
                                        <label for="address_spk">ALamat Site</label>
<textarea type="text" @input="allcap($event, forms, 'address_spk')" class="form-control" placeholder="ALamat Site" v-model="forms.address_spk" rows="5" required></textarea>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['address_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


<div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="longitude_spk">Longitude SPK</label>
<input type="text" @input="allcap($event, forms, 'longitude_spk')" class="form-control" placeholder="Longitude SPK" v-model="forms.longitude_spk" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['longitude_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

<div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="latitude_spk">Latitude SPK</label>
<input type="text" @input="allcap($event, forms, 'latitude_spk')" class="form-control" placeholder="Latitude SPK" v-model="forms.latitude_spk" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['latitude_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

</div>
</div>
</div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editProject', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>






<!-- @edit SIS -->
<modal  v-if="modal.get('editSIS')" @close="modal.set('editSIS', false)">
        <template slot="header" align="center"><h4 align="center">Edit Dokumen SIS</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenSISsubmitData()">
                <div class="modal-body">

<div class="col-sm-12">        
<div class="form-body">
                            <div class="row">



                                    <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="documentsis"><h4>Dokumen SIS</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" accept="application/pdf" name="file_name" id="file_name" v-on:change="newAvatar" required="required"> 
            <span class="file-custom"></span>
                    </label>        
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_sis']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<div v-if="this.formsSIS.id">
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.formsSIS.document_sis" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a></div>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                        </fieldset>
                                    </div>
           
                                
  
 

</div>
</div>
</div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editSIS', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>






<!-- @edit DRM -->
<modal  v-if="modal.get('editDRM')" @close="modal.set('editDRM', false)">
        <template slot="header" align="center"><h4 align="center">Edit Dokumen DRM</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenDRMsubmitData()">
                <div class="modal-body">

<div class="col-sm-12">        
<div class="form-body">
                            <div class="row">



 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_id_actual">AKTUAL SITE ID</label>
                                        <br>
<input type="text" @input="allcap($event, formsDRM, 'site_id_actual')" class="form-control" placeholder="AKTUAL SITE ID" v-model="formsDRM.site_id_actual" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_id_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                
<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_name_actual">AKTUAL SITE NAME</label>
                                        <br>
<input type="text" @input="allcap($event, formsDRM, 'site_name_actual')" class="form-control" placeholder="AKTUAL SITE NAME" v-model="formsDRM.site_name_actual" required>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_name_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>           
                                

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="province">PROVINSI</label>
                                        <br>
<input type="text" @input="allcap($event, formsDRM, 'province')" class="form-control" placeholder="PROVINSI" v-model="formsDRM.province" required>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['province']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>  

 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="city">KOTA</label>
                                        <br>
<input type="text" @input="allcap($event, formsDRM, 'city')" class="form-control" placeholder="KOTA" v-model="formsDRM.city" required>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['city']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
                               
 
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_actual">ALAMAT</label>
                                        <br>
  <textarea @input="allcap($event, formsDRM, 'address_actual')" v-model="formsDRM.address_actual" class="form-control" rows="5" id="message" placeholder="ALAMAT" required></textarea>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['address_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="longitude_actual">KOORDINAT</label>
                                        <br>
<input type="text" @input="allcap($event, formsDRM, 'longitude_actual')" class="form-control" placeholder="LONGITUDE" v-model="formsDRM.longitude_actual" required>
<br>
<input type="text" @input="allcap($event, formsDRM, 'latitude_actual')" class="form-control" placeholder="LATITUDE" v-model="formsDRM.latitude_actual" required>
<br>
<a :href="'http://www.google.com/maps/place/'+this.formsDRM.longitude_actual+','+this.formsDRM.latitude_actual" target="_blank"><button type="button" class="btn btn-raised btn-success">
  <i class="ft-navigation"></i> Maps
</button></a>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['longitude_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['latitude_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div> 


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="kom_date">TANGGAL KOM</label>
                                        <br>
<date-picker :date="kom_date" :option="option"></date-picker>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['kom_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_kom">DOKUMEN KOM</label>
                                        <br>
                                       <br>
<label id="projectinput8" class="file center-block">
<input type="file" accept="application/pdf" name="document_kom" id="document_kom" v-on:change="newAvatarkom"> 
            <span class="file-custom"></span>
                    </label>        
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_kom']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
<br>
<div v-if="this.formsDRM.document_kom">
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.formsDRM.document_kom" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>
</div>
                                    </fieldset>
                                </div>



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="drm_date">TANGGAL DRM</label>
                                        <br>
<date-picker :date="drm_date" :option="option"></date-picker>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['drm_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_drm">DOKUMEN DRM</label>
                                        <br>
                                       <br>
<label id="projectinput8" class="file center-block">
<input type="file" accept="application/pdf" name="document_drm" id="document_drm" v-on:change="newAvatarDRM"> 
            <span class="file-custom"></span>
                    </label>        
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_drm']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
<br>
<div v-if="this.formsDRM.document_drm">
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.formsDRM.document_drm" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>
</div>
                                    </fieldset>
                                </div>

</div>
</div>
</div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editDRM', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>




<!-- @edit SITAC -->
<modal  v-if="modal.get('editSITAC')" @close="modal.set('editSITAC', false)">
        <template slot="header" align="center"><h4 align="center">Edit Dokumen SITAC</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenSITACsubmitData()">
                <div class="modal-body">

<div class="col-sm-12">        
<div class="form-body">
<div class="row">

 
 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_ban_bak">NO BAN / BAK</label>
                                        <br>
<input type="text" @input="allcap($event, formsSITAC, 'no_ban_bak')" class="form-control" placeholder="AKTUAL SITE ID" v-model="formsSITAC.no_ban_bak" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_ban_bak']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="date_ban_bak">TANGGAL DOKUMEN BAN / BAK</label>
                                        <br>
 <date-picker :date="date_ban_bak" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['date_ban_bak']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_ban_bak">DOKUMEN BAN / BAK</label>                              
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_ban_bak" id="document_ban_bak" ref="document_ban_bak" v-on:change="newAvatarDokBanBak()"> 
   <div v-if="this.formsSITAC.document_ban_bak">                                     <br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.formsSITAC.document_ban_bak" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
</div>         
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_ban_bak']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="ijin_warga_date">TANGGAL DOKUMEN IJIN WARGA</label>
                                        <br>
 <date-picker :date="ijin_warga_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['ijin_warga_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_ijin_warga">DOKUMEN IJIN WARGA</label>
                                        <br> 
<label id="projectinput8" class="file center-block">
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_ijin_warga" id="document_ijin_warga" ref="document_ijin_warga" v-on:change="newAvatarIjinWarga()">  
            <span class="file-custom"></span>
                    </label>        
                                        <br>
 <div v-if="this.formsSITAC.document_ijin_warga">                                       
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.formsSITAC.document_ijin_warga" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a></div>  <br>  
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_ijin_warga']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_pks">NO PKS</label>
                                        <br>
<input type="text" @input="allcap($event, formsSITAC, 'no_pks')" class="form-control" placeholder="AKTUAL SITE ID" v-model="formsSITAC.no_pks" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_pks']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="pks_date">TANGGAL DOKUMEN PKS</label>
                                        <br>
 <date-picker :date="pks_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['pks_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_pks">DOKUMEN PKS</label>
                                        
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_pks" id="document_pks" ref="document_pks" v-on:change="newAvatarPKS()">       
<br>
 <div v-if="this.formsSITAC.document_pks"> 
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.formsSITAC.document_pks" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a></div> <br>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_pks']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

                                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_imb">NO IMB</label>
                                        <br>
<input type="text" @input="allcap($event, formsSITAC, 'no_imb')" class="form-control" placeholder="AKTUAL SITE ID" v-model="formsSITAC.no_imb" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_imb']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
<label for="imb_date">TANGGAL IMB (Selamanya ? <input type="checkbox" id="checkbox" v-model="datenyaIMB">)</label>
                                        <br>
 <div v-if="this.datenyaIMB === true">                                       
 SELAMANYA
</div>
<div v-else>
<date-picker :date="imb_date" :option="option"></date-picker>
</div>    
   
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['imb_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_imb">DOKUMEN IMB</label>
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_imb" id="document_imb" ref="document_imb" v-on:change="newAvatarIMB()">
 <br>
  <div v-if="this.formsSITAC.document_imb"> 
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.formsSITAC.document_imb" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> </div><br>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_imb']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

</div>
</div>
</div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editSITAC', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>











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
  },
 data () {
    return {
	isLoading: false,
    formErrors:{},
	GetLevel:'', 
     file_name:'',
     document_kom:'',
     document_drm:'',
     document_ban_bak:'',
     document_ijin_warga:'',
     document_pks:'',
     document_imb:'',
  woDate: {
        time: ''
      },
  kom_date: {
        time: ''
      },
  drm_date: {
        time: ''
      },
  date_ban_bak: {
        time: ''
      },
  ijin_warga_date: {
        time: ''
      },
  pks_date: {
        time: ''
      },
	imb_date: {
        time: ''
      },
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
  modal:new CrudModal({editProject: false , editSIS: false ,  editDRM: false ,   editSITAC: false , }),


  forms: new CrudForm({id:'' , projectid:'' , no_wo:'' , wo_date:'',  batch:'',  years:'',  infratype:'',  area:'' , regional:'' , site_id_spk:'' , site_name_spk:'' , address_spk:'', longitude_spk:'' , latitude_spk:'' , status_id:'' , project_status_id:''}), 

  formsSIS: new CrudForm({id:'' , project_id:'' , document_sis:''}), 

  formsDRM: new CrudForm({id:'' , project_id:'' , site_id_actual:'' , site_name_actual:'' , province:'' , city:'' , address_actual:'' , longitude_actual:'' , latitude_actual:'' , kom_date:'' , drm_date:'' , document_kom:'' , document_drm:''}), 

	formsSITAC: new CrudForm({id:'' , project_id:'' , no_ban_bak:'' , date_ban_bak:'' , document_ban_bak:'' , ijin_warga_date:'' , document_ijin_warga:'' , no_pks:'' , pks_date:'' , kom_date:'' , document_pks:'' , no_imb:'' , imb_date:'' , document_imb:''}), 

	pilihaninratype: ['B2S','UNTAPPED'],
	pilihanarea: ['1','2','3','4'],
     datenyaIMB: false,
    errors: new Errors() ,
    errorNya: [],
    dataStatus: '',
    dataNya: {name : '', level:''},
    perPage: 10,
    loading: false,
      moreParams: {}
    }
  },
 watch: {
        },
        methods: {

          //edit sitac
      rubahSITAC(){
                this.errorNya = ''; 
                this.modal.set('editSITAC', true); 
               
            }  ,  
       rubahDokumenSITACsubmitData() {

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
        if(this.datenyaIMB === false)
    {
var datenya = this.imb_date.time;
    }
    else
    {
var datenya = 'SELAMANYA';
    }
   let masuk = new FormData();
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('id', this.formsSITAC.id)
   masuk.set('no_ban_bak', this.formsSITAC.no_ban_bak) 
   masuk.set('date_ban_bak', this.date_ban_bak.time) 
   masuk.set('document_ban_bak', this.file_name)
   masuk.set('ijin_warga_date', this.ijin_warga_date.time) 
   masuk.set('no_pks', this.formsSITAC.no_pks)
   masuk.set('pks_date', this.pks_date.time) 
   masuk.set('no_imb', this.formsSITAC.no_imb)
   masuk.set('imb_date', datenya) 
                axios.post('/karyawan/RevisiDocumentSITACByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success);
                 this.isLoading = false;
                 this.backLink();
                      } 
                      else if(response.data.error)
                      {
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
                      }
                      else
                      {
                         this.modal.set('approve', false);
                          this.isLoading = false; 
                        this.errorNya = {document_drm:[response.data.error]};
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

          //edit drm
      rubahDRM(){
                this.errorNya = ''; 
                this.modal.set('editDRM', true); 
               
            }  ,  
      
 rubahDokumenDRMsubmitData() {
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
   masuk.set('id', this.formsDRM.id)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('site_id_actual', this.formsDRM.site_id_actual)
   masuk.set('site_name_actual', this.formsDRM.site_name_actual)
   masuk.set('city', this.formsDRM.city)
   masuk.set('address_actual', this.formsDRM.address_actual)
   masuk.set('longitude_actual', this.formsDRM.longitude_actual)
   masuk.set('latitude_actual', this.formsDRM.latitude_actual)
   masuk.set('kom_date', this.kom_date.time)
   masuk.set('drm_date', this.drm_date.time)
   masuk.set('province', this.formsDRM.province) 
   masuk.set('document_kom', this.document_kom)
   masuk.set('document_drm', this.document_drm)

                axios.post('/karyawan/updateDRMByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success);
                 this.isLoading = false;
                 this.backLink();
                      } 
                      else if(response.data.error)
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                      else
                      {
                         this.modal.set('approve', false);
                          this.isLoading = false; 
                        this.errorNya = {document_sis:[response.data.error]};
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
                        
    this.isLoading = false;
                 this.backLink();
                    })
  }



})
            },

          //edit sis
      rubahSIS(){
                this.errorNya = ''; 
                this.modal.set('editSIS', true); 
               
            }  ,  
    
 rubahDokumenSISsubmitData() {
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
   masuk.set('id', this.formsSIS.id)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('document_sis', this.file_name);

                axios.post('/karyawan/updateSISByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success);
                 this.isLoading = false;
                 this.backLink();
                      } 
                      else if(response.data.error)
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                      else
                      {
                         this.modal.set('approve', false);
                          this.isLoading = false; 
                        this.errorNya = {document_sis:[response.data.error]};
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
                        
    this.isLoading = false;
                 this.backLink();
                    })
  }



})
            },


  //edit project           
      rubahProject(){
                this.errorNya = ''; 
                this.modal.set('editProject', true); 
               
            }  ,      
 rubahProjectsubmitData() {
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

var masuk ={
 id:this.forms.id,
 projectid:this.forms.projectid,
 no_wo:this.forms.no_wo,
 wo_date:this.woDate.time,
 batch:this.forms.batch,
 years:this.forms.years,
 infratype:this.forms.infratype,
area:this.forms.area,
 regional:this.forms.regional,
 site_id_spk:this.forms.site_id_spk,
 site_name_spk:this.forms.site_name_spk,
 address_spk:this.forms.address_spk,
 longitude_spk:this.forms.longitude_spk,
 latitude_spk:this.forms.latitude_spk};

                axios.post('/karyawan/updateprojectByAdmin', masuk)
                    .then(response => { 
                 this.isLoading = false;
                 this.success(response.data.success);
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
                        
    this.isLoading = false;
                 this.backLink();
                    })
  }



})
            },

        	getYears:function(start){
        		var stop = new Date().getFullYear()+1;
            return new Array(stop-start).fill(start).map((n,i)=>n+i);
        },
               dataAction () {
      if(this.typenya === "edit-project")
      {

          this.forms = this.rowDatanya.project;
          this.woDate.time = this.rowDatanya.project.wo_date;
          this.getSIS(this.rowDatanya.project.id);
          this.getDRM(this.rowDatanya.project.id);
          this.getSITAC(this.rowDatanya.project.id);
      }
      else
      {
      this.$router.push('/page-not-found');
      }
        
      },
     getSIS(id) {
            axios.get('/karyawan/getSISDocument/'+id).then((response) => {
                    this.formsSIS = response.data;
                })
           },
     getDRM(id) {
            axios.get('/karyawan/getDRMDocument/'+id).then((response) => {
                    this.formsDRM = response.data;
                    this.kom_date.time = response.data.kom_date;
                    this.drm_date.time = response.data.drm_date;
                })
           },
     getSITAC(id) {
            axios.get('/karyawan/getSITACDocument/'+id).then((response) => {
                    this.formsSITAC = response.data;
                    this.date_ban_bak.time = response.data.date_ban_bak;
                    this.ijin_warga_date.time = response.data.ijin_warga_date;
                    this.pks_date.time = response.data.pks_date; 
           if(response.data.imb_date === 'SELAMANYA')
           {
           this.datenyaIMB = true;
           }
           else
           {
          this.imb_date.time = response.data.imb_date;  
           }
                })
           },
     newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name = files[0];
                
           },
     newAvatarkom(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_kom = files[0];
                
           },
     newAvatarDRM(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_drm = files[0];
                
           },
     newAvatarDokBanBak(event) {

this.isLoading = true;            
this.document_ban_bak = this.$refs.document_ban_bak.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.formsSITAC.id)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid) 
   masuk.set('document_ban_bak', this.document_ban_bak) 
axios.post('/karyawan/uploaddokumenSITACByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.formsSITAC.document_ban_bak = response.data.namafilenya;
    this.formsSITAC.id = response.data.id;
    this.document_ban_bak = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_ban_bak)
{
    this.document_ban_bak = '';
  this.errorNya = {document_ban_bak:[response.data.document_ban_bak]}; 
}
if(response.data.errorfile)
                      {
    this.document_ban_bak = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_ban_bak = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.file_name = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_ban_bak = '';                
           },
           newAvatarIjinWarga() { 
 this.isLoading = true;            
this.document_ijin_warga = this.$refs.document_ijin_warga.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.formsSITAC.id)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid) 
   masuk.set('document_ijin_warga', this.document_ijin_warga) 
axios.post('/karyawan/uploaddokumenSITACijinWargaByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.formsSITAC.document_ijin_warga = response.data.namafilenya;
    this.formsSITAC.id = response.data.id;
    this.document_ijin_warga = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_ijin_warga)
{
    this.document_ijin_warga = '';
  this.errorNya = {document_ijin_warga:[response.data.document_ijin_warga]}; 
}
if(response.data.errorfile)
                      {
    this.document_ijin_warga = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_ijin_warga = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.document_ijin_warga = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_ijin_warga = '';               
                
           },
     newAvatarPKS() { 
 this.isLoading = true;            
this.document_pks = this.$refs.document_pks.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.formsSITAC.id)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid) 
   masuk.set('document_pks', this.document_pks) 
axios.post('/karyawan/uploaddokumenSITACPKSByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.formsSITAC.document_pks = response.data.namafilenya;
    this.formsSITAC.id = response.data.id;
    this.document_pks = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_pks)
{
    this.document_pks = '';
  this.errorNya = {document_pks:[response.data.document_pks]}; 
}
if(response.data.errorfile)
                      {
    this.document_pks = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_pks = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.document_pks = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_pks = '';                
           },
            newAvatarIMB() { 
 this.isLoading = true;            
this.document_imb = this.$refs.document_imb.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.formsSITAC.id)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid) 
   masuk.set('document_imb', this.document_imb) 
axios.post('/karyawan/uploaddokumenSITACIMBByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.formsSITAC.document_imb = response.data.namafilenya;
    this.formsSITAC.id = response.data.id;
    this.document_imb = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_imb)
{
    this.document_imb = '';
  this.errorNya = {document_imb:[response.data.document_imb]}; 
}
if(response.data.errorfile)
                      {
    this.document_imb = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_imb = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.document_imb = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_imb = '';               
                
           },
  fetchIt(){
   this.isLoading = true;
                axios.get('/karyawan/CekUserProfileAkses/ProjectAdd').then((response) => {
                   if(response.data === true)
                   {
                   	this.isLoading = false;
                   }
                   else
                   {
                   	this.$router.push('/page-not-found');
                   }
                }).catch(error => {
				if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                       this.$router.push('/server-error');
                    }
                   else if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
					else
					{
                         this.$router.push('/page-not-found');
					}
					}
                    });
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
			    this.$router.push('/list-project');
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
      resetforms() {
         		this.errorNya='';
         		 this.woDate.time = '';
         		this.forms.reset();
                this.errors.clearAll();
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


var masuk ={
 projectid:this.forms.projectid,
 no_wo:this.forms.no_wo,
 wo_date:this.woDate.time,
 batch:this.forms.batch,
 years:this.forms.years,
 infratype:this.forms.infratype,
area:this.forms.area,
 regional:this.forms.regional,
 site_id_spk:this.forms.site_id_spk,
 site_name_spk:this.forms.site_name_spk,
 address_spk:this.forms.address_spk,
 status_id:1,
 project_status_id:0};

 if (result.value) {
                axios.post('/karyawan/listproject', masuk)
                    .then(response => {
                this.resetforms();
                 this.success(response.data.success);
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })
  }



})
            },
		
  },
   events: {

  },
  created: function() {
        },
		          mounted() {
            this.fetchIt();
            this.dataAction();

        }
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