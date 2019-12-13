<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Police Stations</h3>

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
                      <th>Police Station Name</th>
                      <th>State</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="policeStation in policeStations" :key="policeStation.id">
                      <td>{{ policeStation.id}}</td>
                      <td>{{ policeStation.name}}</td>
                      <td>{{ policeStation.district}}</td>
                      <td>{{ policeStation.email}}</td>
                      <td>{{ policeStation.contact}}</td>
                      <td>
                        <a class="btn btn-primary btn-sm" @click="editModal(policeStation)">
                          <i class="fas fa-edit"></i>
                        </a>
                        
                        <a class="btn btn-danger btn-sm" @click="deletePoliceStation(policeStation.id)">
                          <i class="fas fa-trash"></i>
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
        <div class="modal fade" id="addPoliceStation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h5 v-show="!editMode" class="modal-title" id="addPoliceStation">Add Police Station</h5>
                <h5 v-show="editMode" class="modal-title" id="addPoliceStation">Update Police Station</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- Form -->
              <form @submit.prevent="editMode ? updatePoliceStation() : createPoliceStation()">
                <div class="modal-body">
                  <div class="form-group">
                    <input v-model="form.name" type="text" name="name" id="name" placeholder="Police Station Name"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                      <has-error :form="form" field="name"></has-error>
                  </div>
                  <div class="form-group">
                    <input v-model="form.district" type="text" name="district" id="district" placeholder="State"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('district') }">
                      <has-error :form="form" field="district"></has-error>
                  </div>
                  <div class="form-group">
                    <input v-model="form.email" type="email" name="email" id="email" placeholder="Email"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                      <has-error :form="form" field="email"></has-error>
                  </div>

                  <div class="form-group">
                    <input v-model="form.contact" type="text" name="contact" id="contact" placeholder="Contact"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('contact') }">
                      <has-error :form="form" field="contact"></has-error>
                  </div>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button v-show="!editMode" type="submit" class="btn btn-primary">Add</button>
                  <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!--./modal-->
   </div>
</template>


<script>
    export default {
         data(){
            return{
                editMode       : false,
                policeStations : {},
                form: new Form({
                    id       : '',
                    name     : '',
                    district : '',
                    email    : '',
                    contact  : ''
                })
            }
      },
      methods: {
        //delete police station
         deletePoliceStation(id){
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
                  axios.delete('api/policeStation/' +id).then(()=>{
                    Swal.fire(
                      'Deleted!',
                      'Police Station has been deleted.',
                      'success'
                    );
                    this.loadPoliceStations();
                  }).catch()
              }
            })
          },
        updatePoliceStation(){
          this.form.put('api/policeStation/'+ this.form.id)
          .then(() => {
            $('#addPoliceStation').modal('hide');
            Toast.fire({
                type: 'success',
                title: 'Police Station Updated successfully'
              });
              Fire.$emit('afterCreate');
          })
          .catch()
        },
        editModal(policeStation){
          this.form.clear();
          this.editMode = true;
          this.form.reset();
          $('#addPoliceStation').modal('show');
          this.form.fill(policeStation);
        },

        newModal(){
          this.form.clear();
          this.editMode = false;
          this.form.reset();
          $('#addPoliceStation').modal('show');
        },

        loadPoliceStations(){
          axios.get('api/policeStation').then(({ data }) => (this.policeStations = data.data));
        },

        createPoliceStation(){
          this.form.post('api/policeStation')
          .then(() => {
              Fire.$emit('afterCreate');
              $('#addPoliceStation').modal('hide');

              Toast.fire({
                type: 'success',
                title: 'Police Station created successfully'
              });
          })
           .catch(()=>{

            });
          
        }
      },
    created() {
        this.loadPoliceStations();
        Fire.$on('afterCreate', () => {
            this.loadPoliceStations();
        });
      }
    }
</script>
