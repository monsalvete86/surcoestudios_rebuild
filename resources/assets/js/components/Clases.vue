<template>
    <div class="container">
        <div class="row mt-5" >
            <div class="col-md-12" v-if="!id_curso">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Mis cursos</h5>                         
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead> 
                                <tr>                                    
                                    <th>Curso</th>
                                    <th>Fecha Solicita</th>                                    
                                    <th>Fecha Acepta</th>                                    
                                    <th>Fecha Cancelado</th>
                                    <th>Fecha Finalizado</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                    <th>Certificado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="inscripcion in inscripciones.data" :key="inscripcion.id">
                                    <td>{{inscripcion.curso}}</td>
                                    <td>{{inscripcion.fecha}}</td>
                                    
                                    <td>
                                        {{inscripcion.fec_activa}}
                                    </td>
                        
                                    <td v-if="inscripcion.estado == 1 || inscripcion.estado == 2">
                                        <button type="button" class="btn btn-danger" @click="cancelarInscripcion(inscripcion.id)">Cancelar Inscripción</button>
                                    </td >
                                    <td v-else>
                                        {{inscripcion.fec_cancela}}
                                    </td>
                                    
                                    <td>{{inscripcion.fec_termina}}</td>
                                    <td v-if="inscripcion.estado==1">En solicitud</td>
                                    <td v-if="inscripcion.estado==2">En progreso</td>
                                    <td v-if="inscripcion.estado==3">Finalizado</td>
                                    <td v-if="inscripcion.estado==0">Cancelado</td>
                                    <td>
                                        <button  v-if="inscripcion.estado==2 || inscripcion.estado==3" class="btn btn-success" @click="irCurso(inscripcion)">Ir al curso</button>
                                        <button v-else class="btn btn-secondary">Ir al curso</button>
                                    </td>
                                    <td >
                                        <a target="_blank" v-if="inscripcion.fec_termina" class="btn btn-info" :href="aux_ruta + 'cepsas/newdiploma.php?id=' + inscripcion.id_alumno + '&curso=' + inscripcion.id+ '&inscripcion=' + inscripcion.id_curso">Certificado Curso</a>                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12" v-else>
                <div class="card">
                    <div class="card-header">
											<div class="card-tools">
												<button class="btn btn-danger" @click="id_curso='';">Regresar <i class="fas fa-undo-alt fa-fw"></i></button>
											</div>
											<b>Cruso: </b><h3 class="card-title">{{curso.curso}}</h3> 
                    </div>
                     <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
													<thead> 
														<tr>                                    
															<th>Módulo</th>
															<th>Estado</th>
															<th>Resultado</th>
															<th>Contenido</th>
															<th>Examen</th>                     
														</tr>
													</thead>
													<tbody>
														<tr v-for="modulo in modulos" :key="modulo.id">
															<td>{{modulo.modulo}}</td>
															<td v-if="resultados[modulo.id] != ''">
																<div v-if="resultados[modulo.id].resultado > 60">Aprobado</div>
																<div v-else>Sin Aprobar Aun {{resultados[modulo.id].resultado }}</div>
															</td>
															<td v-else>En curso</td>
															<td> ({{resultados[modulo.id].respondidas}} / {{resultados[modulo.id].preguntas}}) ({{resultados[modulo.id].resultado}} %)</td>
															<td><button class="btn btn-info" @click="verModulo(modulo)">Contenido</button></td>
															<td>
																	<button class="btn btn-success" @click="verExamen(modulo)">Presentar Examen</button>
															</td>
														</tr>
													</tbody>
                        </table>
                     </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="contenido" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-12">                            
                            <b>Modulo: </b><h3 class="card-title">{{modulo.modulo}}</h3> 
                        </div>
                        <div v-if="modulo.video && modulo.video.length >3" class="col-12 mt-2" v-html="modulo.video"></div>
                        <div class="col-12 mt-2">
                            <b>Contenido:</b><br>
                            {{modulo.contenido}}
                        </div>
                        <div v-if=" documentos.length > 0" class="col-12 mt-2">                            
                            <ul class="list-group">
                                <li class="list-group-item active"><b>Documentos de apoyo</b><br></li>
                                <li class="list-group-item" v-for="documento in documentos" :key="documento.id">
                                    <a target="_blank" :href="aux_ruta + 'documentos/' + documento.ruta">{{documento.nombre}}</a>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="examen" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-12">
                            <b>Examen Módulo: </b><h3 class="card-title">{{modulo.modulo}}</h3> 
                        </div>
                        <div class="col-12">{{modulo.texto_prueba}}</div>                        
                    </div>
                    <form  @submit.prevent="responder()">
                        <div class="modal-body row" v-for="pregunta in preguntas" :key="pregunta.id">
                            <div class="col-12" >                            
                                <b>{{pregunta.pregunta}}</b>
                               
                            </div>                            
                            <div class="row col-12">
                                <table class="table w-100 border-bottom" v-if="pregunta.tipo == 1">
                                    <tr>
                                        <td width='20px'>A.</td>
                                        <td  class="col-9">{{pregunta.a}} </td>
                                        <td class="col-2">
                                            <input type="radio" :id="pregunta.id + '_a'" :name="'preg_' + pregunta.id " value='a' v-model='respuestas_clientes[pregunta.id]' required>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >B.</td><td>{{pregunta.b}}</td>
                                        <td>
                                            <input type="radio" :id="pregunta.id + '_b'" :name="'preg_' + pregunta.id "  v-model='respuestas_clientes[pregunta.id]' value='b'>
                                        </td>
                                    </tr>
                                    <tr><!-- v-bind="respuestas_clientes[pregunta.id]" -->
                                        <td>C.</td><td>{{pregunta.c}}</td>
                                        <td>
                                            <input type="radio" :id="pregunta.id + '_c'" :name="'preg_' + pregunta.id "   v-model='respuestas_clientes[pregunta.id]' value='c'>
                                        </td>
                                    </tr>
                                    <tr v-if="pregunta.d" >
                                        <td>D.</td><td>{{pregunta.d}}</td>
                                        <td>
                                            <input type="radio" :id="pregunta.id + '_d'" :name="'preg_' + pregunta.id " v-model='respuestas_clientes[pregunta.id]' value='d'>
                                        </td>
                                    </tr>
                                    <tr v-if="pregunta.e" >
                                        <td>E.</td><td>{{pregunta.e}}</td>
                                        <td>
                                            <input type="radio" :id="pregunta.id + '_e'" :name="'preg_' + pregunta.id "  v-model='respuestas_clientes[pregunta.id]' value='e'>
                                        </td>
                                    </tr>
                                    <tr v-if="pregunta.f" >
                                        <td width='20px'>F.</td><td>{{pregunta.f}}</td>
                                        <td>
                                            <input type="radio" :id="pregunta.id + '_f'" :name="'preg_' + pregunta.id " v-model='respuestas_clientes[pregunta.id]' value='f'>
                                        </td>
                                    </tr>
                                </table>    
                                <table class="table w-100 border-bottom" v-else>
                                    <tr>
                                        <td class="col-9">Verdadero</td>
                                        <td >
                                            <input type="radio" :id="pregunta.id + '_v'" :name="'preg_' + pregunta.id " v-model='respuestas_clientes[pregunta.id]' value='V' required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-9">Falso</td>
                                        <td>
                                            <input type="radio" :id="pregunta.id + '_f'" :name="'preg_' + pregunta.id " v-model='respuestas_clientes[pregunta.id]' value='F'>
                                        </td>
                                    </tr>
                                </table>                    
                                
                            </div>                            
                        </div>    
                        <div class="row col-12 mb-2 ml-2 pl-2 pb-2">
                            <button class="btn-success btn" type="submit">Enviar Prueba</button>
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
                modulos : {},
                modulo: {},
                cursos : {},
                curso: {},
                id_curso: '',
                documentos: {},
                inscripciones : {},
                inscripcion: {},
                id_modulo: '',
                resultados: {},
                respuestas_clientes: [],
                respuestas_preguntas: [],
                id_inscripcion: '',
                id_alumno: '',
                aux_ruta: '',
                preguntas: [],
                cant_preguntas: '',
                acertadas: '',
                resultado: '',
               
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get(this.$parent.ruta + 'api/findMisInscripciones?page=' + page)
                .then(response => {
                    this.inscripciones = response.data;
                });
            },
            verCurso(inscripcion){
                this.inscripcion = inscripcion;
                this.id_inscripcion = inscripcion.id;
            },
            cancelarIns(id) {
                let me = this;
                 swal({
                    title: 'Estas seguro?',
                    text: "No podras revertir este proceso!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, cancelar!'
                    }).then((result) => {
                        axios.get(this.$parent.ruta + 'api/cancelarMisInscripciones/' + id)
                        .then(response => {
                            me.loadCursos();
                            swal(
                                'Cancelada!',
                                'La inscripción ha sido cancelada.',
                                'success'
                                )
                            Fire.$emit('AfterCreate');
                        });
                    });
            },
            loadCursos(){
                
                axios.get(this.$parent.ruta + "api/findMisInscripciones").then(({ data }) => (this.inscripciones = data));
                
            },
            irCurso(curso) {
							this.curso = curso;
							this.id_curso = curso.id_curso;
							this.id_inscripcion = curso.id;
							this.getModulos(curso.id_curso);
							this.getResultModule(curso.id_curso);
            },
            getModulos(id_curso) {

                let me = this;
                 axios.get(this.$parent.ruta + "api/getModules/"+id_curso)
                 .then(function (response) {
                    me.modulos = response.data.data
                })
                .catch(function (error) {
                    console.log(error);
                });
                
            },

            getResultModule(id_curso) {
                
                let me = this;
                 axios.get(this.$parent.ruta + "api/getResultModules/"+me.id_inscripcion+"/"+id_curso)
                 .then(function (response) {                    
                    me.resultados = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            verModulo (modulo) {
                this.modulo = modulo;                
                this.getDocumentos(modulo.id);
                $('#contenido').modal('show');
            },

            getDocumentos(id_modulo) {

                let me = this;
                 axios.get(this.$parent.ruta + "api/getDocumentos/"+id_modulo)
                 .then(function (response) {
                     console.log(response.data);
                    me.documentos = response.data.data
                })
                .catch(function (error) {
                    console.log(error);
                });
                
            },

            verExamen(modulo) {
                this.modulo= modulo;
                $('#examen').modal('show');
                this.getPreguntas(modulo.id);
            },

            getPreguntas(id_modulo) {

                let me = this;
                me.respuestas_clientes = [];
                axios.get(this.$parent.ruta + "api/getPreguntasArray/"+id_modulo)
                .then(function (response) {
                    //console.log(response.data.listado_respuestas);
                    me.preguntas = response.data.preguntas.data;
                    me.respuestas_clientes = response.data.listado_respuestas;
                    me.respuestas_preguntas = response.data.respuestas;
                    
                    let aux_arra_res = [];
                                      
                })
                .catch(function (error) {
                    console.log(error);
                });
                
            },
            responder() {
                let me = this;
                axios.post(this.$parent.ruta + "api/responderPreguntas",{
                    'id_modulo': this.modulo.id,
                    'repuestas': this.respuestas_preguntas,
                    'respuestas_clientes': this.respuestas_clientes,
                    'id_curso': this.id_curso,
                    'id_inscripcion' : this.id_inscripcion
                })
                .then(function () {
                    me.irCurso(me.curso);
                     $('#examen').modal('hide');
                });
            }
           
        }, 
        created() {
            this.aux_ruta = this.$parent.ruta;
        
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get(this.$parent.ruta + 'api/findMisInscripciones/' + query)
                .then((data) => {
                    this.inscripciones = data.data
                })
                .catch(() => {

                })
            })
           this.loadCursos();
           Fire.$on('AfterCreate',() => {
               this.loadUsers();
           });
        //    setInterval(() => this.loadUsers(), 3000);
        }

    }
</script>
