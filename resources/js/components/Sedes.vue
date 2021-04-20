<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center col-sm-12">Sedes</div>

                    <div class="card-body">
                        <div class="row mb-1">
                            <div class="col-12 col-md-3 text-left ">
                                Distrito
                                <select class="form-control" @change="listar(3)" v-model="filtro_distrito">
                                    <option value=""></option>
                                    <option v-for="dist in distritos" :value="dist">{{dist}}</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3 text-left ">
                                Congregación
                                <input type="text" class="form-control" id="filtro_congregacion" v-model="filtro_congregacion" @keyup="listar(3)">
                            </div>
                            <div class="col-12 col-md-3 ">
                                <b>Registros:</b> {{cant_registros}} <br><b>Paginas :</b> {{cant_pag}}                                 
                            </div>
                            <div class="col-12 col-md-3 text-right ">
                              <button class="btn btn-success" @click="abrirCrear()">Añadir sede</button>
                             
                            </div>
                        </div>
                        <div class="row"> 
                            <table class="table table-striped table-sm">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Distrito</th>
                                  <th scope="col">Congregación</th>
                                  <th scope="col">Departamento</th>
                                  <th scope="col">Ciudad</th>
                                  <th scope="col">Estado</th>
                                  <th scope="col">Eliminar</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr v-for="(sede, index) in listado" :key="index">
                                  <th scope="row" v-text="sede[0]"></th>
                                  <td v-text="sede[1].distrito"></td>
                                  <td v-text="sede[1].nombre"></td>
                                  <td v-text="sede[1].departamento"></td>
                                  <td v-text="sede[1].ciudad"></td>
                                  <td v-if="sede[1].estado == true">Activa</td>
                                  <td v-else>Inactiva</td>
                                  <td>
                                    <button @click="eliminar(sede[2])" class="btn btn-danger" type="button">
                                      <i class="fas fa-trash"></i>
                                    </button>
                                  </td>
                                </tr>
                              </tbody>
                            </table>                            
                            <nav aria-label="Page navigation example">
                              <ul class="pagination justify-content-center">
                                <li class="page-item" v-if="pagina>1" @click="listar(1)">
                                  <a class="page-link" href="#" tabindex="-1">Ant</a>
                                </li>
                                <li class="page-item" v-if="cant_pag>1">                    
                                  <input type="number" v-model="pagina" class="form-control" :max="cant_pag" min="1" @keyup="listar(3)">
                                </li>                                
                                <li class="page-item" v-if="pagina < cant_pag">
                                  <a class="page-link"  href="#" @click="listar(2)">Sig</a>
                                </li>
                                <li v-if="error_lim" class="page-item">

                                </li>
                              </ul>
                            </nav>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalSedes" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modalSedesLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalSedesLabel" v-text="'Crear congregación'"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form @submit.prevent="guardar()">
                  <div class="form-group row">
                    <label for="distrito" class="col-sm-12 col-md-4 col-form-label">Distrito</label>
                    <div class="col-sm-12 col-md-8">
                      <input type="text" class="form-control" id="distrito"  :class="{ 'is-invalid': form.errors.has('distrito') }" v-model="form.distrito" @keyup="bucar_sugerencias">
                     
                       <has-error :form="form" field="distrito"></has-error>
                    </div>
                  </div>
                  <div class="form-group row" v-if="buscando == 1">
                    <ul class="list-group col-12 ml-2">                      
                        <li class="list-group-item col-form-label" style="cursor:pointer"  v-for="distr  in distritos_busqueda" @click="select_distri(distr)">{{distr}}</li>
                      </ul>
                  </div>
                  <div class="form-group row">
                    <label for="sede" class="col-sm-12 col-md-4 col-form-label">Nombre Congregación</label>
                    <div class="col-sm-12 col-md-8">
                      <input type="text" class="form-control" id="sede"  :class="{ 'is-invalid': form.errors.has('sede') }" v-model="form.nombre">
                       <has-error :form="form" field="sede"></has-error>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="departamento" class="col-sm-12  col-md-4 col-form-label">Departamento</label>
                    <div class="col-sm-12 col-md-8">
                      <input type="text" class="form-control" id="departamento"  :class="{ 'is-invalid': form.errors.has('departamento') }" v-model="form.departamento">
                       <has-error :form="form" field="departamento"></has-error>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="ciudad" class="col-sm-12 col-md-4 col-form-label">Ciudad</label>
                    <div class="col-sm-12 col-md-8">
                      <input type="text" class="form-control" id="ciudad"  :class="{ 'is-invalid': form.errors.has('ciudad') }" v-model="form.ciudad">
                       <has-error :form="form" field="ciudad"></has-error>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label for="estado" class="col-sm-12 col-md-4 col-form-label">Estado</label>
                    <!-- <has-error :form="form" field="sede"></has-error> -->
                    <div class="col-sm-12 col-md-8">
                      <select class="form-control" id="estado " :class="{ 'is-invalid': form.errors.has('estado') }" v-model="form.estado">
                      <option value="true">Activa</option>
                      <option value="false">Inactiva</option>              
                    </select>
                       <has-error :form="form" field="sede"></has-error>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 text-right">
                      <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary btn-lg"  v-text="'Crear'"></button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">               
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
                form: new Form({
                    id : '',
                    nombre : '',
                    departamento : '',
                    ciudad : '',
                    distrito : '',
                    estado :''
                }),
                distritos: {},
                distritos2: [],
                distritos_busqueda: {},
                listado: [],
                aux2: [],
                counter:0,
                buscando : 0,
                filtro_distrito: '',
                filtro_congregacion: '',
                anterior: [],
                pagina: 1,
                cant_registros : 0,
                cant_pag: 0,
                siguiente: [],
                ultimo : 0,
                error_lim: 0
                
            }
        },
        methods: {
            cargarCedes() {
            
            },
            closeSugest() {
              this.buscando = 0;
            },
            
            bucar_sugerencias () {
              var n;
              this.distritos_busqueda={};
              
              var cont = 0;
              for(var i = 0; i <this.distritos2.length; i++) {
                
                if(cont<10) {
                  
                  var test  = this.distritos2[i].toLowerCase().search(this.form.distrito.toLowerCase());
                  console.log(" val = "+this.distritos2[i]+" test="+test+" cont="+cont);
                  if( parseInt(test) >= 0) {
                    this.distritos_busqueda[this.distritos2[i]] = this.distritos2[i];
                    cont++;
                  }
                }
              }
             /* this.distritos2.forEach(elm => {
                var test  = elm.search(this.form.distrito);
                
                if( parseInt(test) >= 0) {
                  this.distritos_busqueda[elm] = elm;
                }
              });*/
              this.buscando = 1;
            },
            select_distri (distri) {
              this.form.distrito = distri;
              this.buscando = 0;
            },
            
            
            listar_inicial() {
              let me = this;

              me.counter = 1;
              me.aux2 = [] ;
              me.listado = [];
              var aux_s;
              var aux_s2 = db.collection('sedes')                  
              .get()
              .then( res => {
                me.cant_registros = res.size; 
                me.cant_pag = Math.ceil((me.cant_registros / 10));
              }); 

              aux_s= db.collection('sedes')
              .limit(10)
              .orderBy("distrito")
              .orderBy("nombre");

              aux_s.get()
              .then((snapshot) => {            
                //me.cant_pag = 
                var ban = 0;
                
                console.log(snapshot.docs);
                snapshot.forEach(doc => {                    
                  me.siguiente = snapshot.docs[snapshot.docs.length-1];                
                  me.listado.push([me.counter, doc.data(),doc.id]);                  
                  me.counter =  parseInt(me.counter) + 1;
                  //me.anterior = snapshot.docs[snapshot.docs.length+1];
                })
              
              });
            },




            listar(tipo){
              let me = this;
              console.log("tipo" + tipo);
              if(tipo == 1 ) { 
                me.pagina = me.pagina -1 ;
                me.counter= me.pagina * 10;
              }
              if(tipo == 2 ) { 
                me.pagina++;
                me.counter= me.pagina * 10;
              }
              if(tipo == 3 ) { 
                me.pagina = 1;
                me.counter = 1;
                
              }
              if(me.pagina> me.cant_registros) {me.pagina = me.cant_registros;}
              
              me.aux2 = [] ;
              me.listado = [];
              var aux_s;
              var ban_limpio = 0;
              if(me.filtro_distrito != '') {
                if(me.filtro_congregacion!=''){
                  var aux_s2 = db.collection('sedes')
                  .where('distrito','==',me.filtro_distrito)   
                  .orderBy("nombre")                                 
                  .startAt(me.filtro_congregacion.toUpperCase()).endAt(me.filtro_congregacion.toUpperCase()+'\uf8ff')                  
                  .get()
                  .then( res => {
                    me.cant_registros = res.size; 
                    me.cant_pag = Math.ceil((me.cant_registros / 10));
                  }); 

                  aux_s= db.collection('sedes')
                    .where('distrito','==',me.filtro_distrito)
                    .orderBy("nombre")
                    .startAt(me.filtro_congregacion.toUpperCase()).endAt(me.filtro_congregacion.toUpperCase()+'\uf8ff')
                    .startAfter(10 * (me.pagina - 1))
                    .limit(10);
                    
                } else {
                  var aux_s2 = db.collection('sedes')
                  .where('distrito','==',me.filtro_distrito)   
                  .orderBy("nombre")                                                   
                  .get()
                  .then( res => {
                    me.cant_registros = res.size; 
                    me.cant_pag = Math.ceil((me.cant_registros / 10));
                  }); 

                  aux_s= db.collection('sedes')
                    .where('distrito','==',me.filtro_distrito)
                    .orderBy("nombre")
                    .startAfter(10 * (me.pagina - 1))
                    .limit(10);
                    
                }
              } else {

                if(me.filtro_congregacion != ''){        
                  
                  var aux_s2 = db.collection('sedes')
                  .where('estado','==', true)                  
                  .orderBy("nombre")
                  .startAt(me.filtro_congregacion.toUpperCase()).endAt(me.filtro_congregacion.toUpperCase()+'\uf8ff')
                  .get()
                  .then( res => {
                    me.cant_registros = res.size; 
                    me.cant_pag = Math.ceil((me.cant_registros / 10));
                  }); 

                  aux_s= db.collection('sedes')                
                    .where('estado','==', true)                
                  
                    .orderBy("nombre")
                    .startAt(me.filtro_congregacion.toUpperCase()).endAt(me.filtro_congregacion.toUpperCase()+'\uf8ff')
                    .startAfter(10 * (me.pagina - 1))
                    .limit(10);
                    
                } else {                

                  var aux_s2 = db.collection('sedes')                  
                  .orderBy("nombre")                                                   
                  .get()
                  .then( res => {
                    me.cant_registros = res.size; 
                    me.cant_pag = Math.ceil((me.cant_registros / 10));
                  });

                  aux_s= db.collection('sedes')
                        .limit(10)
                        .orderBy("distrito")
                        .orderBy("nombre")
                        .startAfter(10 * (me.pagina - 1));
                }
              }

              aux_s.get()
              .then((snapshot) => {            
                //me.cant_pag = 
                var ban = 0;
                
                console.log(snapshot.docs);
                snapshot.forEach(doc => {                    
                  me.siguiente = snapshot.docs[snapshot.docs.length-1];                
                  me.listado.push([me.counter, doc.data(),doc.id]);                  
                  me.counter =  parseInt(me.counter) + 1;
                  
                  me.anterior = snapshot.docs[snapshot.docs.length+1];
                })
              
              });
            },
            cambia_pag() {
              let me = this;              
              me.listado = [];              
              var aux_s;      
                      
              if(me.filtro_distrito != '') {
                if(me.filtro_congregacion!=''){
                  
                  aux_s= db.collection('sedes')
                    .where('distrito','==','distrito')
                    .orderBy("nombre")
                    .startAt(me.filtro_congregacion.toUpperCase()).endAt(me.filtro_congregacion.toUpperCase()+'\uf8ff')
                    .limit(10);
                    
                } else {
                  aux_s= db.collection('sedes')
                        .where('distrito','==',me.filtro_distrito)
                        .limit(10)
                        .orderBy("nombre")
                        .startAfter(me.siguiente);
                }
              } else {
                if(me.filtro_congregacion != ''){
                  console.log("entrendo");
                  aux_s= db.collection('sedes')     
                    .where('estado','==', true)
                    .orderBy("nombre")
                    .startAt(me.filtro_congregacion.toUpperCase()).endAt(me.filtro_congregacion.toUpperCase()+'\uf8ff')
                    .limit(10);
                    
                } else {
                  aux_s= db.collection('sedes')
                          .limit(10)
                          .orderBy("distrito")
                          .orderBy("nombre")
                          .startAfter(me.siguiente);
                }
              }
              aux_s.get()
              .then((snapshot) => {            
                var aux_f = 0;
                snapshot.forEach(doc => {             
                  if(aux_f == 0){

                  }     
                  me.siguiente = snapshot.docs[snapshot.docs.length-1];                
                  me.listado.push([me.counter, doc.data(),doc.id]);                  
                  me.counter =  parseInt(me.counter) + 1;
                  me.anterior = snapshot.docs[snapshot.docs.length+1];
                })
              
              })
              .then(() => {
                var aux_s2
                if(me.filtro_distrito != '') {
                  if(me.filtro_congregacion!=''){
                  
                    aux_s2= db.collection('sedes')
                      .where('distrito','==',me.filtro_distrito)
                      .orderBy("nombre")
                      .startAt(me.filtro_congregacion.toUpperCase()).endAt(me.filtro_congregacion.toUpperCase()+'\uf8ff')
                      .limit(10);
                      
                  } else {
                    aux_s2 = db.collection('sedes')
                          .where('distrito','==',me.filtro_distrito)
                          .limit(10)
                          .orderBy("nombre")
                          .startAfter(me.siguiente);
                  }
                } else {
                  if(me.filtro_congregacion != ''){
                    aux_s= db.collection('sedes')                    
                    .where('estado','==', true)
                    .orderBy("nombre")
                    .startAt(me.filtro_congregacion.toUpperCase()).endAt(me.filtro_congregacion.toUpperCase()+'\uf8ff')
                      .limit(10);
                      
                  } else {
                    aux_s2 = db.collection('sedes')
                            .limit(10)
                            .orderBy("distrito")
                            .orderBy("nombre")
                            .startAfter(me.siguiente);
                  }
                }
                aux_s2.get()
                .then( query => { 
                  if(query.empty) {
                    me.ultimo == 1;
                  }
                });

              });
            },
            
            sig_pag() {
              let me = this;
              me.aux2 = [] ;
              me.listado = [];
              me.pagina++;
              var aux_s;              
              if(me.filtro_distrito != '') {
                if(me.filtro_congregacion!=''){
                  
                  aux_s= db.collection('sedes')
                    .where('distrito','==','distrito')
                    .orderBy("nombre")
                    .startAt(me.filtro_congregacion.toUpperCase()).endAt(me.filtro_congregacion.toUpperCase()+'\uf8ff')
                    .limit(10);
                    
                } else {
                  aux_s= db.collection('sedes')
                        .where('distrito','==',me.filtro_distrito)
                        .limit(10)
                        .orderBy("nombre")
                        .startAfter(me.siguiente);
                }
              } else {
                if(me.filtro_congregacion != ''){
                  console.log("entrendo");
                  aux_s= db.collection('sedes')     
                    .where('estado','==', true)
                    .orderBy("nombre")
                    .startAt(me.filtro_congregacion.toUpperCase()).endAt(me.filtro_congregacion.toUpperCase()+'\uf8ff')
                    .limit(10);
                    
                } else {
                  aux_s= db.collection('sedes')
                          .limit(10)
                          .orderBy("distrito")
                          .orderBy("nombre")
                          .startAfter(me.siguiente);
                }
              }
              aux_s.get()
              .then((snapshot) => {            
                var aux_f = 0;
                snapshot.forEach(doc => {             
                  if(aux_f == 0){

                  }     
                  me.siguiente = snapshot.docs[snapshot.docs.length-1];                
                  me.listado.push([me.counter, doc.data(),doc.id]);                  
                  me.counter =  parseInt(me.counter) + 1;
                  me.anterior = snapshot.docs[snapshot.docs.length+1];
                })
              
              })
              .then(() => {
                var aux_s2
                if(me.filtro_distrito != '') {
                  if(me.filtro_congregacion!=''){
                  
                    aux_s2= db.collection('sedes')
                      .where('distrito','==',me.filtro_distrito)
                      .orderBy("nombre")
                      .startAt(me.filtro_congregacion.toUpperCase()).endAt(me.filtro_congregacion.toUpperCase()+'\uf8ff')
                      .limit(10);
                      
                  } else {
                    aux_s2 = db.collection('sedes')
                          .where('distrito','==',me.filtro_distrito)
                          .limit(10)
                          .orderBy("nombre")
                          .startAfter(me.siguiente);
                  }
                } else {
                  if(me.filtro_congregacion != ''){
                    aux_s= db.collection('sedes')                    
                    .where('estado','==', true)
                    .orderBy("nombre")
                    .startAt(me.filtro_congregacion.toUpperCase()).endAt(me.filtro_congregacion.toUpperCase()+'\uf8ff')
                      .limit(10);
                      
                  } else {
                    aux_s2 = db.collection('sedes')
                            .limit(10)
                            .orderBy("distrito")
                            .orderBy("nombre")
                            .startAfter(me.siguiente);
                  }
                }
                aux_s2.get()
                .then( query => { 
                  if(query.empty) {
                    me.ultimo == 1;
                  }
                });

              });
            },
            listar_distritos() {
              let me = this;
               me.aux_test= db.collection('distritos').orderBy("distrito").get()
              .then((snapshot) => {
                const data = snapshot.docs.map((doc) => ({ 
                  data: doc.data(),
                  id: doc.id
                 }));
                //console.log("All data in 'books' collection", data); 
                data.forEach(doc_a => {
                  me.distritos[doc_a.data.distrito] = doc_a.data.distrito;
                  me.distritos2.push(doc_a.data.distrito);

                  
                })
              
              });
            },
            
            incrementar() {

              this.counter = parseInt(this.counter) + 1;
              return this.counter;
            },
            guardar(){
              let me = this;
              
              db.collection("sedes").add({
                  nombre: me.form.nombre,
                  departamento: me.form.departamento,
                  ciudad: me.form.ciudad,
                  estado : me.form.estado,
                  distrito : me.form.distrito
              })
              .then(function() {
                location.reload();
                $('#modalSedes').modal('hide');
              })

              me.form.nombre = '',
              me.form.departamento = '',
              me.form.distrito = '',
              me.form.ciudad = '',
              me.form.estado = ''

            },
            abrirCrear(){
                this.editando = 0;
                this.form.reset(); 
                $('#modalSedes').modal('show');
            },
            
            eliminar(id){
              
                let me = this;
                swal({
                  title: "Estás seguro?",
                  text: "Una vez eliminado, no se puede recuperar este registro",
                  icon: "warning",
                  buttons: ["Cancelar", "Aceptar"],
                  dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                      //  if(confirm('Esta seguro de eliminar este registro?'+id)) {
                        db.collection('sedes').doc(id).delete().then(function() {                  
                        console.log(id);
                        // me.listar();
                          location.reload();
                        })                        
                    }
                });
                 
            }
        },
        mounted() {
          
          

            this.listar_distritos();
            this.listar_inicial();
        }
    }
</script>
