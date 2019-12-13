<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Admins</h3>
                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal">
                    <i class="fas fa-user-plus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="admin_table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>User role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                      <td>{{ user.id}}</td>
                      <td>{{ user.name}}</td>
                      <td>{{ user.email}}</td>
                      <td>{{ user.type}}</td>
                      <td>
                        <a class="btn btn-primary btn-sm" @click="editModal(user)">
                          <i class="fas fa-edit"></i>
                        </a>
                        
                        <a href="" class="btn btn-danger btn-sm">
                          <i class="fas fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>                       
                    </tr>
                  </tfoot>
                </table>
              </div> 
              <!--Card footer-->
                    <!-- <div class="card-footer">
                      <pagination :data="users" @pagination-change-page="getResults"></pagination>
                    </div> -->

                    <!--/ .Card footer-->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h5 v-show="!editMode" class="modal-title" id="addAdminModal">Add New Admin</h5>
                <h5 v-show="editMode" class="modal-title" id="addAdminModal">Update Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- Form -->
              <form @submit.prevent="editMode ? updateUser() : createUser()">
                <div class="modal-body">
                  <div class="form-group">
                    <input v-model="form.name" type="text" name="name" id="name" placeholder="Name"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                      <has-error :form="form" field="name"></has-error>
                  </div>
                  <div class="form-group">
                    <input v-model="form.email" type="email" name="email" id="email" placeholder="Email"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                      <has-error :form="form" field="email"></has-error>
                  </div>
                  <div class="form-group">
                    <input v-model="form.password" type="password" name="password" id="password" placeholder="Password"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                      <has-error :form="form" field="password"></has-error>
                  </div>
                  <div class="form-group">
                    <select v-model="form.type" class="form-control" id="type"
                      :class="{ 'is-invalid': form.errors.has('type') }">
                      <option value="">Select Admin Type</option>
                      <option value="Super Admin">Super Admin</option>
                      <option value="Sub Admin">Sub Admin</option>
                    </select>
                    <has-error :form="form" field="type"></has-error>
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
          editMode: false,
          users : {},
          form: new Form({
            id       : '',
            name     : '',
            email    : '',
            password : '',
            type     : '',
            photo    : ''
          })
        }
      },
      methods: {
        // pagination
            // getResults(page = 1) {
            //   axios.get('api/user?page=' + page)
            //     .then(response => {
            //       this.users = response.data;
            //     });
            // },

        updateUser(){
          this.form.put('api/user/'+ this.form.id)
          .then(() => {
            $('#addAdminModal').modal('hide');
            Toast.fire({
                type: 'success',
                title: 'User Updated successfully'
              });
              Fire.$emit('afterCreate');
          })
          .catch()
        },
        editModal(user){
          this.form.clear();
          this.editMode = true;
          this.form.reset();
          $('#addAdminModal').modal('show');
          this.form.fill(user);
        },

        newModal(){
          this.form.clear();
          this.editMode = false;
          this.form.reset();
          $('#addAdminModal').modal('show');
        },

        loadUsers(){
          axios.get('api/user').then(({ data }) => {
            this.users = data;
            setTimeout(()=>{
              $('#admin_table').DataTable({
                "order": [[0, "desc"]],
                "bDestroy": true,
                "bRetrieve": true,

                  //Custom filter
                     initComplete: function () {
                      
                      this.api().columns([3]).every( function () {
                          var column = this;
                          var select = $('<select><option value="">Show all</option></select>')
                              .appendTo( $(column.footer()).empty() )
                              .on( 'change', function () {
                                  var val = $.fn.dataTable.util.escapeRegex(
                                      $(this).val()
                                  );
          
                                  column
                                      .search( val ? '^'+val+'$' : '', true, false )
                                      .draw();
                              } );
          
                          column.data().unique().sort().each( function ( d, j ) {
                              select.append( '<option value="'+d+'">'+d+'</option>' )
                          } );
                      } );
                  }
                  //end custom filter
                  
              });
             
                  
            } , 100);
            
            });
        },

        createUser(){
          this.form.post('api/user')
          .then(() => {
              Fire.$emit('afterCreate');
              $('#addAdminModal').modal('hide');

              Toast.fire({
                type: 'success',
                title: 'User created successfully'
              });
          })
           .catch(()=>{

            });
          
        }
      },
        created() {
           this.loadUsers();
           Fire.$on('afterCreate', () => {
             this.loadUsers();
           });
        }
    }
</script>
