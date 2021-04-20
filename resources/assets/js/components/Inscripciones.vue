<template>
	<div class="container">
		<div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
							<h3 class="card-title">Inscripciones</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
							Tipo 
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover">
							<tbody>
								<tr>
									<th>ID</th>
									<th>Alumno</th>                                   
									<th>Curso</th>
									<th>Fecha Solicita</th>
									<th>Estado</th>
									<th>Fecha Acepta</th>                                    
									<th>Fecha Cancelado</th>
									<th>Fecha Finalizado</th>
									<th></th>
								</tr>
								<tr v-for="inscripcion in inscripciones.data" :key="inscripcion.id">
									<td>{{inscripcion.id}}</td>
									<td>{{inscripcion.name}}</td>
									<td>{{inscripcion.curso}}</td>
									<td>{{inscripcion.fecha}}</td>
									<td v-if="inscripcion.estado==1">En solicitud</td>
									<td v-if="inscripcion.estado==2">En progreso</td>
									<td v-if="inscripcion.estado==3">Finalizado</td>
									<td v-if="inscripcion.estado==0">Cancelado</td>
									<td>
										<div v-if="inscripcion.estado == 1">
											<button type="button" class="btn btn-success" @click="aceptarInscripcion(inscripcion.id)">Aceptar</button>
										</div>
										<div v-else>
											{{inscripcion.fec_activa}}
										</div>
									</td>
									<td>
										<div v-if="inscripcion.estado == 1 || inscripcion.estado == 2">
											<button type="button" class="btn btn-danger" @click="cancelarInscripcion(inscripcion.id)">Cancelar</button>
										</div>
										<div v-else>
											{{inscripcion.fec_cancela}}
										</div>
									</td>
									<td>{{inscripcion.fec_termina}} </td>
									<td >
										<a target="_blank" v-if="inscripcion.fec_termina" class="btn btn-info" :href="aux_ruta + 'cepsas/newdiploma.php?id=' + inscripcion.id_alumno + '&curso=' + inscripcion.id+ '&inscripcion=' + inscripcion.id_curso">Certificado Curso</a>  
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
					<div class="card-footer">
						<pagination :data="inscripciones" @pagination-change-page="getResults"></pagination>
					</div>
				</div>
			<!-- /.card -->
			</div>
		</div>
		<div v-if="!$gate.isAdminOrAuthor()">
			<not-found></not-found>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				editmode: false,
				inscripciones : {},
				aux_ruta: '',
			}
		},
		methods: {
				getResults(page) {
					axios.get(this.$parent.ruta + 'api/inscripcion?page=' + page)
					.then(response => {
							this.inscripciones = response.data;
							console.log(response.data)
					});
				},
				
				loadInscripciones() {
					if(this.$gate.isAdminOrAuthor()) {
						axios.get(this.$parent.ruta + "api/getInscripciones").then(({ data }) => (this.inscripciones = data.inscripciones));
						console.log(this.inscripciones);
					}
				},
				cancelarInscripcion(id) {
						swal({
							title: 'Estas seguro?',
							text: "No podras revertir este proceso!",
							type: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Si, cancelarla!'
						}).then((result) => {
							if (result.value) {
								axios.delete(this.$parent.ruta + 'api/inscripcion/'+id).then(()=>{
									swal(
									'Borrado!',
									'Tu registro ha sido cancelado.',
									'Exito'
									)
									Fire.$emit('AfterCreate');
								}).catch(()=> {
									swal("Failed!", "Algo ha salido mal.", "warning");
								});
							}
						})
				},
				aceptarInscripcion(id) {
						let me = this;
						swal({
								title: 'Estas seguro de aceptar esta inscripción?',
								text: "Tu no podras revertir esta acción!",
								type: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Si, Aceptar!'
								}).then((result) => {

										// Send request to the server
											if (result.value) {
												axios.get(this.$parent.ruta +"api/activaInscripcion/"+id)
												.then(function (data) {
														me.inscripciones = data.inscripciones;
														swal(
																'Activada!',
																'La inscripción ha sido activada.',
																'success'
																)
														Fire.$emit('AfterCreate');
												});
													
											}
								})
				},
				createUser() {
					this.$Progress.start();
					this.aux_ruta = this.$parent.ruta;
					this.form.post(this.$parent.ruta +'api/user')
					.then(()=>{
							Fire.$emit('AfterCreate');
							$('#addNew').modal('hide')

							toast({
									type: 'success',
									title: 'Usuario Creado correctamnte'
									})
							this.$Progress.finish();

					})
					.catch(()=>{})
				},
		}, 
		created() {
			Fire.$on('searching',() => {
				let query = this.$parent.search;
				axios.get(this.$parent.ruta +'api/findInscripcion?q=' + query)
				.then((data) => {
						this.inscripciones = data.data
				})
				.catch(() => {

				})
			})
			this.loadInscripciones();
			Fire.$on('AfterCreate',() => {
				this.loadInscripciones();
			});
		}
	}
</script>