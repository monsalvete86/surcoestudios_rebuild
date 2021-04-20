<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categorias</h3>

                        <div class="card-tools">
                             <button class="btn btn-success" @click="newModal">Empresa <i class="fas fa-categoria-plus fa-fw"></i></button>
                        </div>
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
                                    <th>Categoria</th>
                                    <th>Registrado el</th>
                                    <th>Modificado el</th>
                                    <th>Opciones</th>
                                </tr>
                                <tr v-for="categoria in categorias.data" :key="categoria.id">
                                    <td>{{categoria.id}}</td>
                                    
                                    <td>{{categoria.categoria}}</td>
                                    
                                    <td>{{categoria.created_at | myDate}}</td>
                                    <td>{{categoria.update_at | myDate}}</td>
                                    <td>
                                        <a href="#" @click="editModal(categoria)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteCategoria(categoria.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="categorias" @pagination-change-page="getResults"></pagination>
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
                    <form @submit.prevent="editmode ? updateCategoria() : createCategoria()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.categoria" type="text" categoria="categoria"
                                    placeholder="Categoria"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('categoria') }">
                                <has-error :form="form" field="categoria"></has-error>
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
                categorias : {},
                form: new Form({
                  id:'',
									categoria : ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get(this.$parent.ruta + 'api/categoria?page=' + page)
                .then(response => {
                    this.categorias = response.data;
                });
            },
            updateCategoria(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put(this.$parent.ruta + 'api/categoria/'+this.form.id)
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
            editModal(categoria){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(categoria);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteCategoria(id){
                swal({
									title: 'Are you sure?',
									text: "You won't be able to revert this!",
									type: 'warning',
									showCancelButton: true,
									confirmButtonColor: '#3085d6',
									cancelButtonColor: '#d33',
									confirmButtonText: 'Yes, delete it!'
								}).then((result) => {
									if (result.value) {
										this.form.delete(this.$parent.ruta + 'api/categoria/'+id).then(()=>{
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
            loadCategorias(){
                if(this.$gate.isAdminOrAuthor()){
                    axios.get(this.$parent.ruta +"api/categoria").then(({ data }) => (
                        this.categorias = data
                    ));
                }
            },

            createCategoria(){
                this.$Progress.start();

                this.form.post(this.$parent.ruta + 'api/categoria')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                    toast({
                        type: 'success',
                        title: 'Categoria Created in successfully'
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
                axios.get('api/findCategoria?q=' + query)
                .then((data) => {
                    this.categorias = data.data
                })
                .catch(() => {

                })
            })
           this.loadCategorias();
           Fire.$on('AfterCreate',() => {
               this.loadCategorias();
           });
        //    setInterval(() => this.loadCategorias(), 3000);
        }

    }
</script>
