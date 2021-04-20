<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Preguntas</div>                      
                    <div class="card-body">                        
                        <div class="row mb-1">
                            <div class="col-6 text-left">
                              <label for="Lote"> Niveles</label>
                              <select class="form-control" v-model="tabla_pregunta" @change="listar()">
                                <option value="preguntas_nivel1">Preguntas nivel 1</option>
                                <option value="preguntas_nivel2">Preguntas nivel 2</option>
                                <option value="preguntas_nivel3">Preguntas nivel 3</option>
                                <option value="preguntas_nivel4">Preguntas nivel 4</option>
                              </select>
                            </div>
                            <div class="col-6 text-right">
                                 <button v-if="counter<501" class="btn btn-success" @click="agregar_pregunta()">Nuevo</button>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table table-striped"> 
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Pregunta</th>
                                  <th scope="col">Opcion a</th>
                                  <th scope="col">Opcion b</th>
                                  <th scope="col">Opcion c</th>
                                  <th scope="col">Opcion d</th>
                                  <th scope="col">Pista</th>
                                  <th scope="col">Respuesta</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr v-for="pregunta in listado"  >
                                  <th>{{pregunta[1].numeral}}</th>                                  
                                  <th scope="row" v-text="pregunta[1].pregunta"></th>
                                  <td v-text="pregunta[1].opcion_a"></td>
                                  <td v-text="pregunta[1].opcion_b"></td>
                                  <td v-text="pregunta[1].opcion_c"></td>
                                  <td v-text="pregunta[1].opcion_d"></td>
                                  <td v-text="pregunta[1].pista"></td>
                                  <td v-text="pregunta[1].respuesta"></td>
                                  <td>
                                      <button class="btn btn-success" v-if="pregunta[1].numeral<= listado.length" @click="editar(pregunta[1] , pregunta[2])">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                      <button v-if="pregunta[1].numeral== listado.length || pregunta[1].numeral>= 500" @click="eliminar(pregunta[2])" class="btn btn-light" type="button">
                                        <span style="font-size: 1.5em; color:#DC3545;"><i class="fas fa-trash"></i></span>
                                      </button>
                                  </td>         
                                  
                                </tr>
                              </tbody>
                            </table>
                         </div> 
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalSiembra" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modalSiembraLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalSiembralLabel">Datos Pregunta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">                                
                <div class="container row">                  
                  <div class="form-group row   col-12 te0xt-left">
                    <label for="pregunta" class="col-2 ">Pregunta</label>
                    <div class="col-10 ">                      
                      <input class="form-control" type="text" id="pregunta" v-model="form.pregunta">
                    </div>
                  </div>
                  <div class="form-group row   col-12 te0xt-left">
                    <label for="opcion_a" class="col-2 ">Opción a</label>
                    <div class="col-10 ">                      
                      <input class="form-control" type="text" id="opcion_a" v-model="form.opcion_a">
                    </div>
                  </div>
                  <div class="form-group row   col-12 te0xt-left">
                    <label for="opcion_b" class="col-2 ">Opción b</label>
                    <div class="col-10 ">                      
                      <input class="form-control" type="text" id="opcion_b" v-model="form.opcion_b">
                    </div>
                  </div>
                  <div class="form-group row   col-12 te0xt-left">
                    <label for="opcion_c" class="col-2 ">Opción c</label>
                    <div class="col-10 ">                      
                      <input class="form-control" type="text" id="opcion_c" v-model="form.opcion_c">
                    </div>
                  </div>
                  <div class="form-group row   col-12 te0xt-left">
                    <label for="opcion_d" class="col-2 ">Opción d</label>
                    <div class="col-10 ">                      
                      <input class="form-control" type="text" id="opcion_d" v-model="form.opcion_d">
                    </div>
                  </div>
                  <div class="form-group row   col-12 te0xt-left">
                    <label for="pista" class="col-2 ">Pista</label>
                    <div class="col-10 ">                      
                      <input class="form-control" type="text" id="pista" v-model="form.pista">
                    </div>
                  </div>
                  <div class="form-group row   col-12 te0xt-left">
                    <label for="restpuesta" class="col-2 ">Respuesta</label>
                    <div class="col-10 ">                      
                      <input class="form-control" type="text" id="respuesta" v-model="form.respuesta">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="form-group row">
                    <div class="col-sm-12 text-right">
                      <button type="button" class="btn btn-secondary " data-dismiss="modal">Cancelar</button>
                      <button type="submit" @click="guardar()" class="btn btn-primary">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
  import Vue from 'vue'
  import { Form, HasError, AlertError } from 'vform'
  import {db} from '../app';
    
  Vue.component(HasError.name, HasError)
  Vue.component(AlertError.name, AlertError)
    export default {
        data() {
            return {
                listado: [],
                counter : 0,
                tabla_pregunta: 'preguntas_nivel1',
                form:{
                  id : '',
                  numeral:'',
                  pregunta:'',
                  opcion_a:'',
                  opcion_b:'',
                  opcion_c:'',
                  opcion_d:'',
                  pista:'',
                  respuesta:'',
                },
            }
        },
        methods: {           
            listar() {              
              let me = this;
              me.listado = [];
              me.counter = 1;
              
              db.collection(me.tabla_pregunta).orderBy("numeral","desc").get()
              .then((snapshot) => {
                const data = snapshot.docs.map((doc) => ({ 
                  data: doc.data(),
                  id: doc.id
                 }));

                 data.forEach(doc_a => {
                  //console.log(doc_a.id);
                  if(doc_a.data.estado === true ){
                    me.ban_abierto = 1;
                  }
                  me.listado.push([me.counter, doc_a.data, doc_a.id]);
                  me.counter =  parseInt(me.counter) + 1;
                })
              })
            },     
            
            agregar_pregunta() {
              //db.collection(me.tabla_pregunta).
              this.form.id="";
              this.form.pregunta="";
              this.form.numeral="";
              this.form.opcion_a="";
              this.form.opcion_b="";
              this.form.opcion_c="";
              this.form.opcion_d="";
              this.form.pista="";
              this.form.respuesta="";
              $('#modalSiembra').modal('show');
            },
            eliminar(id) {
              let me = this;
              if(confirm('Esta seguro de eliminar este registro?')) {
                db.collection(me.tabla_pregunta).doc(id).delete().then(function() {                  
                  me.listar();
                }).catch(function(error) {
                  console.error("Error removing document: ", error);
                });
                
              }
            },
            editar(obj_editar,id_edita) {
                
                this.form.id=id_edita;
                this.form.pregunta=obj_editar.pregunta;
                this.form.numeral=obj_editar.numeral;
                this.form.opcion_a=obj_editar.opcion_a;
                this.form.opcion_b=obj_editar.opcion_b;
                this.form.opcion_c=obj_editar.opcion_c;
                this.form.opcion_d=obj_editar.opcion_d;
                this.form.pista=obj_editar.pista;
                this.form.respuesta=obj_editar.respuesta;
                $('#modalSiembra').modal('show');
                
            },
            guardar() {   
              let me = this;        
              let numeral_documento = "";
              if(me.form.id == "") {
                /*db.collection(me.tabla_pregunta).doc(me.form.id).delete().then(function() {                  
                  console.log("borrado para agregar editando");
                  
                })               */
                numeral_documento = me.counter;
                
                var coleccion = db.collection(me.tabla_pregunta)
                  .add({
                    numeral: numeral_documento,
                    pregunta: this.form.pregunta,
                    opcion_a: this.form.opcion_a,
                    opcion_b: this.form.opcion_b,
                    opcion_c: this.form.opcion_c,
                    opcion_d: this.form.opcion_d,
                    pista: this.form.pista,
                    respuesta: this.form.respuesta,

                  })      
                  .then(function(docRef) {                                                        
                    me.listar();
                    $('#modalSiembra').modal('hide');
                  })  ;
              } else {                

                var coleccion = db.collection(me.tabla_pregunta).doc(this.form.id)
                  .update({                    
                    pregunta: this.form.pregunta,
                    opcion_a: this.form.opcion_a,
                    opcion_b: this.form.opcion_b,
                    opcion_c: this.form.opcion_c,
                    opcion_d: this.form.opcion_d,
                    pista: this.form.pista,
                    respuesta: this.form.respuesta,

                  })      
                  .then(function(docRef) {                                    
                    $('#modalSiembra').modal('hide');
                    me.listar();
                  }) ;
              }
            }
        },
        mounted() {
            this.counter = 0;
            this.listar();
            //console.log('Component mounted.')
        }
    }
</script>
