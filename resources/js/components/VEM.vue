<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <b-container fluid class="mt-3">
          <!-- User Interface controls -->
    
            <!-- Main table element -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Maquinaria y vehículos</h3>
                <div class="card-tools">
                  <button class="btn btn-success" @click="chooseModal">Nuevo <i class="fas fa-snowplow fa-fw"></i>
                  </button>
                </div>

                <b-row class="mt-2">
                  <b-col lg="8">
                    <b-form-group
                      description="Filtrado, deje sin seleccionar para buscar en todos los campos"
                      class="mb-0">
                      <b-form-checkbox-group v-model="$parent.filterOn" class="mt-1">
                        <b-form-checkbox value="id">ID</b-form-checkbox>
                        <b-form-checkbox value="nombre">Nombre</b-form-checkbox>
                        <b-form-checkbox value="anno">Año</b-form-checkbox>
                        <b-form-checkbox value="tipo">Tipo</b-form-checkbox>
                        <b-form-checkbox value="marca">Marca</b-form-checkbox>
                        <b-form-checkbox value="modelo">Modelo</b-form-checkbox>
                        <b-form-checkbox value="correo">Cantidad</b-form-checkbox>
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
                  show-empty
                  striped
                  bordered
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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>  
          
          <div class="modal-body">
            <div class="d-flex justify-content-center">

              <div class="col-sm-6 text-center">
                <a href="#" @click="newModalMaqui">
                  <img src="img/excavator.png" alt="Maquinaria Logo" class="img-thumbnail">
                </a>
                <span class="font-weight-bold mt-3">Maquinaria</span>
              </div>    
                                
              <div class="col-sm-6 text-center">
                <a href="#" @click="newModalVehi">
                  <img src="img/truck.png" alt="Vehículo Logo" class="img-thumbnail ml-1">
                </a>
                <span class="font-weight-bold mt-3 ml-2">Vehículo</span>
              </div>    

            </div>      
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div> 
        </div>
      </div>
    </div> 

    <!-- Modal Maquinaria-->

    <div class="modal fade" id="addNewMaqui" tabindex="-1" role="dialog" aria-labelledby="addNewArt" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="!editmode" class="modal-title" id="addNewArt">Agregar nueva maquinaria</h5>
            <h5 v-show="editmode" class="modal-title" id="addNewArt">Actualizar maquinaria</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                      <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
                    </div>
                    <input type="text" class="form-control" id="serial" placeholder="Serial" aria-label="serial" required>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                    </div>
                    <input type="text" class="form-control" id="anno" placeholder="Año" aria-label="anno" required>
                  </div>
                </div>
              </div>


              <!-- Segunda fila -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text rounded-left" for="marca"><i class="fas fa-copyright fa-sm mr-1"></i>Marca</span>
                    </div>
                    <select class="custom-select rounded-right" id="marca">
                      <option value="1">...</option>
                      <option value="2">Ford</option>
                      <option value="3">Chevrolet</option>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text rounded-left" for="modelo"><i class="fas fa-snowplow fa-sm mr-1"></i>Modelo</span>
                    </div>
                    <select class="custom-select rounded-right" id="modelo">
                      <option value="1">...</option>
                      <option value="2"></option>
                      <option value="3"></option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Tercera fila -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text rounded-left" for="color"><i class="fa fa-palette fa-sm mr-1"></i>Color</span>
                    </div>
                    <select class="custom-select rounded-right" id="color">
                      <option value="1">...</option>
                      <option value="2">Blanco</option>
                      <option value="3">Negro</option>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text rounded-left" for="estado"><i class="fa fa-wrench fa-sm mr-1"></i>Estado</span>
                    </div>
                    <select class="custom-select rounded-right" id="estado">
                      <option value="1">...</option>
                      <option value="2">Óptimo</option>
                      <option value="3">Dañado</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Cuarta fila -->
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

    <!-- Modal Vehículo-->

    <div class="modal fade" id="addNewVehi" tabindex="-1" role="dialog" aria-labelledby="addNewHerra" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="!editmode" class="modal-title" id="addNewEmple">Agregar nuevo vehículo</h5>
            <h5 v-show="editmode" class="modal-title" id="addNewEmple">Actualizar vehículo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                      <span class="input-group-text"><i class="fa fa-sort-numeric-down"></i></span>
                    </div>
                    <input type="text" class="form-control" id="serial" placeholder="Serial" aria-label="serial" required>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                    </div>
                    <input type="text" class="form-control" id="anno" placeholder="Año" aria-label="anno" required>
                  </div>
                </div>
              </div>


              <!-- Segunda fila -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text rounded-left" for="marca"><i class="fa fa-copyright fa-sm mr-1"></i>Marca</span>
                    </div>
                    <select class="custom-select rounded-right" id="marca">
                      <option value="1">...</option>
                      <option value="2">Ford</option>
                      <option value="3">Chevrolet</option>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text rounded-left" for="modelo"><i class="fa fa-truck fa-sm mr-1"></i>Modelo</span>
                    </div>
                    <select class="custom-select rounded-right" id="modelo">
                      <option value="1">...</option>
                      <option value="2"></option>
                      <option value="3"></option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Tercera fila -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text rounded-left" for="color"><i class="fa fa-palette fa-sm mr-1"></i>Color</span>
                    </div>
                    <select class="custom-select rounded-right" id="color">
                      <option value="1">...</option>
                      <option value="2">Blanco Supremo</option>
                      <option value="3">Negro</option>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text rounded-left" for="estado"><i class="fa fa-wrench fa-sm mr-1"></i>Estado</span>
                    </div>
                    <select class="custom-select rounded-right" id="estado">
                      <option value="1">...</option>
                      <option value="2">Óptimo</option>
                      <option value="3">Dañado</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Cuarta fila -->
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
  </div>
</template>

<script>
    export default {
      data() {
        return {
          items: [
          ],
          fields: [
            { key: 'id', label: 'ID', sortable: true, sortDirection: 'desc', class: 'text-center' },
            { key: 'nombre', label: 'Nombre', sortable: true, class: 'text-center' },
            { key: 'anno', label: 'Año', sortable: true, class: 'text-center' },
            { key: 'tipo', label: 'Tipo', sortable: true, class: 'text-center' },
            { key: 'marca', label: 'Marca', sortable: true, class: 'text-center' },
            { key: 'modelo', label: 'Modelo', sortable: true, class: 'text-center' },
            { key: 'cantidad', label: 'Cantidad', sortable: true, class: 'text-center' },
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
            newModalMaqui(){
                $('#chooseNew').modal('hide');
                this.maquinaria = true;
                //this.editmode = false;
                //this.form.reset();
                //this.form.clear();
                $('#addNewMaqui').modal('show');
            },
            newModalVehi(){
                $('#chooseNew').modal('hide');
                //this.editmode = false;
                //this.form.reset();
                //this.form.clear();
                $('#addNewVehi').modal('show');
            },
            backtoModal(){
              if ( this.maquinaria === true) {
                $('#addNewMaqui').modal('hide');
                $('#chooseNew').modal('show');
                this.maquinaria = false;
              } else {
                $('#addNewVehi').modal('hide');
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
        },
        created(){
          this.loadAll()
            Fire.$on('AfterCreate',() => {
                this.loadAll();
            });
        }
    }
</script>