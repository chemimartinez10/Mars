<style>
    .widget-user-header{
        background-position: center center;
        background-size: cover;
        height: 250px;
    }
</style>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header text-white" style="background-image:url('./img/user-cover.jpg')">
                    <h3 class="widget-user-username"></h3>
                    <h5 class="widget-user-desc"></h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                   
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                        <h5 class="description-header">13,000</h5>
                        <span class="description-text">FOLLOWERS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                </div>
            </div>

             <!-- tab -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Actividad</a></li>
                        <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Configuraciones</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Activity Tab -->
                            <div class="tab-pane" id="activity">
                                <h3 class="text-center">Mostrar actividad del usuario</h3>
                            </div>
                            <!-- Setting Tab -->
                            <div class="tab-pane active show" id="settings">
                                <form class="form-horizontal">

                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Nombre</label>
                                        <div class="col-sm-12">
                                            <input type="" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" id="inputName">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Correo</label>
                                            <div class="col-sm-12">
                                                <input type="email" v-model="form.email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" id="inputEmail">
                                            </div>
                                            <has-error :form="form" field="email"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label for="photo" class="col-sm-2 control-label">Foto de perfil</label>
                                            <div class="col-sm-12">
                                                <input type="file" @change="updateProfile" name="photo" class="form-input">
                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-sm-12 control-label">Contraseña (dejar vacío si no desea cambiar)</label>
                                            <div class="col-sm-12">
                                                <input type="password" v-model="form.password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" id="password">
                                                <has-error :form="form" field="password"></has-error>
                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-12">
                                            <button @click.prevent="updateInfo" type="submit" class="btn btn-success"><i class="fas fa-save"></i> Actualizar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
          </div>
          <!-- end tabs -->
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: new Form({
                    id: '',    
                    name:  '',
                    email: '', 
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            getProfilePhoto(){
                let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+ this.form.photo;
                return photo;
            },
            updateInfo(){
                this.$Progress.start();
                this.form.put('api/profile/')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                   
                    this.$Progress.finish();
                })
                .catch(()=>{
                    this.$Progress.fail();
                });
            },
            updateProfile(e){
                let file = e.target.files[0];
                console.log(file);
                let reader = new FileReader();
                if(file['size'] < 2111775){
                     reader.onloadend = (file) => {
                   // console.log('RESULT', reader.result)
                   this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: '¡El archivo que intenta subir es muy pesado!',
                    })
                }     
            }
        },
        created() {
            axios.get('api/profile').then(({ data }) => (this.form.fill(data)));
        }
    }
</script>
