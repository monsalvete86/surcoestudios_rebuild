<template>
	<div class="container">
			<div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
					<div class="col-md-12">
							<div class="card">
									<div class="card-header">
											<h3 class="card-title">Empresas</h3>

											<div class="card-tools">
														<button class="btn btn-success" @click="newModal">Empresa <i class="fas fa-empresa-plus fa-fw"></i></button>
											</div>
									</div>
									<!-- /.card-header -->
									<div class="card-body">
											Tipo
									</div>
									<div class="card-body table-responsive p-0">
											<table class="table table-hover">
													<thead>
														<tr>
																<th>ID</th>
																<th>Empresa</th>
																<th>NIT</th>
																<th>Registrado el</th>
																<th>Modificado el</th>
																<th></th>
														</tr>
													</thead>
													<tbody v-if="empresas.total>0">
														<tr v-for="empresa in empresas.data" :key="empresa.id">
																<td>{{empresa.id}}</td>
																
																<td>{{empresa.empresa}}</td>
																<td>{{empresa.nit}}</td>
																
																<td>{{empresa.created_at | myDate}}</td>
																<td>{{empresa.update_at | myDate}}</td>
																<td>
																		<a href="#" @click="editModal(empresa)">
																				<i class="fa fa-edit blue"></i>
																		</a>
																		/
																		<a href="#" @click="deleteEmpresa(empresa.id)">
																				<i class="fa fa-trash red"></i>
																		</a>

																</td>
														</tr>
													</tbody>
													<tbody v-else>
														<tr>
															<td colspan="5">
																No se han registrado datos
															</td>	
														</tr>
													</tbody>
											</table>
									</div>
									<!-- /.card-body -->
									<div class="card-footer">
											<pagination :data="empresas" @pagination-change-page="getResults"></pagination>
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
											<h5 class="modal-title" v-show="!editmode" id="addNewLabel">Agregar Empresa</h5>
											<h5 class="modal-title" v-show="editmode" id="addNewLabel">Actualizar Empresa</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
									</div>
									<form @submit.prevent="editmode ? updateEmpresa() : createEmpresa()">
											<div class="modal-body">
													<div class="form-group">
															<input v-model="form.empresa" type="text" name="empresa"
																	placeholder="Nombre"
																	class="form-control" :class="{ 'is-invalid': form.errors.has('empresa') }">
															<has-error :form="form" field="empresa"></has-error>
													</div>

													<div class="form-group">
															<input v-model="form.nit" type="nit" name="nit"
																	placeholder="Correo"
																	class="form-control" :class="{ 'is-invalid': form.errors.has('nit') }">
															<has-error :form="form" field="nit"></has-error>
													</div>

													<div class="form-group">
															<select name="estado" v-model="form.estado" id="estado" class="form-control" :class="{ 'is-invalid': form.errors.has('estado') }">
																	<option value="">Selecione el estado</option>
																	<option value="0">Activo</option>
																	<option value="1">Inactivo</option>
															</select>
															<has-error :form="form" field="type"></has-error>
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
	</div>
</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                empresas : {},
                form: new Form({
									id:'',
									empresa : '',
									nit: '',
									estado: '',
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get(this.$parent.ruta + 'api/empresa?page=' + page)
                .then(response => {
                    this.empresas = response.data;
                });
            },
            updateEmpresa(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put(this.$parent.ruta + 'api/empresa/'+this.form.id)
                .then(() => {
                    // success
                    $('#addNew').modal('hide');
                     swal(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                        )
                        this.$Progress.finish();
                         Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
            editModal(empresa){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(empresa);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteEmpresa(id){
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
                                this.form.delete(this.$parent.ruta + 'api/empresa/'+id).then(()=>{
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
            loadEmpresas(){
                if(this.$gate.isAdminOrAuthor()){
                    axios.get(this.$parent.ruta + "api/empresa").then(({ data }) => (this.empresas = data));
                }
            },

            createEmpresa(){
                this.$Progress.start();

                this.form.post(this.$parent.ruta + 'api/empresa')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                    toast({
                        type: 'success',
                        title: 'Empresa Created in successfully'
                        })
                    this.$Progress.finish();

                })
                .catch(()=>{

                })
            }
        },
        created() {
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get(this.$parent.ruta + 'api/findEmpresa?q=' + query)
                .then((data) => {
                    this.empresas = data.data
                })
                .catch(() => {

                })
            })
           this.loadEmpresas();
           Fire.$on('AfterCreate',() => {
               this.loadEmpresas();
           });
        //    setInterval(() => this.loadEmpresas(), 3000);
        }

    }
</script>
