<template>
 <div>




<!-- Head-->
<section id="customizing-headings-default">
    <div class="row match-height">




        <div class="col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h1>PROFIL</h1>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td>
<label>Email</label>
                                        </td>
                                        <td>
<input v-model="dataNya.email" type="text" class="form-control" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
<label>Level</label>
                                        </td>
                                        <td>
<input v-model="dataNya.level" type="text" class="form-control" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
<label>Posisi</label>
                                        </td>
                                        <td>
<input v-model="dataNya.posisi" type="text" class="form-control" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
<label>Area</label>
                                        </td>
                                        <td>
<input v-model="dataNya.area" type="text" class="form-control" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
<label>Area 2</label>
                                        </td>
                                        <td>
<input v-model="dataNya.area2" type="text" class="form-control" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
<label>regional</label>
                                        </td>
                                        <td>
<input v-model="dataNya.regional" type="text" class="form-control" disabled>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>



 <div class="col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h1>Password</h1>
                </div>
                <div class="card-body">
                    <div class="card-block">
                       <form @submit.prevent="submitPassword" method="POST">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td>
<label>New Password</label>
                                        </td>
                                        <td>
<fieldset>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="fa fa-eye"></i></span>
                </div>
                <input type="password" name="password" v-model="dataPassword.password" class="form-control pull-right" id="password" placeholer="New Password" required><br>
                <div class="help-block"><ul role="alert"><li v-for="error of errors['password']"><span style="color:red;">{{ error }}</span></li></ul></div>
              </div>
              
              
            </fieldset>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
 <label>New Password Confirmation</label>
                                        </td>
                                        <td>
                                          <fieldset>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="fa fa-eye"></i></span>
                </div>
                <input type="password" name="password_confirmation" v-model="dataPassword.password_confirmation" class="form-control pull-right" id="password_confirmation" placeholer="New Password Confirmation" required><br>
             <div class="help-block"><ul role="alert"><li v-for="error of errors['password_confirmation']"><span style="color:red;">{{ error }}</span></li></ul></div>
              </div>
              
              
            </fieldset>

                      
                <!-- /.input group -->
                                        </td>
                                    </tr>
                                   <tr>
                                     <td colspan="2"><button type="submit" class="btn btn-block btn-primary btn-lg">Submit</button></td>
                                   </tr>
                                </tbody>
                            </table>
                        </div>
                         </form>
                    </div>
                </div>
            </div>
        </div>

       



    </div>
</section>
<!--/ Head -->

   
     
 </div>
</template>


<script>
import Vue from 'vue'
import VueSweetalert2 from 'vue-sweetalert2'

Vue.use(VueSweetalert2)

    export default {
        data(){
            return {
                maxToasts: 100,
                position: 'up right',
                closeBtn: true,
                dataNya: {name : '',level:'',area:'',area2:'',regional:''},
                dataPassword: {password : '',
                password_confirmation: ''},
                loading: false,
                formNya : "",
                errors: [],
                token: localStorage.getItem('token'),
            }
        },
              components: {
      
      },
        methods: {
    success(kata) {
      this.$swal({
  position: 'top-end',
  type: 'success',
  title: kata,
  showConfirmButton: false,
  timer: 1500
})
    },
   
         
            submitPassword() {
  this.$swal({
  title: 'Are you sure ?',
  text: 'Perubahan Password Login',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
                axios.post('/karyawan/changePassword', this.dataPassword)
                    .then(response => {
                this.errors = '';
                 this.success(response.data.success);
                this.dataPassword.password_confirmation = '';
                this.dataPassword.password = '';
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                       this.errors = error.response.data;
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
            fetchIt(){
                this.loading = true;
                axios.get('/karyawan/GetProfile').then((response) => {
                    this.dataNya = response.data;
                    this.loading = false
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
            }
        },
              watch: {

      },
        mounted() {
            //console.log(this.token);
            this.fetchIt();
        }
    }
</script>
