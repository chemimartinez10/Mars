<template>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card-body">
					<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
						<li class="nav-item">
							<a
								class="nav-link active"
								id="custom-content-below-home-tab"
								data-toggle="pill"
								href="#custom-content-below-home"
								role="tab"
								aria-controls="custom-content-below-home"
								aria-selected="true"
							>Empleados</a>
						</li>
						<li class="nav-item">
							<a
								class="nav-link"
								id="custom-content-below-profile-tab"
								data-toggle="pill"
								href="#custom-content-below-profile"
								role="tab"
								aria-controls="custom-content-below-profile"
								aria-selected="false"
							>Entes</a>
						</li>
					</ul>
					<div class="tab-content" id="custom-content-below-tabContent">
						<div
							class="tab-pane fade show active mt-3"
							id="custom-content-below-home"
							role="tabpanel"
							aria-labelledby="custom-content-below-home-tab"
						>
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Tabla de empleados</h3>

									<div class="card-tools">
										<button class="btn btn-success" @click="newModalEmple">
											Nuevo
											<i class="fas fa-user-plus fa-fw"></i>
										</button>
									</div>
								</div>
								<!-- /.card-header -->
								<div class="card-body table-responsive p-0">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>
													ID
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'empleado',
                                                                'id'
                                                            )
                                                        "
													></i>
												</th>
												<th>
													Nombre
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'empleado',
                                                                'nombre'
                                                            )
                                                        "
													></i>
												</th>
												<th>
													Cédula
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'empleado',
                                                                'identificacion'
                                                            )
                                                        "
													></i>
												</th>
												<th>
													Correo
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'empleado',
                                                                'correo'
                                                            )
                                                        "
													></i>
												</th>
												<th>
													Cargo
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'empleado',
                                                                'cargo'
                                                            )
                                                        "
													></i>
												</th>
												<th>
													Especialidad
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'empleado',
                                                                'especialidad'
                                                            )
                                                        "
													></i>
												</th>
												<th>
													Registrado
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'empleado',
                                                                'created_at'
                                                            )
                                                        "
													></i>
												</th>
												<th>
													Modificado
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'empleado',
                                                                'updated_at'
                                                            )
                                                        "
													></i>
												</th>
												<th>Modificar</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="emple in empleados" :key="emple.id">
												<td>{{ emple.persona_id }}</td>
												<td>
													{{ emple.nombre }}
													{{ emple.apellido }}
												</td>
												<td>{{ emple.identificacion }}</td>
												<td>{{ emple.correo }}</td>
												<td>{{ emple.cargo }}</td>
												<td>{{ emple.especialidad }}</td>
												<td>
													{{
													emple.created_at
													| myDate
													}}
												</td>
												<td>
													{{
													emple.updated_at
													| myDate
													}}
												</td>
												<td>
													<a
														href="#"
														@click="
                                                            editModalEmple(
                                                                emple
                                                            )
                                                        "
													>
														<i class="fa fa-edit blue"></i>
													</a>

													<a
														href="#"
														@click="
                                                            deletePersona(
                                                                emple.persona_id,
                                                                true
                                                            )
                                                        "
													>
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
						<div
							class="tab-pane fade show mt-3"
							id="custom-content-below-profile"
							role="tabpanel"
							aria-labelledby="custom-content-below-profile-tab"
						>
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Tabla de entidades</h3>

									<div class="card-tools">
										<button class="btn btn-success" @click="newModalEnte">
											Nuevo
											<i class="fas fa-city fa-fw"></i>
										</button>
									</div>
								</div>
								<!-- /.card-header -->
								<div class="card-body table-responsive p-0">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>
													ID
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'ente',
                                                                'id'
                                                            )
                                                        "
													></i>
												</th>
												<th>
													Razón Social
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'ente',
                                                                'razon_soc'
                                                            )
                                                        "
													></i>
												</th>
												<th>
													Descripcion
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'ente',
                                                                'descripcion'
                                                            )
                                                        "
													></i>
												</th>
												<th>
													RIF
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'ente',
                                                                'identificacion'
                                                            )
                                                        "
													></i>
												</th>
												<th>
													Contacto
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'ente',
                                                                'nombre'
                                                            )
                                                        "
													></i>
												</th>
												<th>
													Registrado
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'ente',
                                                                'created_at'
                                                            )
                                                        "
													></i>
												</th>
												<th>
													Modificado
													<i
														class="fa fa-caret-square-down btn d-inline pl-1"
														@click="
                                                            ordenarPor(
                                                                'ente',
                                                                'updated_at'
                                                            )
                                                        "
													></i>
												</th>
												<th>Modificar</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="ent in entes" :key="ent.id">
												<td>{{ ent.persona_id }}</td>
												<td>{{ ent.razon_soc }}</td>
												<td>{{ ent.descripcion }}</td>
												<td>{{ ent.identificacion }}</td>
												<td>
													{{ ent.nombre }}
													{{ ent.apellido }}
												</td>
												<td>
													{{
													ent.created_at | myDate
													}}
												</td>
												<td>
													{{
													ent.updated_at | myDate
													}}
												</td>
												<td>
													<a
														href="#"
														@click="
                                                            editModalEnte(ent)
                                                        "
													>
														<i class="fa fa-edit blue"></i>
													</a>

													<a
														href="#"
														@click="
                                                            deletePersona(
                                                                ent.persona_id,
                                                                false
                                                            )
                                                        "
													>
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
				</div>
			</div>
		</div>

		<!-- Modal Empleado-->
		<div
			class="modal fade"
			id="addNewEmple"
			tabindex="-1"
			role="dialog"
			aria-labelledby="addNewEmple"
			aria-hidden="true"
		>
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 v-show="!editmode" class="modal-title" id="addNewEmple">Agregar nuevo empleado</h5>
						<h5 v-show="editmode" class="modal-title" id="addNewEmple">Actualizar empleado</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span v-on:click="reiniciarErrores" aria-hidden="true">&times;</span>
						</button>
					</div>
					<validation-observer v-slot="{ passes }">
						<form
							@submit.prevent="
                                passes(
                                    editmode ? updatePersona() : createPers()
                                )
                            "
							class="form"
						>
							<div class="modal-body">
								<!-- Primera fila -->
								<div class="form-row">
									<div class="form-group col-md-12 form-row">
										<validation-provider
											class="col-md-6"
											ref="errorNombre1"
											rules="requerido"
											v-slot="{ errors }"
											name="nombre"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-user"></i>
													</span>
												</div>
												<input
													type="text"
													class="form-control"
													id="nombre"
													placeholder="Nombres"
													aria-label="nombres"
													v-model="form.nombre"
												/>
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>

										<validation-provider
											class="col-md-6"
											ref="errorApellido1"
											rules="requerido"
											v-slot="{ errors }"
											name="apellido"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-user"></i>
													</span>
												</div>

												<input
													type="text"
													class="form-control"
													id="apellido"
													placeholder="Apellidos"
													aria-label="apellidos"
													v-model="form.apellido"
												/>
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>
									</div>
								</div>
								<!-- Segunda fila -->
								<div class="form-row">
									<div class="form-group col-md-6 form-row">
										<validation-provider
											class="col-4"
											ref="errorAnte1"
											rules="requerido"
											v-slot="{ errors }"
											name=" "
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-id-card"></i>
													</span>
												</div>
												<div class="input-group-append">
													<select class="custom-select rounded-left" id="tipocedula" v-model="form.ante">
														<option value="V" selected>V</option>
														<option value="E">E</option>
													</select>
												</div>
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>
										<validation-provider
											class="col-8"
											ref="errorCedula1"
											rules="requerido"
											v-slot="{ errors }"
											name="cedula"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-id-card"></i>
													</span>
												</div>
												<input
													type="text"
													class="form-control rounded-right field"
													field="cedula"
													name="cedula"
													id="cedula"
													placeholder="C.I."
													aria-label="cedula"
													v-model="form.cedula"
												/>
												<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
											</div>
										</validation-provider>
									</div>

									<div class="form-group col-md-6">
										<validation-provider
											ref="errorEdoCivil"
											rules="requerido"
											v-slot="{ errors }"
											name="estado civil"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text rounded-left" for="cargo">
														<i class="fa fa-heart fa-sm mr-1"></i>Estado civil
													</span>
												</div>
												<select class="custom-select rounded-right" id="cargo" v-model="form.edo_civil">
													<option value="1">Soltero/a</option>
													<option value="2">Casado/a</option>
													<option value="3">Divorciado/a</option>
													<option value="4">Viudo/a</option>
												</select>
												<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
											</div>
										</validation-provider>
									</div>
								</div>
								<!-- Tercera fila -->
								<div class="form-row">
									<div class="form-group col-md-6">
										<validation-provider
											ref="errorFechaNac"
											rules="requerido"
											v-slot="{ errors }"
											name="fecha de nacimiento"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-birthday-cake fa-sm mr-1"></i>Fecha de nacimiento
													</span>
												</div>
												<input
													type="date"
													class="form-control rounded"
													id="fecha_nac"
													aria-label="fecha_na"
													v-model="form.fecha_nac"
												/>
												<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
											</div>
										</validation-provider>
									</div>

									<div class="form-group col-md-6">
										<validation-provider
											ref="errorGenero"
											rules="requerido"
											v-slot="{ errors }"
											name="género"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text rounded">
														<i class="fa fa-venus-mars fa-sm mr-1"></i>Género
													</span>
												</div>
												<div class="form-check my-2 ml-4">
													<input
														class="form-check-input"
														type="radio"
														name="radio"
														id="masculino"
														value="1"
														checked
														v-model="form.genero"
													/>
													<label class="form-check-label" for="masculino">
														<i class="fa fa-male fa-lg"></i>
														Masculino
													</label>
												</div>
												<div class="form-check my-2 ml-3">
													<input
														class="form-check-input"
														type="radio"
														name="radio"
														id="femenino"
														value="2"
														v-model="form.genero"
													/>
													<label class="form-check-label" for="femenino">
														<i class="fa fa-female fa-lg"></i>
														Femenino
													</label>
												</div>
												<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
											</div>
										</validation-provider>
									</div>
								</div>
								<!-- Cuarta fila -->
								<div class="form-row">
									<div class="form-group col-md-6">
										<validation-provider
											ref="errorDireccion1"
											rules="requerido"
											v-slot="{ errors }"
											name="dirección"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-map-marker-alt"></i>
													</span>
												</div>
												<input
													type="text"
													class="form-control rounded"
													placeholder="Dirección"
													id="direccion"
													name="direccion"
													aria-label="direccion"
													v-model="form.direccion"
													field="direccion"
												/>
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>
									</div>
									<div class="form-group col-md-6 form-row">
										<div class="col-6">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-phone fa-sm mr-1"></i>
													</span>
												</div>
												<input
													type="text"
													aria-label="Casa"
													class="form-control"
													placeholder="Casa"
													v-model="form.telefono1"
												/>
											</div>
										</div>
										<div class="col-6">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-phone fa-sm mr-1"></i>
													</span>
												</div>
												<input
													type="text"
													aria-label="Móvil"
													class="form-control"
													placeholder="Móvil"
													v-model="form.telefono2"
												/>
											</div>
										</div>
									</div>
								</div>
								<!--Quinta fila -->
								<div class="form-row">
									<div class="form-group col-md-6">
										<validation-provider
											ref="errorCorreo1"
											v-bind:rules="
                                                errorRegla('correo', editmode)
                                            "
											v-slot="{ errors }"
											name="correo electrónico"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-envelope"></i>
													</span>
												</div>
												<input
													type="text"
													class="form-control rounded"
													id="correo"
													placeholder="Correo electrónico"
													aria-label="correo"
													v-model="form.correo"
												/>
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>
									</div>

									<div class="form-group col-md-6">
										<validation-provider
											ref="errorFechaIng"
											rules="requerido"
											v-slot="{ errors }"
											name="fecha de ingreso"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-calendar-day fa-sm mr-1"></i>Fecha de ingreso
													</span>
												</div>
												<input
													type="date"
													class="form-control rounded"
													id="fecha_ing"
													aria-label="fecha_ing"
													v-model="form.fecha_ing"
												/>
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>
									</div>
								</div>
								<!-- Sexta fila -->
								<div class="form-row">
									<div class="form-group col-md-6">
										<validation-provider ref="errorCargo" rules="requerido" v-slot="{ errors }" name="cargo">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text rounded-left" for="cargo">
														<i class="fa fa-user-tie fa-sm mr-1"></i>Cargo
													</span>
												</div>
												<select class="custom-select rounded-right" id="cargo" v-model="form.cargo">
													<option value="1">Gerente</option>
													<option value="2">Supervisor</option>
													<option value="3">Obrero</option>
												</select>
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>
									</div>

									<div class="form-group col-md-6">
										<validation-provider
											ref="errorEspecialidad"
											rules="requerido"
											v-slot="{ errors }"
											name="especialidad"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text rounded-left" for="especialidad">
														<i class="fa fa-user-graduate fa-sm mr-1"></i>Especialidad
													</span>
												</div>
												<select
													class="custom-select rounded-right"
													id="especialidad"
													v-model="form.especialidad"
												>
													<option value="1">Gerencia</option>
													<option value="2">Electricidad</option>
													<option value="3">Mecánica</option>
												</select>
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button v-show="!editmode" type="button" @click="reiniciarErrores" class="btn btn-danger">
									<i class="fas fa-broom"></i> Limpiar
								</button>
								<button v-show="editmode" type="submit" class="btn btn-success">
									<i class="fas fa-save"></i> Actualizar
								</button>
								<button v-show="!editmode" type="submit" class="btn btn-primary">
									<i class="fas fa-save"></i> Guardar
								</button>
							</div>
						</form>
					</validation-observer>
				</div>
			</div>
		</div>
		<!-- Modal Ente-->
		<div
			class="modal fade"
			id="addNewEnte"
			tabindex="-1"
			role="dialog"
			aria-labelledby="addNewEnte"
			aria-hidden="true"
		>
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 v-show="!editmode" class="modal-title" id="addNewEnte">Agregar nuevo ente</h5>
						<h5 v-show="editmode" class="modal-title" id="addNewEnte">Actualizar ente</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span v-on:click="reiniciarErrores" aria-hidden="true">&times;</span>
						</button>
					</div>

					<validation-observer v-slot="{ passes }">
						<form
							@submit.prevent="
                                passes(
                                    editmode ? updatePersona() : createPers()
                                )
                            "
						>
							<div class="modal-body">
								<!-- Primera fila -->
								<div class="form-row">
									<div class="form-group col-md-6">
										<validation-provider
											ref="errorRazonSoc"
											v-bind:rules="
                                                errorRegla(
                                                    'razonsocial',
                                                    editmode
                                                )
                                            "
											v-slot="{ errors }"
											name="razón social"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fas fa-city"></i>
													</span>
												</div>
												<input
													type="text"
													name="razon_soc"
													id="razon_soc"
													v-model="form.razon_soc"
													class="form-control"
													placeholder="Razón Social"
													aria-label="razon_soc"
												/>
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>
									</div>
									<div class="form-group col-md-6 form-row">
										<validation-provider
											class="col-6"
											ref="errorNombre2"
											rules="requerido"
											v-slot="{ errors }"
											name="nombre"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-user-tie fa-sm mr-1"></i>
													</span>
												</div>
												<input type="text" class="form-control" placeholder="Nombres" v-model="form.nombre" />
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>
										<validation-provider
											class="col-6"
											ref="errorApellido2"
											rules="requerido"
											v-slot="{ errors }"
											name="apellido"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-user-tie fa-sm mr-1"></i>
													</span>
												</div>
												<input type="text" class="form-control" placeholder="Apellidos" v-model="form.apellido" />
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>
									</div>
								</div>

								<!-- Segunda fila -->
								<div class="form-row">
									<div class="form-group col-md-6">
										<validation-provider
											ref="errorDireccion2"
											rules="requerido"
											v-slot="{ errors }"
											name="direccion"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-map-marker-alt"></i>
													</span>
												</div>
												<input
													type="text"
													class="form-control rounded"
													placeholder="Dirección"
													id="direccion"
													name="direccion"
													aria-label="direccion"
													v-model="form.direccion"
												/>
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>
									</div>
									<div class="form-group col-md-6 form-row">
										<validation-provider
											class="col-4"
											ref="errorAnte2"
											rules="requerido"
											v-slot="{ errors }"
											name=" "
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-id-card"></i>
													</span>
												</div>
												<div class="input-group-append">
													<select class="custom-select rounded-left" id="ID" v-model="form.ante">
														<option value="J">J</option>
														<option value="G">G</option>
														<option value="R">R</option>
													</select>
												</div>
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>
										<validation-provider
											class="col-8"
											ref="errorCedula2"
											rules="requerido"
											v-slot="{ errors }"
											name="cédula"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-id-card"></i>
													</span>
												</div>
												<input
													type="text"
													class="form-control rounded-right"
													id="cedula"
													placeholder="I.D."
													aria-label="ID"
													v-model="form.cedula"
												/>
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>
									</div>
								</div>

								<!-- Tercera fila -->
								<div class="form-row">
									<div class="form-group col-md-6">
										<validation-provider
											ref="errorCorreo2"
											v-bind:rules="
                                                errorRegla('correo', editmode)
                                            "
											v-slot="{ errors }"
											name="correo"
										>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-envelope"></i>
													</span>
												</div>
												<input
													type="text"
													class="form-control rounded"
													id="correo"
													placeholder="Correo electrónico"
													aria-label="correo"
													v-model="form.correo"
												/>
											</div>
											<div v-show="errors[0]" class="alert alert-danger" role="alert">{{ errors[0] }}</div>
										</validation-provider>
									</div>
									<div class="form-group col-md-6 form-row">
										<div class="col-6">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-phone fa-sm mr-1"></i>
													</span>
												</div>
												<input
													type="text"
													aria-label="Local"
													class="form-control"
													placeholder="Local"
													v-model="form.telefono1"
												/>
											</div>
										</div>
										<div class="col-6">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-phone fa-sm mr-1"></i>
													</span>
												</div>
												<input
													type="text"
													aria-label="Móvil"
													class="form-control"
													placeholder="Móvil"
													v-model="form.telefono2"
												/>
											</div>
										</div>
									</div>
								</div>

								<!-- Cuarta fila -->
								<div class="form-row justify-content-center">
									<div class="form-group col-md-12">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fas fa-book"></i>
												</span>
											</div>
											<textarea class="form-control" placeholder="Descripción" v-model="form.descripcion"></textarea>
										</div>
									</div>
								</div>
							</div>

							<div class="modal-footer">
								<button v-show="!editmode" type="button" @click="reiniciarErrores" class="btn btn-danger">
									<i class="fas fa-broom"></i> Limpiar
								</button>
								<button v-show="editmode" type="submit" class="btn btn-success">
									<i class="fas fa-save"></i> Actualizar
								</button>
								<button v-show="!editmode" type="submit" class="btn btn-primary">
									<i class="fas fa-save"></i> Guardar
								</button>
							</div>
						</form>
					</validation-observer>
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
			editmode: false,
			empleado: false,
			personas: {},
			empleados: {},
			entes: {},
			correos: [],
			razones: [],
			form: new Form({
				id_persona: "",
				id: "",
				nombre: "",
				apellido: "",
				genero: "",
				edo_civil: "",
				fecha_nac: "",
				fecha_ing: "",
				correo: "",
				telefono1: "",
				telefono2: "",
				telefono: "",
				direccion: "",
				cargo: "",
				especialidad: "",
				ante: "",
				cedula: "",
				identificacion: "",
				representante: "",
				razon_soc: "",
				descripcion: ""
			}),
			ordenamiento: false
			//    cedulaValida:''
		};
	},
	methods: {
		ordenarPor(table, prop) {
			if (table === "empleado") {
				if (this.ordenamiento)
					this.empleados.sort((a, b) => (a[prop] < b[prop] ? -1 : 1));
				else
					this.empleados.sort((a, b) => (a[prop] > b[prop] ? -1 : 1));
			} else {
				if (this.ordenamiento)
					this.entes.sort((a, b) => (a[prop] < b[prop] ? -1 : 1));
				else this.entes.sort((a, b) => (a[prop] > b[prop] ? -1 : 1));
			}
			this.ordenamiento = !this.ordenamiento;
		},
		errorRegla(campo, editmode) {
			let regla = "";
			if (campo === "correo") {
				if (editmode) {
					regla = "requerido|correo";
				} else {
					regla = "requerido|correo|excluyeC";
				}
			} else {
				if (editmode) {
					regla = "requerido";
				} else {
					regla = "requerido|excluyeR";
				}
			}
			return regla;
		},
		reiniciarErrores() {
			this.form.reset();
			this.form.clear();
			this.$refs.errorNombre1.reset();
			this.$refs.errorApellido1.reset();
			this.$refs.errorAnte1.reset();
			this.$refs.errorCedula1.reset();
			this.$refs.errorEdoCivil.reset();
			this.$refs.errorFechaNac.reset();
			this.$refs.errorGenero.reset();
			this.$refs.errorDireccion1.reset();
			// this.$refs.errorTelefono1.reset()
			// this.$refs.errorTelefono2.reset()
			this.$refs.errorCorreo1.reset();
			this.$refs.errorFechaIng.reset();
			this.$refs.errorCargo.reset();
			this.$refs.errorEspecialidad.reset();
			this.$refs.errorRazonSoc.reset();
			this.$refs.errorNombre2.reset();
			this.$refs.errorApellido2.reset();
			this.$refs.errorDireccion2.reset();
			this.$refs.errorAnte2.reset();
			this.$refs.errorCedula2.reset();
			this.$refs.errorCorreo2.reset();
			// this.$refs.errorTelefono3.reset()
			// this.$refs.errorTelefono4.reset()
			// this.$refs.errorDescripcion.reset()
		},
		editModalEmple(persona) {
			this.editmode = true;
			this.form.reset();
			this.form.clear();
			$("#addNewEmple").modal("show");
			this.empleado = true;
			this.form.fill(persona);
			this.form.ante = persona.identificacion.charAt(0);
			this.form.cedula = persona.identificacion.slice(1);
			this.form.telefono1 = persona.telefono.slice(
				0,
				persona.telefono.indexOf("/") - 1
			);
			this.form.telefono2 = persona.telefono.slice(
				persona.telefono.indexOf("/") + 2
			);
			this.form.id_persona = persona.persona_id;
		},
		editModalEnte(persona) {
			this.editmode = true;
			this.form.reset();
			this.form.clear();
			$("#addNewEnte").modal("show");
			this.empleado = false;
			this.form.fill(persona);
			this.form.ante = persona.identificacion.charAt(0);
			this.form.cedula = persona.identificacion.slice(1);
			this.form.telefono1 = persona.telefono.slice(
				0,
				persona.telefono.indexOf("/") - 1
			);
			this.form.telefono2 = persona.telefono.slice(
				persona.telefono.indexOf("/") + 2
			);
			this.form.id_persona = persona.persona_id;
		},
		newModalEmple() {
			$("#chooseNew").modal("hide");
			this.empleado = true;
			this.editmode = false;
			this.form.reset();
			this.form.clear();
			$("#addNewEmple").modal("show");
		},
		newModalEnte() {
			$("#chooseNew").modal("hide");
			this.empleado = false;
			this.editmode = false;
			this.form.reset();
			this.form.clear();
			$("#addNewEnte").modal("show");
		},

		loadAll() {
			axios
				.get("api/empleado")
				.then(({ data }) => (this.empleados = data.data));
			axios.get("api/ente").then(({ data }) => {
				this.entes = data.data;
				for (var i = 0; i < this.entes.length; i++) {
					this.razones[i] = this.entes[i].razon_soc;
				}
				Fuego.$emit("razones", this.razones);
			});
			axios.get("api/persona").then(({ data }) => {
				this.personas = data.data;
				for (var i = 0; i < this.personas.length; i++) {
					this.correos[i] = this.personas[i].correo;
				}
				Fuego.$emit("correos", this.correos);
				console.log(this.personas);
			});
		},
		createPers() {
			// this.$validator.validateAll()
			this.$Progress.start();
			this.form.identificacion = this.form.ante + this.form.cedula;
			this.form.telefono =
				this.form.telefono1 + " / " + this.form.telefono2;
			this.form
				.post("api/persona")
				.then(() => {
					if (this.empleado === true) {
						this.form.post("api/empleado").catch(() => {
							this.$Progress.fail();
						});
					} else {
						this.form.post("api/ente").catch(() => {
							this.$Progress.fail();
						});
					}
					Fire.$emit("AfterCreate");
					$("#addNewEmple").modal("hide");

					if (this.empleado === true) {
						Toast.fire({
							type: "success",
							title: "Empleado registrado éxitosamente"
						});
					} else {
						Toast.fire({
							type: "success",
							title: "Ente registrado éxitosamente"
						});
					}

					$("#addNewEnte").modal("hide");
					this.$Progress.finish();
					this.loadAll();
					this.reiniciarErrores();
				})
				.catch(() => {
					this.$Progress.fail();
				});
		},
		updatePersona() {
			this.$Progress.start();
			this.form.identificacion = this.form.ante + this.form.cedula;
			this.form.telefono =
				this.form.telefono1 + " / " + this.form.telefono2;
			this.form
				.put("api/persona/" + this.form.id_persona)
				.then(() => {
					if (this.empleado === true) {
						this.form
							.put("api/empleado/" + this.form.id)
							.catch(() => {
								this.$Progress.fail();
							});
					} else {
						this.form.put("api/ente/" + this.form.id).catch(() => {
							this.$Progress.fail();
						});
					}
					$("#addNewEmple").modal("hide");
					$("#addNewEnte").modal("hide");

					if (this.empleado === true) {
						Swal.fire(
							"¡Actualizado!",
							"El empleado ha sido actualizado",
							"success"
						);
					} else {
						Swal.fire(
							"¡Actualizado!",
							"El ente ha sido actualizado",
							"success"
						);
					}
					this.$Progress.finish();
					this.loadAll();
					this.reiniciarErrores();
				})
				.catch(() => {
					this.$Progress.fail();
				});
		},

		deletePersona(id, empleado) {
			Swal.fire({
				title: "¿Está seguro?",
				text: "¡No podrá revertir los cambios!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "¡Sí, eliminar!"
			}).then(result => {
				//Enviar solicitud para borrar al servidor
				if (result.value) {
					this.form
						.delete("api/persona/" + id)
						.then(() => {
							if (empleado) {
								Swal.fire(
									"¡Eliminado!",
									"El Empleado ha sido eliminado",
									"success"
								);
							} else {
								Swal.fire(
									"¡Eliminado!",
									"El Ente ha sido eliminado",
									"success"
								);
							}

							this.loadAll();
						})
						.catch(() => {
							Swal.fire({
								type: "error",
								title: "Oops...",
								text: "Something went wrong!"
							});
						});
				}
			});
		}
	},
	created() {
		this.loadAll();
		Fire.$on("buscando", () => {
			if (window.location.pathname === "/personal") {
				this.$Progress.start();
				if (this.$parent.busqueda) {
					let query = this.$parent.busqueda;
					axios
						.get("api/findEmple?q=" + query)
						.then(({ data }) => (this.empleados = data.data))
						.catch(() => {
							this.$Progress.fail();
						});
					axios
						.get("api/findEnte?q=" + query)
						.then(({ data }) => (this.entes = data.data))
						.catch(() => {
							this.$Progress.fail();
						});
				} else {
					this.loadAll();
				}
				this.$Progress.finish();
			}
		});
		Fire.$on("AfterCreate", () => {
			this.loadAll();
		});
	}
};
</script>
