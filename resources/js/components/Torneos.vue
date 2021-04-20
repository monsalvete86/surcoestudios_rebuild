<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Torneos</div>
                    
                    <div class="card-body">                        
                        <div class="row mb-1">  
                          <div class="col-12 text-right">
                                 <button v-if="ban_abierto === 0" class="btn btn-success" @click="agregar()">Nuevo</button>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table table-striped"> 
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Torneo</th>
                                  <th scope="col">Estado</th>
                                  <th scope="col">Fec. Inicio</th>
                                  <th scope="col">Fec. Fin</th>
                                  <th scope="col">Ganador</th>  
                                  <th scope="col">Participantes</th>                                                                 
                                                                    
                                  <th scope="col"></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr v-for="torneo in listado" >
                                  <th>{{torneo[0]}}</th>               
                                  <td v-text="torneo[1].texto"></td>                   
                                  <th scope="row" v-if="torneo[1].estado == true">Activo</th>
                                  <th scope="row" v-else>Inactivo</th>
                                  <td v-text="torneo[1].fecha_inicio.toDate()"></td>
                                  <td v-if="torneo[1].estado == false"><b>FINALIZADO</b> {{torneo[1].fecha_fin.toDate()}}</td>
                                  <td v-else><b>VIGENTE HASTA</b> {{torneo[1].fecha_fin.toDate()}}</td>
                                  
                                  <td v-text="torneo[1].ganador"></td>
                                  <td>
                                    <button @click="ver_participantes(torneo[2],torneo[1].texto)" class="btn btn-primary" type="button">
                                      Participantes
                                    </button>  
                                  </td>                                 
                                  <td v-if="torneo[1].estado== true">
                                      <button @click="inactivar(torneo[2])" class="btn btn-light" type="button">
                                        <span style="font-size: 1.5em; color:#DC3545;"><i class="fas fa-trash"></i></span>
                                      </button>
                                  </td>         
                                  <td v-else>
                                      <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Reactivar Torneo" v-if="ban_abierto == 0" @click="activar(torneo[2])" >
                                        <span style="font-size: 1.5em;"><i class="fas fa-check"></i></span>
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
        <div class="modal fade" id="modalJuadores" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modalJuadoresLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalJuadoresLabel">Listado participantes torneo {{aux_nom_torneo}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">                                

                <div class="container row"> 
                  <div class="row">
                    <div class="col-md-5 col-12 ml-4 mb-2">
                      Distrito
                      <select class="form-control" v-model="filtro_distrito" @change="get_list_players2()">
                        <option value=""></option>
                        <option v-for="dist in aux_listado3" :value="dist">{{dist}}</option>
                      </select>
                    </div>
                    <div class="col-md-5 col-12 ml-4 mb-2">
                      Congregación                    
                      
                      <select class="form-control" v-model="filtro_sede" @change="get_list_players2()">
                        <option value=""></option>
                        <option v-for="dist in aux_sedes" :value="dist">{{dist}}</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <table class="table table-striped"> 
                      <thead>
                        <tr>
                          <th scope="col">Puesto</th>
                          <th scope="col">Correo</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Foto</th>
                          <th scope="col">Distrito</th>
                          <th scope="col">Congegración</th>
                          <th scope="col">Puntaje</th>
                          <th scope="col">Tiempo</th>                                                                                     
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="jugador in aux_listado" >
                            <td v-text="jugador[0]"></td>
                            <td v-text="jugador[1].correo"></td>
                            <td v-text="jugador[1].nombre"></td>
                            <td >
                              <img  :src="jugador[1].foto_url" v-if="jugador[1].foto_url != '' && jugador[1].foto_url != null">
                            </td>
                            <td v-text="aux_listado2[jugador[1].sede]"></td>
                            <td v-text="jugador[1].sede"></td>
                            <td v-text="jugador[1].puntaje"></td>
                            <td v-text="jugador[1].tiempo"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modalSiembra" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modalSiembraLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalSiembralLabel">Datos Torneo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">                                
                <div class="container row">                  
                  <div class="form-group row   col-12 te0xt-left">
                    <label for="texto" class="col-2 ">Titulo Torneo</label>
                    <div class="col-10 ">                      
                      <input class="form-control" type="text" id="texto" v-model="form.texto">
                    </div>
                  </div>
                  <div class="form-group row   col-12 te0xt-left">
                    <label for="fecha_inicio" class="col-2 ">Fecha inicio</label>
                    <div class="col-10 ">                      
                      <input class="form-control" type="datetime-local" id="fecha_inicio" v-model="form.fecha_inicio">
                    </div>
                  </div>
                  <div class="form-group row   col-12 te0xt-left">
                    <label for="fecha_fin" class="col-2 ">Fecha Fin</label>
                    <div class="col-10 ">                      
                      <input class="form-control" type="datetime-local" id="fecha_fin" v-model="form.fecha_fin">
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
  import {fb_aux} from '../app';
import Axios from 'axios';
  
    
  Vue.component(HasError.name, HasError)
  Vue.component(AlertError.name, AlertError)
    export default {
        data() {
            return {
                listado: [],
                counter : 0,
                ban_abierto: 0,
                aux_listado: [],
                aux_listado2: {},
                aux_listado3: {},
                aux_test: [],
                aux_test2: [],
                aux_sedes: {},
                filtro_distrito: '',
                filtro_sede: '',
                aux_ganador: '',
                aux_nom_torneo: '',
                form:{
                  id:'',                  
                  fecha_fin:'',
                  fecha_inicio:'',
                  logo:'',
                  ganador:'',
                  texto:''   
                },
                aux_fi: '',
                aux_id_torneo: ''
            } 
        },
        methods: {           
            listar() {
              
              let me = this;
              me.counter = 1;
              me.listado = [];   

              me.aux_listado2 = {};

              me.ban_abierto = 0;
              me.aux_test= db.collection('torneos').get()
              .then((snapshot) => {
                const data = snapshot.docs.map((doc) => ({ 
                  data: doc.data(),
                  id: doc.id
                 }));
                //console.log("All data in 'books' collection", data); 
                data.forEach(doc_a => {
                  //console.log(doc_a.id);
                  if(doc_a.data.estado === true ){
                    me.ban_abierto = 1;
                  }
                  
                  me.listado.push([me.counter, doc_a.data, doc_a.id]);
                  me.counter =  parseInt(me.counter) + 1;
                })
              
              });

              me.aux_test2 = db.collection('sedes').get()
              .then((snapshot) => {
                const data = snapshot.docs.map((doc) => ({ 
                  data: doc.data(),
                  id: doc.id
                 }));
                //console.log("All data in 'books' collection", data); 
                data.forEach(doc_a => {
                  //onsole.log(doc_a.data);
                  me.aux_sedes[doc_a.data.nombre] =  doc_a.data.nombre;
                  me.aux_listado2[doc_a.data.nombre] =  doc_a.data.distrito;
                  me.aux_listado3[doc_a.data.distrito] =  doc_a.data.distrito;
                })
              
              });
            },     
              
            incrementar() {

              this.counter = parseInt(this.counter) + 1;
              return this.counter;
            },
            agregar() {
              
              //this.aux_fi = new Date("2016-07-25T00:00").getTime();
              this.form.id="";
              this.form.estado="true";
              this.form.fecha_fin="";
              this.form.fecha_inicio="";
              this.form.logo="Torneo 2.png";
              this.form.ganador="";
              this.form.texto="";    
              $('#modalSiembra').modal('show');
            },
            editar(obj_editar,id_edita) {                
                this.form.id = id_edita;
                this.form.torneo = obj_editar.torneo;                
                this.form.fecha_fin = obj_editar.fecha_fin;
                this.form.fecha_inicio = obj_editar.fecha_inicio;
                this.form.logo = obj_editar.logo;
                this.form.ganador = obj_editar.ganador;
                this.form.texto = obj_editar.texto;
                this.form.respuesta = obj_editar.respuesta;
                $('#modalSiembra').modal('show');
                
            },
            guardar () {
              let me = this;        
              let numeral_documento = "";
              //var aux_sp = this.form.fecha_inicio.split(" ");
              //var aux_sp2 = aux_sp[0].split("-")
              
              if(this.form.fecha_fin == '' || this.form.fecha_inicio == '' || this.form.texto == ''){
                alert("Debe diligenciar todos los campos");
              }
              else {
                if(this.form.fecha_fin < this.form.fecha_inicio )
                {
                  alert("La fecha fina debe ser mayor a la fecha final");
                }
                else {
                  var coleccion = db.collection('torneos')
                  .add({                    
                    estado: true,                    
                    fecha_fin: fb_aux.firestore.Timestamp.fromDate(new Date(""+this.form.fecha_fin)),
                    fecha_inicio: fb_aux.firestore.Timestamp.fromDate(new Date(""+this.form.fecha_inicio)),
                    gandor: '-',
                    logo: this.form.logo,
                    texto: this.form.texto,                    

                  })      
                  .then(function(docRef) {                                                        
                    me.listar();
                    $('#modalSiembra').modal('hide');
                  })  ;
                }
                
              }
              
            },
            get_list_players2() {
              this.get_list_players(this.aux_id_torneo);
            },
            get_list_players (id_torneo) {

              let me = this;
              me.aux_ganador = '';
              me.aux_listado = [];
              me.aux_id_torneo = id_torneo;
              var aux_lis= db.collection('torneos').doc(id_torneo)
                  .collection('jugadores')
                  .orderBy("puntaje","desc")
                  .orderBy("tiempo")                  
                  .get()
                  .then((snapshot) => {
                    const data = snapshot.docs.map((doc) => ({ 
                      data: doc.data(),
                      id: doc.id
                    }));
                    var aux_counter = 1;
                    data.forEach(doc_a => {
                      //console.log(doc_a.data.correo);
                      if((doc_a.data.correo == "" || doc_a.data.correo == null) && doc_a.data.sede != undefined ){
                        db.collection('torneos').doc(id_torneo).collection('jugadores').doc(doc_a.id).delete();
                      } else {     
                        if(me.filtro_distrito!='') {                                                    
                          if (doc_a.data.sede != undefined && me.aux_listado2[doc_a.data.sede] == me.filtro_distrito) {
                            if(me.filtro_sede == '') {
                              me.aux_listado.push([aux_counter, doc_a.data, doc_a.id]);   
                              aux_counter++;                 
                              if(me.aux_ganador == "") {me.aux_ganador = doc_a.data.nombre+" - "+doc_a.data.correo;}
                            } else {
                              console.log("entrando filtro sede = "+me.filtro_sede+" sede data ="+doc_a.data.sede);
                              if (doc_a.data.sede == me.filtro_sede) {
                                me.aux_listado.push([aux_counter, doc_a.data, doc_a.id]);   
                                aux_counter++;                 
                                if(me.aux_ganador == "") {me.aux_ganador = doc_a.data.nombre+" - "+doc_a.data.correo;}
                              }   
                            }
                            

                          } 
                        }
                        else{
                          
                          if(me.filtro_sede == '') {
                            me.aux_listado.push([aux_counter, doc_a.data, doc_a.id]);   
                            aux_counter++;                 
                            if(me.aux_ganador == "") { me.aux_ganador = doc_a.data.nombre+" - "+doc_a.data.correo;}
                          } else {
                            if (doc_a.data.sede != undefined && doc_a.data.sede == me.filtro_sede) {
                              me.aux_listado.push([aux_counter, doc_a.data, doc_a.id]);   
                              aux_counter++;                 
                              if(me.aux_ganador == "") { me.aux_ganador = doc_a.data.nombre+" - "+doc_a.data.correo;}
                            }
                          }
                        }                    
                        
                      }
                      
                    })
                    
                    
                  });
                  
            },

            ver_participantes (id_torneo, texto_torneo) {
              this.aux_nom_torneo = texto_torneo;
              this.get_list_players(id_torneo);
              
              $('#modalJuadores').modal('show');
            },

            inactivar(id_inact) {
              let me = this;
              this.get_list_players(id_inact);
              swal({
                title: "Estás seguro?",
                text: "Estas seguro de finalizar este torneo?",
                icon: "warning",
                buttons: ["Cancelar", "Aceptar"],
                dangerMode: true,
              })
              .then((willDelete) => { 
                  if(willDelete) {
                    db.collection('torneos').doc(id_inact).update({estado: false, ganador: me.aux_ganador})
                    .then(function() {                                  
                      me.listar();
                    });                
                  }
                  
                //location.reload();
              }) 
            },

            activar(id_act) {
              let me = this;
              db.collection('torneos').doc(id_act).update({estado: true}).then(function() {                                  
                me.listar();
                //location.reload();
              }) 
              
            }
        },
        mounted() {
            this.counter = 0;
            this.fechaEnMiliseg = Date.now();
            this.listar();        
            $('[data-toggle="tooltip"]').tooltip();    
            //console.log('Component mounted.')
        }
    }
</script>
