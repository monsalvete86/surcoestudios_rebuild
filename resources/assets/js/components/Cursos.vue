<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor() && !id_curso">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cursos</h3>

                        <div class="card-tools">
                             <button class="btn btn-success" @click="newModal">Agregar Curso <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        Tipo
                        <select name="type" v-model="filtro_tipo" id="type" class="form-control">
                            <option value="">Filtrar tipo de curso</option>
                            <option value="1">Cursos cortos</option>
                            <option value="2">Diplomado</option>                            
                        </select>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Curso</th>
                                    <th>Tipo</th>
                                    <th>Categoria</th>
                                    <th>Tutor</th>
                                    <th>Duracion</th>                                    
                                    <th>Estado</th>        
                                    <th>Módulos</th>
                                    <th></th>  
                                </tr>
                                <tr v-for="curso in cursos.data" :key="curso.id">
                                    <td>{{curso.id}}</td>
                                    <td>{{curso.nombre}}</td>
                                    <td>{{curso.tipo == '1' ? 'Curso corto' : 'Diplomado'}}</td>
                                    <td>{{categorias[curso.categoria][0]}}</td>
                                    <td>{{ tutores[curso.tutor][0]}}</td>
                                    <td>{{curso.duracion + ' ' + tipos_duracion[curso.tipo_duracion]}}</td>
                                    <td v-if="curso.estado == '1'" >Activo</td>
                                    <td v-else >Inactivo</td> 
                                    <td>
																			<button type="button" class="btn btn-info" @click="ver_modulo(curso)">
																				<i class="fas fa-server"></i>
																					Modulos
																			</button>
                                    </td>
                                    <td>
																			<a href="#" @click="editModal(curso)">
																					<i class="fa fa-edit blue"></i>
																			</a>
																			/
																			<a href="#" @click="borrar(curso.id)">
																					<i class="fa fa-trash red"></i>
																			</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="cursos" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            <!-- /.card -->
            </div>
        </div>
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor() && id_curso">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Módulos curso: <b>{{curso.nombre}}</b></h3>

                        <div class="card-tools">
                            <button class="btn btn-danger" @click="id_curso=''">Regresar <i class="fas fa-undo-alt fa-fw"></i></button>
                             <button class="btn btn-success" @click="newModalModulo">Agregar Modulo <i class="fas fa-plus fa-fw"></i></button>
                        </div>
                    </div>

                     <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Modulo</th>
                                    <th>Estado</th>
                                    <th>Documentos</th>
                                    <th>Examen</th>
                                    <th></th>               
                                    <!-- <th>Registrado</th>
                                    <th>Modificado</th>-->
                                </tr>
                                <tr v-for="modulo in modulos.data" :key="modulo.id">
                                    <td>{{modulo.id}}</td>
                                    <td>{{modulo.modulo}}</td>                                   
                                    <td v-if="modulo.estado == '1'" >Activo</td>
                                    <td v-else >Inactivo</td> 
                                    <td>
                                        <button type="button" class="btn btn-info" @click="ver_documentos(modulo.id)">
                                            <i class="fas fa-file-alt"></i>
                                            Documentos
                                        </button>
                                    </td>       
                                    <td>
                                        <button type="button" class="btn btn-info" @click="ver_preguntas(modulo.id)">
                                            <i class="fas fa-graduation-cap"></i>
                                            Examen
                                        </button>
                                    </td>                       
                                    <!-- <td>{{curso.created_at | myDate}}</td>
                                    <td>{{curso.update_at | myDate}}</td>-->
                                    <td>
                                        <a href="#" @click="editModalModulo(modulo)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="borrarModulo(modulo.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="modulos" @pagination-change-page="getResultsModulos"></pagination>
                    </div>
                </div>
            </div>        
        </div>
        <div v-if="!$gate.isAdminOrAuthor()">
            <not-found></not-found>
        </div>
        
        <!-- Modal Cursos-->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Agregar Curso</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Actualizar Curso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? editar() : crear()" enctype="multipart/form-data">
                        <div class="modal-body row">
                            <div class="form-group  col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for='nombre'>Nombre</label>
                                <input v-model="form.nombre" type="text" name="nombre" id="nombre" required
                                    placeholder="Nombre"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }">
                                <has-error :form="form" field="nombre"></has-error>
                            </div>

                            <div class="form-group  col-sm-6 col-md-6 col-lg-6">
                                <label for='categoria'>Categoria</label>
                                <select v-model="form.categoria" id="categoria" name="categoria" required
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('categoria') }"
                                >
                                    <option v-for="categoria in categorias" :key="categoria[1]" :value="categoria[1]">{{ categoria[0]}}</option>
                                </select>
                                <has-error :form="form" field="categoria"></has-error>
                            </div>

                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for='tutor'>Tutor</label>
                                <select v-model="form.tutor" id="tutor" name="tutor" required
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('tutor') }"
                                >
                                    <option v-for="tutor in tutores" :key="tutor[1]" :value="tutor[1]" v-text="tutor[0]"></option>
                                </select>
                                <has-error :form="form" field="tutor"></has-error>
                            </div>
                            <div class="form-group  col-6 col-sm-4 col-md-4 col-lg-4">
                                <label for='duracion'>Duración</label>
                                <input v-model="form.duracion" type="number" min='1' name="duracion" id="duracion"
                                    placeholder="Duracion" required
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('duracion') }">
                                <has-error :form="form" field="duracion"></has-error>
                            </div>
                            <div class="form-group col-6 col-sm-2 col-md-2 col-lg-2">     
                                <label for='duracion'>Tipo duración</label>            
                                <select name="tipo_duracion" v-model="form.tipo_duracion" id="tipo_duracion" class="form-control" :class="{ 'is-invalid': form.errors.has('tipo_duracion') }">
                                    
                                    <option value="1">Horas</option>
                                    <option value="2">Dias</option>
                                    <option value="3">Meses</option>
                                </select>
                                
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for='duracion'>Descripción</label>
                                <textarea v-model="form.descripcion" required name="descripcion" id="descripcion"
                                placeholder="Descripcion"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('descripcion') }"></textarea>
                                <has-error :form="form" field="descripcion"></has-error>
                            </div>
                            <div class="form-group  col-6 col-sm-4 col-md-4 col-lg-4">
                                <label for='validez'>Validez</label>
                                <input v-model="form.validez" type="number" min='1' name="validez" id="validez"
                                    placeholder="Validez" 
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('validez') }">
                                <has-error :form="form" field="validez"></has-error>
                            </div>
                            <div class="form-group col-6 col-sm-2 col-md-2 col-lg-2">     
                                <label for='tipo_validez'>Tipo Validez</label>            
                                <select name="tipo_validez" v-model="form.tipo_validez" id="tipo_validez" class="form-control" :class="{ 'is-invalid': form.errors.has('tipo_validez') }">
                                    
                                    <option value="1">Horas</option>
                                    <option value="2">Dias</option>
                                    <option value="3">Meses</option>
                                </select>
                                
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6 ">
                                <label for='tipo'>Tipo</label>
                                <select name="tipo" v-model="form.tipo" id="tipo" class="form-control" required>
                                   
                                    <option value="1">Curso corto</option>
                                    <option value="2">Diplomado</option>                            
                                </select>
                            </div>
                            <div v-if="form.tipo == 2" class="form-group  col-6 col-sm-6 col-md-6 col-lg-6">
                                <label for='valor'>Valor</label>
                                <input v-model="form.valor" type="number"  min='1' name="valor" id="valor" 
                                    placeholder="Valor"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('valor') }">
                                <has-error :form="form" field="valor"></has-error>
                            </div>
                            <div v-show="editmode" class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for="img_curso" >Foto del curso</label>
                                <div class="col-sm-12">
                                    <input type="file" @change="selectFile" name="photo" class="form-input">
                                </div>

                            </div>
                             <img class="img-circle" :src="photo" alt="User Avatar">
                            
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
        <!-- Modal Modulos-->
        <div class="modal fade" id="addNewModulo" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Agregar Módulo</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Actualizar Módulo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmodeModule ? editarModulo() : crearModulo()">
                       
                        <div class="modal-body row">
                            <div class="form-group  col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for='modulo'>Modulo</label>
                                <input v-model="form_modulo.modulo" type="text" name="modulo" id="modulo" required
                                    placeholder="Modulo"
                                    class="form-control" :class="{ 'is-invalid': form_modulo.errors.has('modulo') }">
                                <has-error :form="form_modulo" field="modulo"></has-error>
                            </div>
                            <div class="form-group  col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for='video'>Video</label>
                                <input v-model="form_modulo.video" type="text" name="video" id="video" required
                                    placeholder="Video"
                                    class="form-control" :class="{ 'is-invalid': form_modulo.errors.has('video') }">
                                <has-error :form="form_modulo" field="video"></has-error>
                            </div>
                            <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                <label for='contenido'>Contenido</label>
                               <textarea v-model="form_modulo.contenido" name="contenido" id="contenido"
                                placeholder="Contenido"
                                class="form-control" :class="{ 'is-invalid': form_modulo.errors.has('contenido') }"></textarea>
                                <has-error :form="form_modulo" field="contenido"></has-error>
                            </div>
                            <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                <label for='texto_prueba'>Texto a mostrar en el examen</label>
                               <textarea v-model="form_modulo.texto_prueba" name="texto_prueba" id="texto_prueba"
                                placeholder="Texto examen"
                                class="form-control" :class="{ 'is-invalid': form_modulo.errors.has('texto_prueba') }"></textarea>
                                <has-error :form="form_modulo" field="texto_prueba"></has-error>
                            </div>
                            <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6">     
                                <label for='estado'>Estado</label>            
                                <select name="tipo_duracion" v-model="form_modulo.estado" id="estado" class="form-control" :class="{ 'is-invalid': form_modulo.errors.has('estado') }">                                    
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>                                
                                </select>
                                <has-error :form="form_modulo" field="estado"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button v-show="editmodeModule" type="submit" class="btn btn-success">Actualizar</button>
                            <button v-show="!editmodeModule" type="submit" class="btn btn-primary">Crear</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- Modal Documentos-->
        <div class="modal fade" id="lista_documentos" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"  id="addNewLabel">Documentos</h5>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- /.card-body -->
                    <form @submit.prevent="crearDocumento()" enctype="multipart/form-data">
                        <div class="modal-body row">
                            <div class="form-group  col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for='nombre_doc'>Nombre Documento</label>
                                <input v-model="form_documento.nombre" type="text" name="nombre_doc" id="nombre_doc" required
                                    placeholder="Nombre Documento"
                                    class="form-control" :class="{ 'is-invalid': form_documento.errors.has('nombre_doc') }">
                                <has-error :form="form_documento" field="nombre_doc"></has-error>
                            </div>
                            <div class="form-group  col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for='ruta'>Documento</label>
                                <input type="file" id="ruta" name="ruta" required class="form-input" :class="{ 'is-invalid': form_documento.errors.has('ruta') }"  @change="updateDocumento">
                                <has-error :form="form_documento" field="ruta" ></has-error>
                            </div>
                            
                        </div> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button v-show="editmodeDocumento" type="submit" class="btn btn-success">Actualizar</button>
                            <button v-show="!editmodeDocumento" type="submit" class="btn btn-primary">Crear</button>
                        </div>

                    </form>
                    <div class="modal-body row">
                        <div class="card-body table-responsive p-2">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Documento</th>
                                        <th>Ver</th>
                                        <th></th>               
                                        <!-- <th>Registrado</th>
                                        <th>Modificado</th>-->
                                    </tr>
                                    
                                    <tr v-for="documento in documentos.data" :key="documento.id">
                                        <td>{{documento.id}}</td>
                                        <td>{{documento.nombre}}</td>                                   
                                        <td><a class="btn btn-info" v-bind:href="'documentos/'+ documento.ruta" target="_blank">
                                            <i class="fas fa-eye"></i>
                                            Ver</a>
                                        </td>   
                                        <!-- <td>{{curso.created_at | myDate}}</td>
                                        <td>{{curso.update_at | myDate}}</td>-->
                                    
                                        <td>
                                            <a href="#" @click="borrarDocumento(documento.id)">
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
        <!-- Modal Preguntas-->
        <div class="modal fade" id="lista_preguntas" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"  id="addNewLabel">Preguntas del Examen </h5>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        
                    </div>
                    <div class="modal-header">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar<i class="fas fa-undo-alt fa-fw"></i></button>
                        <button class="btn btn-success float-right" @click="newPregunta = true">Agregar Pregunta <i class="fas fa-plus fa-fw"></i></button>
                    </div>
                    <!-- /.card-body -->
                    <form v-if="newPregunta == true" @submit.prevent="crearPregunta()">
                        <div class="modal-body row">
                            <div class="form-group  col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for='pregunta'>Pregunta</label>
                                <input v-model="form_pregunta.pregunta" type="text" name="modulo" id="modulo" required
                                    placeholder="Pregunta"
                                    class="form-control" :class="{ 'is-invalid': form_pregunta.errors.has('pregunta') }">
                                <has-error :form="form_pregunta" field="pregunta"></has-error>
                            </div>
                            <div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">     
                                <label for='tipo'>Tipo pregunta</label>            
                                <select name="tipo" v-model="form_pregunta.tipo" id="tipo" class="form-control" :class="{ 'is-invalid': form_pregunta.errors.has('tipo') }">
                                    
                                    <option value="1">Respuesta Múltiple</option>
                                    <option value="2">Falso/Verdadero</option>
                                    
                                </select>                                
                            </div>
                        </div>
                        <div v-if="form_pregunta.tipo==1" class="modal-body row">
                            <div class="form-group  col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for='a'>Opción A. </label>
                                <input v-model="form_pregunta.a" type="text" name="a" id="a" required
                                    placeholder="Opción A"
                                    class="form-control" :class="{ 'is-invalid': form_pregunta.errors.has('a') }">
                                <has-error :form="form_pregunta" field="pregunta"></has-error>
                            </div>
                            <div class="form-group  col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for='b'>Opción B. </label>
                                <input v-model="form_pregunta.b" type="text" name="b" id="b" required
                                    placeholder="Opción B"
                                    class="form-control" :class="{ 'is-invalid': form_pregunta.errors.has('b') }">
                                <has-error :form="form_pregunta" field="b"></has-error>
                            </div>
                            <div class="form-group  col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for='c'>Opción C. </label>
                                <input v-model="form_pregunta.c" type="text" name="c" id="c" required
                                    placeholder="Opción C"
                                    class="form-control" :class="{ 'is-invalid': form_pregunta.errors.has('c') }">
                                <has-error :form="form_pregunta" field="c"></has-error>
                            </div>
                            <div class="form-group  col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for='d'>Opción D. </label>
                                <input v-model="form_pregunta.d" type="text" name="d" id="d" 
                                    placeholder="Opción D"
                                    class="form-control" :class="{ 'is-invalid': form_pregunta.errors.has('d') }">
                                <has-error :form="form_pregunta" field="d"></has-error>
                            </div>
                            <div class="form-group  col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for='e'>Opción E. </label>
                                <input v-model="form_pregunta.e" type="text" name="e" id="e" 
                                    placeholder="Opción E"
                                    class="form-control" :class="{ 'is-invalid': form_pregunta.errors.has('e') }">
                                <has-error :form="form_pregunta" field="e"></has-error>
                            </div>
                            <div class="form-group  col-12 col-sm-6 col-md-6 col-lg-6">
                                <label for='f'>Opción F. </label>
                                <input v-model="form_pregunta.f" type="text" name="f" id="f" 
                                    placeholder="Opción F"
                                    class="form-control" :class="{ 'is-invalid': form_pregunta.errors.has('f') }">
                                <has-error :form="form_pregunta" field="f"></has-error>
                            </div>
                            <div class="form-group col-6 col-sm-2 col-md-2 col-lg-2">     
                                <label for='respuesta'>Respuesta</label>            
                                <select name="respuesta" v-model="form_pregunta.respuesta" id="respuesta" class="form-control" :class="{ 'is-invalid': form_pregunta.errors.has('respuesta') }">
                                    
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                    <option value="d">D</option>
                                    <option value="e">E</option>
                                    <option value="f">F</option>
                                </select>                                
                            </div>
                        </div> 
                        <div v-else class="modal-body row" >
                            <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6" v-if="form_pregunta.tipo == 1 || form_pregunta.tipo == 2">     
                                <label for='respuesta'>Respuesta</label>            
                                <select name="respuesta" v-model="form_pregunta.respuesta" id="respuesta" class="form-control" :class="{ 'is-invalid': form_pregunta.errors.has('respuesta') }" required>
                                    
                                    <option value="V">Verdadero</option>
                                    <option value="F">Falso</option>
                                   
                                </select>                                
                            </div>
                        </div>
                        <div class="modal-footer" >
                            <button type="button" class="btn btn-danger" @click="newPregunta = false">Regresar</button>
                            <button v-show="editmodePregunta" type="submit" class="btn btn-success">Actualizar</button>
                            <button v-show="!editmodePregunta" type="submit" class="btn btn-primary">Crear</button>
                        </div>

                    </form>
                    <div v-if="newPregunta == false">
                        <div  class="modal-body row ml-1" v-for="pregunta in preguntas.data" :key="pregunta.id">
                            <div class="card w-100 col-10" >
                                <div class="card-header">
                                    {{pregunta.pregunta}}
                                </div>
                                <ul v-if="pregunta.tipo == 1" class="list-group list-group-flush" style="line-height: 1 !important;">
                                    <li v-if="pregunta.a" class="list-group-item" :class="{ 'green': pregunta.respuesta == 'a' }">
                                        <span>A. {{pregunta.a}}</span>
                                    </li>
                                    <li v-if="pregunta.b" class="list-group-item" :class="{ 'green': pregunta.respuesta == 'b' }">
                                        <span>B. {{pregunta.b}}</span>
                                    </li>
                                    <li v-if="pregunta.c" class="list-group-item" :class="{ 'green': pregunta.respuesta == 'c' }">
                                        <span>C. {{pregunta.c}}</span>
                                    </li>
                                    <li v-if="pregunta.d" class="list-group-item" :class="{ 'green': pregunta.respuesta == 'd' }">
                                        <span>D. {{pregunta.d}}</span>
                                    </li>
                                    <li v-if="pregunta.e" class="list-group-item" :class="{ 'green': pregunta.respuesta == 'e' }">
                                        <span>E. {{pregunta.e}}</span>
                                    </li>
                                    <li v-if="pregunta.f" class="list-group-item" :class="{ 'green': pregunta.respuesta == 'f' }">
                                        <span>F. {{pregunta.f}}</span>
                                    </li>
                                </ul>
                                <ul v-else class="list-group list-group-flush" style="line-height: 0.6 !important;">
                                    <li class="list-group-item" :class="{ 'green': pregunta.respuesta == 'V' }">
                                        <span>Verdadero</span>
                                    </li>
                                    <li class="list-group-item" :class="{ 'green': pregunta.respuesta == 'F' }">
                                        <span>Falso</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-2 align-middle">
                                
                                <a href="#" @click="borrarPregunta(pregunta.id)">
                                    <i class="fa fa-trash red"></i>
                                </a>
                            </div>
                        </div>
                    </div>
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
                editmodeModule: false,
                editmodeDocumento: false,
                editmodePregunta: false,
                newPregunta: false,
                cursos : {},
                curso: {},
                modulos: {},
                modulo: {},
                documentos: {},
                preguntas: {},    
                aux_documento: '',            
                categorias: {},
                tutores: {},
                photo: '',
                img_curso: '',
                tipos_duracion: {},
                filtro_tipo: '',
                id_curso: '',
                id_modulo: '',
                form: new Form({
									id:'',
									nombre : '',
									categoria: '',
									tutor: '',
									duracion: 1,
									tipo_duracion: '',
									img: '',
									valor: '',
									descripcion: '',
									tipo: '1',
									validez: '',
									tipo_validez: '1'                  
                }),
                form_modulo: new Form({
									id:'',
									id_curso : '',
									modulo: '',
									contenido: '',
									video: '',
									estado: '',   
									texto_prueba: '',                             
                }),
                form_documento: new Form({
									id:'',                   
									id_modulo: '',
									nombre: '',
									ruta: ''   ,
									aux_documento: 'xxx',                                        
                }),
                form_pregunta: new Form({
									id:'',                   
									id_modulo: '',
									tipo: '',
									pregunta: '',
									respuesta: ''  ,
									a: '' , b: '' , c: '' , d: ''  ,
									e: '' , f: ''                               
                })
            }
        },
        methods: {
            selectFile(event) {
               if(event.target.files) {
                    console.log(event.target.files);
                    let file = event.target.files[0];
                    let reader = new FileReader();

                    this.photo = file;
                    reader.onloadend = (file) => {
                        this.form.img = reader.result;
                    }
                    reader.readAsDataURL(file);
               }
            }, 
            updateDocumento(event) { 
                if(event.target.files) {
                    console.log(event.target.files);
                    let file = event.target.files[0];
                        console.log();
                    let reader = new FileReader();
                    
                    reader.onloadend = (file) => {                        
                        this.form_documento.aux_documento = event.target.files;
                        this.form_documento.ruta = reader.result;
                    }
                    reader.readAsDataURL(file);
               }
            },
            
            getResults(page = 1) {
                axios.get(this.$parent.ruta + 'api/curso?page=' + page)
                .then(response => {
                    this.cursos = response.data;
                });
            },

            getResultsModulos(page = 1) {
                axios.get(this.$parent.ruta + 'api/modulo?page=' + page)
                .then(response => {
                    this.modulos = response.data;
                });
            },
    

            ver_modulo(curso){
                this.curso = curso;
                this.id_curso = curso.id; 
                this.getModulos(curso.id);
            },

            getModulos(id_curso) {
                axios.get(this.$parent.ruta + "api/getModules/"+id_curso).then(({ data }) => (this.modulos = data));
            },
            crear(){
                this.$Progress.start();
                //this.form.img= this.photo;
                
                console.log(this.form)
                this.form.post(this.$parent.ruta + 'api/curso')                
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                    toast({
                        type: 'success',
                        title: 'Curso creado correctamente'
                        })
                    this.$Progress.finish();

                })
                .catch(()=>{

                })
            },
            editar(){
                this.$Progress.start();
                console.log(this.form);
                this.form.put(this.$parent.ruta + 'api/curso/'+this.form.id)
                .then(() => {
                    // success
                    $('#addNew').modal('hide');
                     swal(
                        'Actualizado!',
                        'La información ha sido actualizada.',
                        'success'
                        )
                        this.$Progress.finish();
                         Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
            editModal(curso){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(curso);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },

            borrar(id){
							swal({
									title: 'Estas seguro?',
									text: "No podras revertir este proceso!",
									type: 'warning',
									showCancelButton: true,
									confirmButtonColor: '#3085d6',
									cancelButtonColor: '#d33',
									confirmButtonText: 'Yes, delete it!'
							}).then((result) => {
								if (result.value) {
									this.form.delete(this.$parent.ruta + 'api/curso/'+id).then(()=>{
										swal(	
											'Borrado!',
											'Tu registro ha sido borrado.',
											'Exito'
										)
										Fire.$emit('AfterCreate');
									}).catch(()=> {
										swal("Failed!", "Algo ha salido mal.", "warning");
									});
								}
							})
            },

            crearModulo(){
							this.$Progress.start();
							this.form_modulo.id_curso = this.id_curso;
							this.form_modulo.post(this.$parent.ruta + 'api/modulo')
							.then(()=>{
								Fire.$emit('AfterCreate');
								$('#addNewModulo').modal('hide')

								toast({
									type: 'success',
									title: 'Modulo creado correctamente'
									})
								this.$Progress.finish();
							})
							.catch(()=>{})
            },

            editarModulo(){
							this.$Progress.start();
							// console.log('Editing data');
							this.form_modulo.put(this.$parent.ruta + 'api/modulo/'+this.form_modulo.id)
							.then(() => {
								// success
								$('#addNewModulo').modal('hide');
								swal(
									'Actualizado!',
									'El modulo ha sido actualizado.',
									'success'
								)
								this.$Progress.finish();
								Fire.$emit('AfterCreate');
							})
							.catch(() => {
								this.$Progress.fail();
							});
            },

            
            editModalModulo(modulo){
							this.editmodeModule = true;
							this.id_
							this.form_modulo.reset();
							$('#addNewModulo').modal('show');
							this.form_modulo.fill(modulo);
            },

            newModalModulo(){
							this.editmodeModule = false;
							this.form_modulo.reset();
							this.form_modulo.estado = 1;
							$('#addNewModulo').modal('show');
            },
            
            borrarModulo(id){
							swal({
								title: 'Estas seguro?',
								text: "No podras revertir este proceso!",
								type: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Si, Borrarlo!'
							}).then((result) => {
								if (result.value) {
									this.form_modulo.delete(this.$parent.ruta + 'api/modulo/'+id).then(()=>{
										swal(
											'Borrado!',
											'Tu registro ha sido borrado.',
											'Exito'
										)
										Fire.$emit('AfterCreate');
									}).catch(()=> {
										swal("Failed!", "Algo ha salido mal.", "warning");
									});
								}
							})
            },

            ver_documentos(modulo) {
                this.id_modulo = modulo;
                this.form_documento.reset();
                this.getDocumentos(modulo);
                $('#lista_documentos').modal('show');
               // console.log('documentos');
               // console.log(this.documentos);
            },

            borrarDocumento(id){
                swal({
                    title: 'Estas seguro?',
                    text: "No podras revertir este proceso!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Borrarlo!'
                    }).then((result) => {

                        // Send request to the server
                         if (result.value) {
                                this.form_modulo.delete(this.$parent.ruta + 'api/documento/'+id).then(()=>{
                                        swal(
                                        'Borrado!',
                                        'Tu registro ha sido borrado.',
                                        'Exito'
                                        )
                                    Fire.$emit('AfterCreate');
                                }).catch(()=> {
                                    swal("Failed!", "Algo ha salido mal.", "warning");
                                });
                         }
                    })
            },

            updateProfile(e){
                let file = e.target.files[0];
                let reader = new FileReader();

                reader.onloadend = (file) => {
                    this.form_documento.ruta = reader.result;
                }
                reader.readAsDataURL(file);
            },
            crearDocumento(){
                this.$Progress.start();
                this.form_documento.id_modulo = this.id_modulo;
              
                this.form_documento.post(this.$parent.ruta + 'api/documento')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#lista_documentos').modal('hide')

                    toast({
                        type: 'success',
                        title: 'Documento creado correctamente'
                        })
                    this.$Progress.finish();
                    this.newPregunta = false;

                })
                .catch(()=>{

                })
            },
            ver_preguntas(modulo) {
                this.form_pregunta.reset();
                this.getPreguntas(modulo);
                this.id_modulo = modulo;
                $('#lista_preguntas').modal('show');
               // console.log('documentos');
               console.log(this.preguntas);
            },
           
            crearPregunta(){
                this.$Progress.start();
                this.form_pregunta.id_modulo = this.id_modulo;
                this.form_pregunta.post(this.$parent.ruta + 'api/pregunta')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#lista_preguntas').modal('hide')

                    toast({
                        type: 'success',
                        title: 'Pregunta creado correctamente'
                        })
                    this.$Progress.finish();
                    this.newPregunta = false;
                })
                .catch(()=>{

                })
            },

            borrarPregunta(id){
							swal({
									title: 'Estas seguro?',
									text: "No podras revertir este proceso!",
									type: 'warning',
									showCancelButton: true,
									confirmButtonColor: '#3085d6',
									cancelButtonColor: '#d33',
									confirmButtonText: 'Si, Borrarlo!'
									}).then((result) => {

										// Send request to the server
										if (result.value) {
											this.form_modulo.get(this.$parent.ruta + 'api/borrarPregunta/'+id).then(()=>{
												swal(
													'Borrado!',
													'Tu registro ha sido borrado.',
													'Exito'
												)
												Fire.$emit('AfterCreate');
											}).catch(()=> {
												swal("Failed!", "Algo ha salido mal.", "warning");
											});
										}
										this.cargar();
									})
            },

            cargar(){
							if(this.$gate.isAdminOrAuthor()){
								axios.get(this.$parent.ruta + "api/curso").then(({ data }) => (this.cursos = data));
							}
            },

            getCategorias() {
							let me = this;
								axios.get(this.$parent.ruta + "api/categoria")
								.then(function (response) {
									let auxCats = response.data.data;                    
										
										$.each(auxCats, function(key, value) {
											
											me.categorias[value.id] = [value.categoria, value.id]; 
									});
							})
							.catch(function (error) {
									console.log(error);
							});
            },
            getTutores() {               
               
                let me = this;
                 axios.get(this.$parent.ruta + "api/getTutors")
                 .then(function (response) {
                    let auxTuts = response.data.users;                                        
                     $.each(auxTuts, function(key, value) {
                        me.tutores[value.id] = [value.name, value.id] 
                    });
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDocumentos(id_modulo) {               
               axios.get(this.$parent.ruta + "api/getDocumentos/"+id_modulo).then(({ data }) => (this.documentos = data));
            },
            getPreguntas(id_modulo) {               
               axios.get(this.$parent.ruta + "api/getPreguntas/"+id_modulo).then(({ data }) => (this.preguntas = data));
            },
            updateFoto(e){
							let file = e.target.files[0];
							let reader = new FileReader();

							let limit = 1024 * 1024 * 2;
							if(file['size'] > limit){
								swal({
									type: 'error',
									title: 'Oops...',
									text: 'You are uploading a large file',
								})
								return false;
							}

							reader.onloadend = (file) => {
								this.form.img = reader.result;
							}
							reader.readAsDataURL(file);
            }
            
        },
        created() {
						this.cargar();
            this.getCategorias();
            this.getTutores();
            let me = this;
            Fire.$on('searching',() => {

							let query = this.$parent.search;

							if(me.id_curso){
									axios.get(this.$parent.ruta + 'api/findModulo?q=' + query)
									.then((data) => {
											this.cursos = data.data
									})
									.catch(function (error) {
											console.log(error);
									});
							}
							else {
									axios.get(this.$parent.ruta + 'api/findCurso?q=' + query)
								.then((data) => {
										this.cursos = data.data
								})
								.catch(function (error) {
										console.log(error);
								});
							}
                
               
            })
           
           Fire.$on('AfterCreate',() => {
               this.cargar();
           });
        //    setInterval(() => this.loadUsers(), 3000);
        }

    }
</script>
