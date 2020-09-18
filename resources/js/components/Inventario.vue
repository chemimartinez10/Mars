<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <b-container fluid class="mt-3">
          <!-- User Interface controls -->
    
            <!-- Main table element -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Almacén</h3>
                <div class="card-tools">
                  <button class="btn orangered" @click="chooseModal">Nuevo <i class="fas fa-warehouse fa-fw"></i>
                  </button>
                </div>

                <b-row class="mt-2">
                  <b-col lg="8">
                    <b-form-group
                      description="Filtrado, deje sin seleccionar para buscar en todos los campos"
                      class="mb-0">
                      <b-form-checkbox-group v-model="$parent.filterOn" class="mt-1">
                        <b-form-checkbox value="nombre">Nombre</b-form-checkbox>
                        <b-form-checkbox value="tipo">Tipo</b-form-checkbox>
                        <b-form-checkbox value="marca">Marca</b-form-checkbox>
                        <b-form-checkbox value="cantidad">Cantidad</b-form-checkbox>
                        <b-form-checkbox value="material">Material</b-form-checkbox>
                        <b-form-checkbox value="color">Color</b-form-checkbox>
                        <b-form-checkbox value="serial">Serial</b-form-checkbox>
                      </b-form-checkbox-group>
                    </b-form-group>
                  </b-col>
                  <b-col lg="4" align="right" class="mt-3">
                    <b-button size="sm" @click="selectAllRows" variant="outline-dark">Seleccionar todo</b-button>
                    <b-button size="sm" @click="clearSelected" variant="outline-dark">Borrar selección</b-button>
                  </b-col>
                </b-row>
              </div>

              <div class="card-body table-responsive p-0">

                <b-table
                  id="tabla-inventario"
                  striped
                  bordered
                  show-empty
                  stacked="md"
                  :items="items"
                  :fields="fields"
                  :current-page="currentPage"
                  :per-page="perPage"
                  :filter="$parent.filter"
                  :filterIncludedFields="$parent.filterOn"
                  :sort-by.sync="sortBy"
                  :sort-desc.sync="sortDesc"
                  :sort-direction="sortDirection"
                  @filtered="onFiltered"
                  hover
                  ref="selectableTable"
                  selectable
                  :select-mode="selectMode"
                  @row-selected="onRowSelected"
                >

                  <template v-slot:cell(name)="row">
                    {{ row.value.first }} {{ row.value.last }}
                  </template>

                  <template v-slot:cell(actions)="row">

                    <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1" variant="outline-dark">
                      Info modal
                    </b-button>

                    <b-button size="sm" @click="row.toggleDetails" variant="outline-dark" class="mr-1">
                      {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
                    </b-button>

                    <b-button size="sm" href="#" variant="outline-dark" class="mr-1">
                      <i class="fa fa-edit blue"></i>
                    </b-button>
                
                    <b-button size="sm" variant="outline-dark">
                        <i class="fa fa-trash red"></i>
                    </b-button>

                  </template>

                  <template v-slot:row-details="row">
                    <b-card>
                      <ul>
                        <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
                      </ul>
                    </b-card>
                  </template>

                </b-table>
              </div>
            </div>

            <b-col class="my-1">
              <b-pagination
                  v-model="currentPage"
                  :total-rows="totalRows"
                  :per-page="perPage"
                  align="right"
                  size="md"
                  class="my-0"
              >
              </b-pagination>
            </b-col>

            <!-- Info modal -->
            <b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal">
              <pre>{{ infoModal.content }}</pre>
            </b-modal>
        </b-container>  
      </div>
    </div>

    <!-- Modal para escoger -->

    <div class="modal fade" id="chooseNew" tabindex="-1" role="dialog" aria-labelledby="chooseNew" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="chooseNew">¿Qué desea agregar?</h5>
            <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>  
          
          <div class="modal-body">
            <div class="d-flex justify-content-center">

              <div class="col-sm-6 text-center">
                <a href="#" @click="newModalArt">
                  <img src="img/office.png" alt="Art. oficina Logo" class="img-thumbnail">
                </a>
                <span class="font-weight-bold mt-3">Art. Oficina</span>
              </div>    
                                
              <div class="col-sm-6 text-center">
                <a href="#" @click="newModalHerra">
                  <img src="img/tools.png" alt="Herramienta Logo" class="img-thumbnail ml-1">
                </a>
                <span class="font-weight-bold mt-3 ml-2">Herramienta</span>
              </div>    

            </div>      
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div> 
        </div>
      </div>
    </div> 

    <!-- Modal Articulos-->

    <div class="modal fade" id="addNewArt" tabindex="-1" role="dialog" aria-labelledby="addNewArt" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header dark">
            <h5 v-show="!editmode" class="modal-title" id="addNewArt">Agregar nuevo Art. de oficina</h5>
            <h5 v-show="editmode" class="modal-title" id="addNewArt">Actualizar Art. de oficina</h5>
            <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>  
            <div class="modal-body">

              <!-- Primera fila -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" aria-label="nombre" required>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-copyright"></i></span>
                    </div>
                    <input type="text" class="form-control" id="marca" placeholder="Marca" aria-label="Marca" required>
                  </div>
                </div>
              </div>


              <!-- Segunda fila -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-tree"></i></span>
                    </div>
                    <input type="text" class="form-control" id="material" placeholder="Material" aria-label="Material" required>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-palette"></i></span>
                    </div>
                    <select class="custom-select rounded-left" id="color">
                      <option selected>Color</option>
                      <option value=""></option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Tercera fila -->
              <div class="form-row">
                <div class="form-group col-md-12">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-book"></i></span>
                    </div>
                    <textarea class="form-control" placeholder="Observación"></textarea>
                  </div>
                </div>
              </div> 

            </div>
            <div class="modal-footer">
              <button type="button" @click="backtoModal" class="btn btn-danger"><i class="fas fa-arrow-left"></i>  Volver</button>
              <button v-show="editmode" type="submit" class="btn btn-success">Actualizar</button>
              <button v-show="!editmode" type="submit" class="btn btn-primary"><i class="fas fa-save"></i>  Guardar</button>
            </div>
          </form>  
        </div>
      </div>
    </div>

    <!-- Modal Herramientas-->

    <div class="modal fade" id="addNewHerra" tabindex="-1" role="dialog" aria-labelledby="addNewHerra" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header dark">
            <h5 v-show="!editmode" class="modal-title" id="addNewEmple">Agregar nueva Herramienta</h5>
            <h5 v-show="editmode" class="modal-title" id="addNewEmple">Actualizar Herramienta</h5>
            <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="">  
            <div class="modal-body">

              <!-- Primera fila -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" aria-label="nombre" required>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-copyright"></i></span>
                    </div>
                    <input type="text" class="form-control" id="marca" placeholder="Marca" aria-label="Marca" required>
                  </div>
                </div>
              </div>

              <!-- Segunda fila -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
                    </div>
                    <input type="text" class="form-control" id="serial" placeholder="Serial" aria-label="Serial" required>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                    </div>
                    <input type="number" class="form-control" id="anno" placeholder="Año" required="">
                  </div>
                </div>
              </div>

              <!-- Tercera fila -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-palette"></i></span>
                    </div>
                    <select class="custom-select rounded-left" id="color">
                      <option selected>Color</option>
                      <option value=""></option>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-book"></i></span>
                    </div>
                    <textarea class="form-control" placeholder="Observación"></textarea>
                  </div>
                </div>
              </div>  

            </div>
            <div class="modal-footer">
              <button type="button" @click="backtoModal" class="btn btn-danger"><i class="fas fa-arrow-left"></i>  Volver</button>
              <button v-show="editmode" type="submit" class="btn btn-success">Actualizar</button>
              <button v-show="!editmode" type="submit" class="btn btn-primary"><i class="fas fa-save"></i>  Guardar</button>
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
          items: [
          ],
          fields: [
            { key: 'nombre', label: 'Nombre', sortable: true, class: 'text-center' },
            { key: 'tipo', label: 'Tipo', sortable: true, class: 'text-center' },
            { key: 'marca', label: 'Marca', sortable: true, class: 'text-center' },
            { key: 'Cantidad', label: 'Cantidad', sortable: true, class: 'text-center' },
            { key: 'material', label: 'Material', sortable: true, class: 'text-center' },
            { key: 'color', label: 'Color', sortable: true, class: 'text-center' },
            { key: 'serial', label: 'Serial', sortable: true, class: 'text-center' },
            { key: 'actions', label: 'Acciones', class: 'text-center' }
          ],
          totalRows: 1,
          currentPage: 1,
          perPage: 10,
          sortBy: '',
          sortDesc: false,
          sortDirection: 'asc',
          filter: null,
          filterOn: [],
          infoModal: {
            id: 'info-modal',
            title: '',
            content: ''
          },
          selectMode: 'multi',
          selected: []
        }
      },
      mounted() {
        console.log('Component mounted.')
        // Set the initial number of items
        this.totalRows = this.items.length
        },
        methods: {

          chooseModal(){
            $('#chooseNew').modal('show');
          },

          newModalArt(){
            $('#chooseNew').modal('hide');
            this.articulo = true;
            //this.form.reset();
            //this.form.clear();
            $('#addNewArt').modal('show');
          },

          newModalHerra(){
             $('#chooseNew').modal('hide');
            // this.editmode = false;
            // this.form.reset();
            // this.form.clear();
             $('#addNewHerra').modal('show');
          },

          backtoModal(){
            if ( this.articulo === true) {
              $('#addNewArt').modal('hide');
              $('#chooseNew').modal('show');
              this.articulo = false;
            } else {
              $('#addNewHerra').modal('hide');
              $('#chooseNew').modal('show');
            }
          },

          onRowSelected(items) {
            this.selected = items
          },

          selectAllRows() {
            this.$refs.selectableTable.selectAllRows()
          },

          clearSelected() {
            this.$refs.selectableTable.clearSelected()
          },

          info(item, index, button) {
            this.infoModal.title = `Row index: ${index}`
            this.infoModal.content = JSON.stringify(item, null, 2)
            this.$root.$emit('bv::show::modal', this.infoModal.id, button)
          },

          resetInfoModal() {
            this.infoModal.title = ''
            this.infoModal.content = ''
          },

          onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
          },

          loadAll(){
            axios.get('api/empleado').then(({ data }) => {
              
              this.empleados = data.data
              this.items=this.empleados
        
            });
          },

          createRecur() {
            // this.$validator.validateAll()
            this.$Progress.start();
            this.form
              .post("api/recurso")
              .then(() => {
                if (this.articulo === true) {
                  this.form.post("api/articulo").catch(() => {
                    this.$Progress.fail();
                  });
                } else {
                  this.form.post("api/equipo").catch(() => {
                    this.$Progress.fail();
                  });
                }
                
                Fire.$emit("AfterCreate");
                $("#addNewArt").modal("hide");

                if (this.articulo === true) {
                  Toast.fire({
                    type: "success",
                    title: "Articulo registrado éxitosamente"
                  });
                } else {
                  Toast.fire({
                    type: "success",
                    title: "Herramienta registrada éxitosamente"
                  });
                }

                $("#addNewHerra").modal("hide");
                this.$Progress.finish();
                this.loadAll();
                this.reiniciarErrores();
              })
              
              .catch(() => {
                this.$Progress.fail();
              });
          },     
        },
        
        created(){
          this.loadAll();
          
          Fire.$on("AfterCreate", () => {
            this.loadAll();
          });        
        }
    }
</script>