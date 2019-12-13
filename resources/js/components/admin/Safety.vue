<template>
      <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Safety & Education</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="safety in safeties" :key="safety.id">
                      <td>{{ safety.id}}</td>
                      <td>{{ safety.title}}</td>
                      <td>{{ safety.created_at}}</td>
                      <td>
                        <a class="btn btn-primary btn-sm" @click="editModal(safety)">
                          <i class="fas fa-edit"></i>
                        </a>
                        
                        <a class="btn btn-danger btn-sm" @click="deleteSafety(safety.id)">
                          <i class="fas fa-trash"></i>
                        </a>

                        <a class="btn btn-primary btn-sm" @click="viewDetails(safety)">
                                <i class="fas fa-eye"></i>
                              </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addSafety" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h5 v-show="!editMode" class="modal-title" id="addSafety">Add Safety & Education</h5>
                <h5 v-show="editMode" class="modal-title" id="addSafety">Update Safety & Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- Form -->
              <form @submit.prevent="editMode ? updateSafety() : createSafety()">
                <div class="modal-body">
                  <div class="form-group">
                    <input v-model="form.title" type="text" name="title" id="title" placeholder="Title"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                      <has-error :form="form" field="title"></has-error>
                  </div>
                  <div class="form-group">
                        <textarea v-model="form.description" name="description" id="description" placeholder="Description"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">

                        </textarea>
                        <has-error :form="form" field="description"></has-error>
                   </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button v-show="!editMode" type="submit" class="btn btn-primary">Add</button>
                  <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!--./modal-->
            <!-- Modal view Details -->
        <div class="modal fade" id="safetyDetails" tabindex="-1" role="dialog" aria-labelledby="safetyDetailsTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h5 class="modal-title" id="safetyDetailsTitle">Safety And Education Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                 <table class="table table-borderless table-sm">
                    <tbody>
                        <tr>
                            <th>Title</th>
                            <td id="s_title"></td>
                        </tr>

                        <tr>
                            <th>Description</th>
                            <td id="s_description" style="text-align:justify;"></td>
                        </tr>
                    </tbody>
                 </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!--/ Modal for view Details-->
   </div>
</template>

<script>
    export default {
        data(){
            return{
                editMode       : false,
                safeties : {},
                safety   : {},
                form: new Form({
                    id          : '',
                    title       : '',
                    description : ''
                })
            }
      },
      methods: {
           updateSafety(){
                this.form.put('api/safety/'+ this.form.id)
                    .then(() => {
                        $('#addSafety').modal('hide');
                        Toast.fire({
                            type: 'success',
                            title: 'Safety and Education Updated successfully'
                        });
                        this.loadSafeties();
                    })
                    .catch()
           },
           deleteSafety(id){
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {
                    axios.delete('api/safety/' +id).then(()=>{
                        Swal.fire(
                        'Deleted!',
                        'Safety and Education has been deleted.',
                        'success'
                        );
                        this.loadSafeties();
                    }).catch()
                }
                })
           },
           viewDetails(safety){
               this.safety = safety;
               let title    = document.getElementById("s_title");
               let description     = document.getElementById("s_description");

              title.innerHTML     = safety.title;
              description.innerHTML     = safety.description;

              $('#safetyDetails').modal('show');
           },
           editModal(safety){
                this.form.clear();
                this.editMode = true;
                this.form.reset();
                $('#addSafety').modal('show');
                this.form.fill(safety);
           },
           newModal(){
                this.form.clear();
                this.editMode = false;
                this.form.reset();
                $('#addSafety').modal('show');
           },
           createSafety(){
                this.form.post('api/safety')
                .then(() => {
                    this.loadSafeties();
                    $('#addSafety').modal('hide');

                    Toast.fire({
                        type: 'success',
                        title: 'Police Station created successfully'
                    });
                })
                .catch(()=>{

                    });
          
            },
            loadSafeties(){
              axios.get('api/safety').then(({ data }) => (this.safeties = data.data));
            },
      },
        created() {
            this.loadSafeties();
        }
    }
</script>
