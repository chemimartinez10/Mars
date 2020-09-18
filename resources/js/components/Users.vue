<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdmin()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tabla de usuarios</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Nuevo <i class="fas fa-user-plus fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                  <th>ID<i class="fa fa-caret-square-down btn d-inline pl-1" @click="ordenarPor('id')"></i></th>
                                  <th>Nombre<i class="fa fa-caret-square-down btn d-inline pl-1" @click="ordenarPor('name')"></i></th>
                                  <th>Correo<i class="fa fa-caret-square-down btn d-inline pl-1" @click="ordenarPor('email')"></i></th>
                                  <th>Tipo<i class="fa fa-caret-square-down btn d-inline pl-1" @click="ordenarPor('type')"></i></th>
                                  <th>Registrado<i class="fa fa-caret-square-down btn d-inline pl-1" @click="ordenarPor('created_at')"></i></th>
                                  <th>Modificar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.type | upText }}</td>
                                    <td>{{ user.created_at | myDate }}</td>
                                    <td>
                                        <a href="#" @click="editModal(user)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
            
                                        <a href="#" @click="deleteUser(user.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                             </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>   

        <div v-if="!$gate.isAdmin()">
          <Error-404></Error-404>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode" class="modal-title" id="addNew">Agregar nuevo usuario</h5>
                            <h5 v-show="editmode" class="modal-title" id="addNew">Actualizar usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editmode ? updateUser() : createUser()">  
                            <div class="modal-body">

                                <div class="form-group">
                                  <input v-model="form.name" type="text" name="name"
                                    placeholder="Nombre" 
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                  <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group">
                                  <input v-model="form.email" type="email" name="email"
                                    placeholder="Correo electrónico" 
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                  <has-error :form="form" field="email"></has-error>
                                </div>

                                <div class="form-group">
                                  <textarea v-model="form.bio" name="bio" id="bio"
                                    placeholder="Descripción (opcional)" 
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                  <has-error :form="form" field="bio"></has-error>
                                </div>


                                <div class="form-group">
                                  <select name="type" v-model="form.type" id="type" class="form-control" 
                                  :class="{ 'is-invalid': form.errors.has('type') }">
                                      <option value="">Seleccione rol</option>
                                      <option value="admin">Admin</option>
                                      <option value="usuario">Empleado</option>
                                      <option value="invitado">Invitado</option>
                                  </select>
                                  <has-error :form="form" field="type"></has-error>
                                </div>

                                <div class="form-group">
                                  <input v-model="form.password" placeholder="Contraseña" type="password" name="password" id="password" 
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                  <has-error :form="form" field="password"></has-error>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button v-show="editmode" type="submit" class="btn btn-success">Actualizar</button>
                                <button v-show="!editmode" type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>  
                    </div>
                </div>
        </div> 
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ordenamiento:false,
                editmode: false,
                users: {},
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
        methods: {
            ordenarPor(prop){

                if(this.ordenamiento)this.users.sort((a,b) => a[prop] < b[prop] ? -1 : 1)
                else this.users.sort((a,b) => a[prop] > b[prop] ? -1 : 1)
                this.ordenamiento=!this.ordenamiento
            },
            editModal(user){
                this.editmode = true;
                this.form.reset();
                this.form.clear();
                $('#addNew').modal('show');
                this.form.fill(user);
            },  

            newModal(){
                this.editmode = false;
                this.form.reset();
                this.form.clear();
                $('#addNew').modal('show');
            },

            loadUsers(){
              if(this.$gate.isAdmin()){
                axios.get('api/user').then(({ data }) => (this.users = data.data));  
              }
            },

            createUser(){
                this.$Progress.start();
                this.form.post('api/user')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                    Toast.fire({
                        type: 'success',
                        title: 'Usuario registrado éxitosamente'
                        })
                    this.$Progress.finish();
                })
                .catch(()=>{
                    this.$Progress.fail();                                              
                })
            },
            updateUser() {
               this.$Progress.start();
               this.form.put('api/user/'+this.form.id)
               .then(() => {
                 $('#addNew').modal('hide')

                    Swal.fire(
                                  '¡Actualizado!',
                                  'El usuario ha sido actualizado',
                                  'success'
                                )
                    this.$Progress.finish();
                    this.loadUsers();
               })
               .catch(()=> {
                 this.$Progress.fail();  
               });
            },
            deleteUser(id) {
                Swal.fire({
                  title: '¿Está seguro?',
                  text: "¡No podrá revertir los cambios!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: '¡Sí, eliminar!'
                }).then((result) => {
                     //Enviar solicitud para borrar al servidor
                    if (result.value) {
                            this.form.delete('api/user/'+id).then(()=>{

                                Swal.fire(
                                  '¡Eliminado!',
                                  'El usuario ha sido eliminado',
                                  'success'
                                )
                            this.loadUsers();
                        }).catch(()=> {
                            Swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text: 'Something went wrong!',
                            });
                        });
                    }
                })        
            }
        },
        created() {
          Fire.$on('buscando', () => {
              if(window.location.pathname==='/users'){
                  this.$Progress.start()
                  if(this.$parent.busqueda){
                      let query=this.$parent.busqueda;
                      axios.get('api/findUser?q=' + query)
                      .then(({data}) => (this.users=data.data))
                      .catch(()=>{
                          this.$Progress.fail()
                      });
                  }
                  else
                  {
                      this.loadUsers()
                  }
                  this.$Progress.finish()
              }
          })
          this.loadUsers();
          Fire.$on('AfterCreate',() => {
              this.loadUsers();
          });        
        }
    }
</script>
