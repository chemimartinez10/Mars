a<template>
	<div class="container">
		<div class="row mt-5">
			<div class="col-md-12">
				<div>
					<b-card no-body>
						<b-tabs card>
							<b-tab title="Entradas" active @click="tipoMovimiento('entrada')">
								<b-container fluid class="mt-3">
									<!-- Main table element -->
									<div class="card">
										<div class="card-header">
											<div class="card-tools">
												<button class="btn btn-success" @click="chooseModal">
													Nueva entrada
													<i class="fas fa-warehouse fa-fw"></i>
												</button>
											</div>

											<b-row class="mt-2">
												<b-col lg="8">
													<b-form-group
														description="Filtrado, deje sin seleccionar para buscar en todos los campos"
														class="mb-0"
													>
														<b-form-checkbox-group
															v-model="
                                                                $parent.filterOn
                                                            "
															class="mt-1"
														>
															<b-form-checkbox value="id">ID</b-form-checkbox>
															<b-form-checkbox value="nombre">Nombre</b-form-checkbox>
															<b-form-checkbox value="tipo">Tipo</b-form-checkbox>
															<b-form-checkbox value="marca">Marca</b-form-checkbox>
															<b-form-checkbox value="correo">Cantidad</b-form-checkbox>
														</b-form-checkbox-group>
													</b-form-group>
												</b-col>
												<b-col lg="4" align="right" class="mt-3">
													<b-button size="sm" @click="selectAllRows" variant="outline-dark">
														Seleccionar
														todo
													</b-button>
													<b-button size="sm" @click="clearSelected" variant="outline-dark">
														Borrar
														selección
													</b-button>
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
												:filterIncludedFields="
                                                    $parent.filterOn
                                                "
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
													{{ row.value.first }}
													{{
													row.value.last
													}}
												</template>

												<template v-slot:cell(actions)="row">
													<b-button
														size="sm"
														@click="
                                                            info(
                                                                row.item,
                                                                row.index,
                                                                $event.target
                                                            )
                                                        "
														class="mr-1"
														variant="outline-dark"
													>Info modal</b-button>

													<b-button
														size="sm"
														@click="
                                                            row.toggleDetails
                                                        "
														variant="outline-dark"
														class="mr-1"
													>
														{{
														row.detailsShowing
														? "Hide"
														: "Show"
														}}
														Details
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
															<li
																v-for="(value,
                                                                key) in row.item"
																:key="key"
															>
																{{ key }}:
																{{ value }}
															</li>
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
										></b-pagination>
									</b-col>

									<!-- Info modal -->
									<b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal">
										<pre>{{ infoModal.content }}</pre>
									</b-modal>
								</b-container>
							</b-tab>

							<b-tab title="Salidas" @click="tipoMovimiento('salida')">
								<b-container fluid class="mt-3">
									<!-- Main table element -->
									<div class="card">
										<div class="card-header">
											<div class="card-tools">
												<button class="btn btn-success" @click="chooseModal">
													Nueva salida
													<i class="fas fa-warehouse fa-fw"></i>
												</button>
											</div>

											<b-row class="mt-2">
												<b-col lg="8">
													<b-form-group
														description="Filtrado, deje sin seleccionar para buscar en todos los campos"
														class="mb-0"
													>
														<b-form-checkbox-group
															v-model="
                                                                $parent.filterOn
                                                            "
															class="mt-1"
														>
															<b-form-checkbox value="id">ID</b-form-checkbox>
															<b-form-checkbox value="tipo">Tipo</b-form-checkbox>
															<b-form-checkbox value="objeto">Objeto</b-form-checkbox>
															<b-form-checkbox value="marca">Marca</b-form-checkbox>
															<b-form-checkbox value="correo">Cantidad</b-form-checkbox>
														</b-form-checkbox-group>
													</b-form-group>
												</b-col>
												<b-col lg="4" align="right" class="mt-3">
													<b-button size="sm" @click="selectAllRows" variant="outline-dark">
														Seleccionar
														todo
													</b-button>
													<b-button size="sm" @click="clearSelected" variant="outline-dark">
														Borrar
														selección
													</b-button>
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
												:filterIncludedFields="
                                                    $parent.filterOn
                                                "
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
													{{ row.value.first }}
													{{
													row.value.last
													}}
												</template>

												<template v-slot:cell(actions)="row">
													<b-button
														size="sm"
														@click="
                                                            info(
                                                                row.item,
                                                                row.index,
                                                                $event.target
                                                            )
                                                        "
														class="mr-1"
														variant="outline-dark"
													>Info modal</b-button>

													<b-button
														size="sm"
														@click="
                                                            row.toggleDetails
                                                        "
														variant="outline-dark"
														class="mr-1"
													>
														{{
														row.detailsShowing
														? "Hide"
														: "Show"
														}}
														Details
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
															<li
																v-for="(value,
                                                                key) in row.item"
																:key="key"
															>
																{{ key }}:
																{{ value }}
															</li>
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
										></b-pagination>
									</b-col>

									<!-- Info modal -->
									<b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal">
										<pre>{{ infoModal.content }}</pre>
									</b-modal>
								</b-container>
							</b-tab>

							<b-tab title="Ajustes" @click="tipoMovimiento('ajuste')">
								<b-container fluid class="mt-3">
									<!-- Main table element -->
									<div class="card">
										<div class="card-header">
											<div class="card-tools">
												<button class="btn btn-success" @click="chooseModal">
													Nuevo ajuste
													<i class="fas fa-warehouse fa-fw"></i>
												</button>
											</div>

											<b-row class="mt-2">
												<b-col lg="8">
													<b-form-group
														description="Filtrado, deje sin seleccionar para buscar en todos los campos"
														class="mb-0"
													>
														<b-form-checkbox-group
															v-model="
                                                                $parent.filterOn
                                                            "
															class="mt-1"
														>
															<b-form-checkbox value="id">ID</b-form-checkbox>
															<b-form-checkbox value="nombre">Nombre</b-form-checkbox>
															<b-form-checkbox value="tipo">Tipo</b-form-checkbox>
															<b-form-checkbox value="marca">Marca</b-form-checkbox>
															<b-form-checkbox value="correo">Cantidad</b-form-checkbox>
														</b-form-checkbox-group>
													</b-form-group>
												</b-col>
												<b-col lg="4" align="right" class="mt-3">
													<b-button size="sm" @click="selectAllRows" variant="outline-dark">
														Seleccionar
														todo
													</b-button>
													<b-button size="sm" @click="clearSelected" variant="outline-dark">
														Borrar
														selección
													</b-button>
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
												:filterIncludedFields="
                                                    $parent.filterOn
                                                "
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
													{{ row.value.first }}
													{{
													row.value.last
													}}
												</template>

												<template v-slot:cell(actions)="row">
													<b-button
														size="sm"
														@click="
                                                            info(
                                                                row.item,
                                                                row.index,
                                                                $event.target
                                                            )
                                                        "
														class="mr-1"
														variant="outline-dark"
													>Info modal</b-button>

													<b-button
														size="sm"
														@click="
                                                            row.toggleDetails
                                                        "
														variant="outline-dark"
														class="mr-1"
													>
														{{
														row.detailsShowing
														? "Hide"
														: "Show"
														}}
														Details
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
															<li
																v-for="(value,
                                                                key) in row.item"
																:key="key"
															>
																{{ key }}:
																{{ value }}
															</li>
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
										></b-pagination>
									</b-col>

									<!-- Info modal -->
									<b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal">
										<pre>{{ infoModal.content }}</pre>
									</b-modal>
								</b-container>
							</b-tab>
						</b-tabs>
					</b-card>
				</div>

				<!-- Modal -->
				<div
					class="modal fade"
					id="chooseModal"
					tabindex="-1"
					role="dialog"
					aria-labelledby="chooseModal"
					aria-hidden="true"
				>
					<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header dark">
								<h5 v-if="movimiento === 'entrada'"     class="modal-title" id="chooseModal">Nueva entrada</h5>
								<h5 v-else-if="movimiento === 'salida'" class="modal-title" id="chooseModal">Nueva salida</h5>
								<h5 v-else-if="movimiento === 'ajuste'" class="modal-title" id="chooseModal">Nueva ajuste</h5>
								<button
									type="button"
									@click="reiniciarErrores"
									class="close white"
									data-dismiss="modal"
									aria-label="Close"
								>
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<validation-observer v-slot="{ passes }">
								<form @submit.prevent="passes( editmode ? updateMov() : createMov())" action method="post">
									<div class="modal-body">
										<div class="d-flex justify-content-center">
											<div class="col-sm-12 text-center">
												<!-- Primera fila -->
												<div class="form-row">
													<div class="form-group col-md-6">
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text rounded-left" for="tipo">
																	<i class="fas fa-copyright fa-sm mr-1"></i>Tipo
																</span>
															</div>
															<select class="custom-select rounded-right" id="tipo">
																<option value="1">...</option>
																<option value="2">Ford</option>
																<option value="3">Chevrolet</option>
															</select>
														</div>
													</div>
													<div class="form-group col-md-6">
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text rounded-left" for="objeto">
																	<i class="fas fa-snowplow fa-sm mr-1"></i>Objeto
																</span>
															</div>
															<select class="custom-select rounded-right" id="objeto">
																<option value="1">...</option>
																<option value="2"></option>
																<option value="3"></option>
															</select>
														</div>
													</div>
												</div>

												<!-- Segunda fila -->
												<div class="form-row">
													<div class="form-group col-md-6">
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text rounded-left" for="tipo">
																	<i class="fa fa-question fa-sm mr-1"></i>Motivo
																</span>
															</div>
															<select class="custom-select rounded-right" id="tipo">
																<option value="1">...</option>
																<option value="2">Ford</option>
																<option value="3">Chevrolet</option>
															</select>
														</div>
													</div>
													<div class="form-group col-md-6">
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<i class="fas fa-sort-numeric-up fa-sm mr-1"></i>Cantidad
																</span>
															</div>
															<input
																type="number"
																class="form-control rounded"
																id="fecha_ing"
																aria-label="fecha_ing"
															/>
														</div>
													</div>
												</div>

												<!-- Tercera fila -->
												<div class="form-row">
													<div class="form-group col-md-6">
														<validation-provider
															ref="errorObservacion1"
															rules="requerido"
															v-slot="{ errors }"
															name="observacion"
														>
															<div class="input-group">
																<div class="input-group-prepend">
																	<span class="input-group-text">
																		<i class="fa fa-book"></i>
																	</span>
																</div>
																<textarea
																	id="observacion"
																	class="form-control"
																	placeholder="Observación"
																	v-model="form.observacion"
																></textarea>
															</div>
															<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
														</validation-provider>
													</div>
													<div class="form-group col-md-6">
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<i class="fa fa-calendar-day fa-sm mr-1"></i>Fecha
																</span>
															</div>
															<input
																type="date"
																class="form-control rounded"
																id="fecha_ing"
																aria-label="fecha_ing"
															/>
														</div>
													</div>
												</div>

												<!-- Cuarta fila -->
												<div class="form-row">
													<div class="form-group col-md-12 d-flex flex-row">
														<button type="submit" class="btn btn-info">
															<i class="fas fa-shopping-cart"></i>
															Agregar
														</button>
													</div>
												</div>

												<!-- Quinta fila -->
												<div class="form-row">
													<div class="form-group col-md-12">
														<table class="table table-sm table-bordered table-striped table-hover">
															<thead>
																<tr>
																	<th>
																		Tipo
																		<i class="fa fa-caret-square-down btn d-inline pl-1"></i>
																	</th>
																	<th>
																		Objeto
																		<i class="fa fa-caret-square-down btn d-inline pl-1"></i>
																	</th>
																	<th>
																		Motivo
																		<i class="fa fa-caret-square-down btn d-inline pl-1"></i>
																	</th>
																	<th>
																		Cantidad
																		<i class="fa fa-caret-square-down btn d-inline pl-1"></i>
																	</th>
																	<th>
																		Fecha
																		<i class="fa fa-caret-square-down btn d-inline pl-1"></i>
																	</th>
																	<th>
																		Observación
																		<i class="fa fa-caret-square-down btn d-inline pl-1"></i>
																	</th>
																	<th>Modificar</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td>
																		<a href="#">
																			<i class="fa fa-edit blue"></i>
																		</a>

																		<a href="#">
																			<i class="fa fa-trash red"></i>
																		</a>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="modal-footer">
										<button v-show="!editmode" type="button" @click="reiniciarErrores" class="btn btn-danger">
											<i class="fas fa-broom"></i> Limpiar
										</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal">
											<i class="fas fa-save"></i>
											Finalizar
										</button>
									</div>
								</form>
							</validation-observer>
						</div>
					</div>
				</div>

				
			</div>
		</div>
	</div>
</template>

<script>
import {
	ValidationProvider,
	ValidationObserver,
	extend
} from "vee-validate";
export default {
	components: {
		ValidationProvider,
		ValidationObserver
	},
	data() {
		return {
			movimiento: 'entrada',
			form: new Form({
				observacion: "",
			}),
			items: [],
			fields: [
				{
					key: "id",
					label: "ID",
					sortable: true,
					sortDirection: "desc",
					class: "text-center"
				},
				{
					key: "nombre",
					label: "Nombre",
					sortable: true,
					class: "text-center"
				},
				{
					key: "tipo",
					label: "Tipo",
					sortable: true,
					class: "text-center"
				},
				{
					key: "marca",
					label: "Marca",
					sortable: true,
					class: "text-center"
				},
				{
					key: "Cantidad",
					label: "Cantidad",
					sortable: true,
					class: "text-center"
				},
				{ key: "actions", label: "Acciones", class: "text-center" }
			],
			totalRows: 1,
			currentPage: 1,
			perPage: 10,
			sortBy: "",
			sortDesc: false,
			sortDirection: "asc",
			filter: null,
			filterOn: [],
			infoModal: {
				id: "info-modal",
				title: "",
				content: ""
			},
			selectMode: "multi",
			selected: [],
			esa: [],
			entradas: [],
			salidas: [],
			ajustes: [],
			recursos: [],
			editmode: false,
		};
	},
	mounted() {
		console.log("Component mounted.");
		// Set the initial number of items
		this.totalRows = this.items.length;
	},
	methods: {
		errorRegla(editmode) {
			let regla = "";
			if (editmode) {
				regla = "requerido";
			} else {
				regla = "requerido|excluyeR";
			}
			return regla;
		},
		reiniciarErrores() {
			this.form.reset();
			this.form.clear();
			this.$refs.errorObservacion1.reset();
			// this.$refs.errorApellido1.reset();
			// this.$refs.errorAnte1.reset();
			// this.$refs.errorCedula1.reset();
			// this.$refs.errorEdoCivil.reset();
			// this.$refs.errorFechaNac.reset();
			// this.$refs.errorGenero.reset();
			// this.$refs.errorDireccion1.reset();
			// // this.$refs.errorTelefono1.reset()
			// // this.$refs.errorTelefono2.reset()
			// this.$refs.errorCorreo1.reset();
			// this.$refs.errorFechaIng.reset();
			// this.$refs.errorCargo.reset();
			// this.$refs.errorEspecialidad.reset();
			// this.$refs.errorRazonSoc.reset();
			// this.$refs.errorNombre2.reset();
			// this.$refs.errorApellido2.reset();
			// this.$refs.errorDireccion2.reset();
			// this.$refs.errorAnte2.reset();
			// this.$refs.errorCedula2.reset();
			// this.$refs.errorCorreo2.reset();
			// // this.$refs.errorTelefono3.reset()
			// // this.$refs.errorTelefono4.reset()
			// // this.$refs.errorDescripcion.reset()
		},
		updateMov() { this.reiniciarErrores() },

		createMov() { this.reiniciarErrores() },

		chooseModal() {
			$("#chooseModal").modal("show");
		},

		tipoMovimiento(x){
		  this.movimiento = x;
          this.loadAll();
		},

		onRowSelected(items) {
			this.selected = items;
		},

		selectAllRows() {
			this.$refs.selectableTable.selectAllRows();
		},
		
		clearSelected() {
			this.$refs.selectableTable.clearSelected();
		},

		info(item, index, button) {
			this.infoModal.title = `Row index: ${index}`;
			this.infoModal.content = JSON.stringify(item, null, 2);
			this.$root.$emit("bv::show::modal", this.infoModal.id, button);
		},

		resetInfoModal() {
			this.infoModal.title = "";
			this.infoModal.content = "";
		},

		onFiltered(filteredItems) {
			// Trigger pagination to update the number of buttons/pages due to filtering
			this.totalRows = filteredItems.length;
			this.currentPage = 1;
		},

		loadAll() {
			axios.get("api/movimiento").then(({ data }) => {
				this.esa = data.data;
				this.entradas = this.esa.filter(
					movimiento => movimiento.id_tipoMovimiento === 1
				);
				this.salidas = this.esa.filter(
					movimiento => movimiento.id_tipoMovimiento === 2
				);
				this.ajustes = this.esa.filter(
					movimiento => movimiento.id_tipoMovimiento === 3
				);
			});
		}
	},

	created() {
		this.loadAll();
		Fire.$on("AfterCreate", () => {
			this.loadAll();
		});
	}
};
</script>
