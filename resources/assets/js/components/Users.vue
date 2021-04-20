<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Usuarios</h3>

                        <div class="card-tools">
                             <button class="btn btn-success" @click="newModal">Agregar Usuario <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        Tipo
                        <select name="type" v-model="filtro_tipo" id="type" class="form-control">
                            <option value="">Filtrar rol de usuario</option>
                            <option value="admin">Administrador</option>
                            <option value="user">Estudiante</option>
                            <option value="author">Tutor</option>
                        </select>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
																		<th>Rol Usuario</th>
                                    <th>Registrado el</th>
                                    <th>Modificado el</th>
                                </tr>
                                <tr v-for="user in users.data" :key="user.id">
                                    <td>{{user.id}}</td>
                                    <td>{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td v-if="user.type == 'admin'" >Administrador</td>
                                    <td v-if="user.type == 'user'" >Estudiante</td>
                                    <td v-if="user.type == 'author'" >Tutor</td>
																		<td v-if="user.type == ''" ></td>
                                    <td>{{user.created_at | myDate}}</td>

                                    <td>
                                        <a href="#" @click="editModal(user)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteUser(user.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                        <a href="#" @click="modalInscripcion(user.id)" class="btn btn-warning">
                                            Inscribir
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="users" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            <!-- /.card -->
            </div>
        </div>

        <div v-if="!$gate.isAdminOrAuthor()">
            <not-found></not-found>
        </div>

    <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
										<h5 class="modal-title" v-show="!editmode" id="addNewLabel">Agregar Usuario</h5>
										<h5 class="modal-title" v-show="editmode" id="addNewLabel">Actualizar Usuario</h5>
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
                            <label for="tipo_id"> Tipo de documento
                              <select id="tipo_id" class="custom-select " v-model="form.tipo_id" :class="{ 'is-invalid': form.errors.has('tipo_id') }">
                                <option value="" disabled>--Seleccionar--</option>
                                <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                                <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
                                <option value="Cédula de extranjería">Cédula de extranjería</option>
                                <option value="Pasaporte">Pasaporte</option>
                              </select>
                            </label>
                            <has-error :form="form" field="tipo_id"></has-error>
                          </div>
                           <div class="form-group">
                              <input v-model="form.documento" type="text" documento="documento"
                                  placeholder="Nro. Documento"
                                  class="form-control" :class="{ 'is-invalid': form.errors.has('documento') }">
                              <has-error :form="form" field="documento"></has-error>
                          </div>

                           <div class="form-group">
                              <input v-model="form.lugar_expe" type="text" lugar_expe="lugar_expe"
                                  placeholder="Lugar de expedición"
                                  class="form-control" :class="{ 'is-invalid': form.errors.has('lugar_expe') }">
                              <has-error :form="form" field="lugar_expe"></has-error>
                          </div>

                          <div class="form-group">
														<input v-model="form.email" type="email" name="email"
																placeholder="Correo"
																class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
														<has-error :form="form" field="email"></has-error>
                          </div>

                          <div class="form-group">
														<textarea v-model="form.bio" name="bio" id="bio"
                              placeholder="Informacón (Opcional)"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
														</textarea>
														<has-error :form="form" field="bio"></has-error>
                          </div>
                          
                          <div class="form-group">
                              <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                  <option value="">Selecione el rol de usuario</option>
                                  <option value="admin">Administrador</option>
                                  <option value="user">Estudiante</option>
                                  <option value="author">Tutor</option>
                              </select>
                              <has-error :form="form" field="type"></has-error>
                          </div>

                          <div class="form-group">
                              <label for='password'>Clave</label>
                              <input v-model="form.password" type="password" name="password" id="password"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                              <has-error :form="form" field="password"></has-error>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          <button v-show="editmode" type="submit" class="btn btn-success">Actualizar</button>
                          <button v-show="!editmode" type="submit" class="btn btn-primary">Crear</button>
                      </div>
                  </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="inscriptionModal" tabindex="-1" role="dialog" aria-labelledby="inscriptionModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="inscriptionModalLabel">Registrar inscripción </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
							<form @submit.prevent="crearInscripcion()">
              	<div class="modal-body">
									<div class="form-group">
										<label for="curso">Curso
											<select class="form-control" id="curso" v-model="formInscripcion.id_curso" >
												<option disabled>-Seleccionar</option>
												<option v-for="curso in listadoCursos" :key="curso.id" :value="curso.id">
													<span class="d-inline-block text-truncate" style="max-width: 150px;"> {{ curso.nombre }}</span>
												</option>
											</select>
										</label>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="resultado">Puntaje
												<input type="number" class="form-control" id="resultado" placeholder="Puntaje" v-model="formInscripcion.resultado">
											</label>
										</div>
										<div class="form-group col-md-6">
											<label for="fecha_activacion">Fecha Activación
												<input type="date" class="form-control" id="fecha_activacion" placeholder="Fecha Activación" v-model="formInscripcion.fec_activa">
											</label>
										</div>
										<div class="form-group col-md-6">
											<label for="fecha_termina">Fecha Termina
												<input type="date" class="form-control" id="fecha_termina" placeholder="Fecha Termina" v-model="formInscripcion.fec_termina">
											</label>
										</div>
										<div class="form-group col-md-6">
											<label for="fecha_vence">Fecha Vencimiento
												<input type="date" class="form-control" id="fecha_vence" placeholder="Fecha Vencimiento" v-model="formInscripcion.fec_vence">
											</label>
										</div>
										<div class="form-row col-md-6">
											<label for="duracion_nro" class="col-6">Duración
												<input type="number" step="any" class="form-control" id="duracion_nro" placeholder="Duración" v-model="formInscripcion.duracion_nro">
											</label>
											<label for="duracion_tipo" class="col-6">En: 
												<select class="form-control" id="duracion_tipo" v-model="formInscripcion.duracion_tipo">
													<option disabled>--Seleccionar--</option>
													<option value="horas" selected>Horas</option>
													<option value="dias">Días</option>
													<option value="semanas">Semanas</option>
													<option value="meses">Meses</option>
												</select>
											</label>
                  	</div>
                	</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
									<button type="submit" class="btn btn-success">Registrar</button>
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
        editmode: false,
        users : {},
        filtro_tipo: '',
        form: new Form({
          id:'',
          name : '',
          email: '',
          password: '',
          type: '',
          bio: '',
          photo: '',
          tipo_id : '',
          documento : '', 
          lugar_expe : '',
        }),

        //inscripción
				formInscripcion: new Form ({
					id_alumno : 0,
					id_curso : 0,
					resultado : 0,
					fec_activa : 0,
					fec_termina : 0, 
					fec_vence : '',
					duracion_nro : 0,
					duracion_tipo : 0, 
				}),
        listadoCursos : []

      }
    },
    methods: {
        getResults(page = 1) {
            axios.get(this.$parent.ruta + 'api/user?page=' + page)
            .then(response => {
                this.users = response.data;
            });
        },
        updateUser(){
          this.$Progress.start();
          this.form.put(this.$parent.ruta + 'api/user/'+this.form.id)
          .then(() => {
            // success
            $('#addNew').modal('hide');
            swal(
              'Actualizado!',
              'La información ha sido actualizada',
              'success'
            )
            this.$Progress.finish();
            Fire.$emit('AfterCreate');
          })
          .catch(() => {
              this.$Progress.fail();
          });
        },
        editModal(user){
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(user);
        },
        newModal(){
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
        },
        deleteUser(id){
          swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {

            // Send request to the server
            if (result.value) {
            this.form.delete(this.$parent.ruta + 'api/user/'+id).then(()=>{
              swal(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              Fire.$emit('AfterCreate');
            }).catch(()=> {
              swal("Failed!", "There was something wronge.", "warning");
            });
            }
          })
        },
        loadUsers(){
          if(this.$gate.isAdminOrAuthor()){
            axios.get(this.$parent.ruta + "api/user").then(({ data }) => (this.users = data));
          }
        },
        createUser(){
          this.$Progress.start();
          this.form.post(this.$parent.ruta + 'api/user')
          .then(()=>{
            Fire.$emit('AfterCreate');
            $('#addNew').modal('hide')

            toast({
              type: 'success',
              title: 'User Created in successfully'
              })
            this.$Progress.finish();
          })
          .catch(() => {})
        },
        getCourses () {
          axios.get(this.$parent.ruta + 'api/listaCursos')
            .then(response => {
                this.listadoCursos = response.data;
            });
        },
        modalInscripcion(id_estudiante){
					console.log(id_estudiante);
          this.getCourses();
          $('#inscriptionModal').modal('show');
					this.formInscripcion.id_alumno = id_estudiante;
        },
				crearInscripcion () {
					this.$Progress.start();
          this.formInscripcion.post(this.$parent.ruta + 'api/crearInscripcion')
          .then(()=>{
            Fire.$emit('AfterCreate');
            $('#addNew').modal('hide')

            toast({
              type: 'success',
              title: 'User Created in successfully'
              })
            this.$Progress.finish();
          })
          .catch(() => {})
				}
    },
    created() {
      Fire.$on('searching',() => {
        let query = this.$parent.search;
        axios.get(this.$parent.ruta + 'api/findUser?q=' + query)
        .then((data) => {
          this.users = data.data
        })
        .catch(() => {})
      })
      this.loadUsers();
      Fire.$on('AfterCreate',() => {
        this.loadUsers();
      });
    }
  }
</script>
