<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Jugadores</div>

                    <div class="card-body">                        
                        <div class="row">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Correo</th>
                                  <th scope="col">Nombre</th>
                                  <th scope="col">Sede</th>
                                  <th scope="col">Max. Puntaje</th>
                                  <th scope="col">Mejor Tiempo</th>                                  
                                  <th scope="col">Ult. Torneo</th>
                                  <th scope="col">Pt. Ult. Torneo</th>
                                  <th scope="col">Mejor Tiempo Torneo</th>
                                  <th scope="col">Tiempo en Trivias</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr v-for="jugador in listado"  >
                                  <th>{{jugador[0]}}</th>                                  
                                  <th scope="row" v-text="jugador[1].correo"></th>
                                  <td v-text="jugador[1].nombre"></td>
                                  <td v-text="jugador[1].sede"></td>
                                  <td v-text="jugador[1].high_score"></td>
                                  <td v-text="jugador[1].menor_tiempo_high_score"></td>
                                  <td v-text="jugador[1].ultimo_torneo"></td>
                                  <td v-text="jugador[1].puntaje_ultimo_torneo"></td>
                                  <td v-text="jugador[1].menor_tiempo_ultimo_torneo"></td>
                                  <td v-text="jugador[1].tiempo_en_trivias"></td>                                  
                                </tr>
                              </tbody>
                            </table>
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
            }
        },
        methods: {           
            listar() {
              
              let me = this;
              me.counter = 1;
              db.collection('jugadores').orderBy("correo").get()
              .then((snapshot) => {
                const data = snapshot.docs.map((doc) => ({ 
                  data: doc.data(),
                  id: doc.id
                }));
                data.forEach(doc_a => {
                  if(doc_a.data.correo == "" || doc_a.data.correo == null) {
                    db.collection('jugadores').doc(doc_a.id).delete().then(function() {                  
                      
                    }).catch(function(error) {
                      //console.error("Error removing document: ", error);
                    });
                  } else {
                    me.listado.push([me.counter, doc_a.data, doc_a.id]);
                    me.counter =  parseInt(me.counter) + 1;
                  }
                 
                  
                })
              });
              
            },     
              
            incrementar() {

              this.counter = parseInt(this.counter) + 1;
              return this.counter;
            }
        },
        mounted() {
            this.counter = 0;
            this.listar();            
            //console.log('Component mounted.')
        }
    }
</script>
