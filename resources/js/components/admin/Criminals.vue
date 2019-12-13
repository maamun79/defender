<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Offenders</h3>

                <div class="card-tools">
                  <button class="btn btn-warning" @click="exportCSV">
                    <i class="fas fa-file-download"></i>
                  </button>
                  <button class="btn btn-success" @click="newModal">
                    <i class="fas fa-user-plus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-striped" id="crm_table_data">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Photo</th>
                      <th>Address</th>
                      <th>State</th>
                      <th>Current Status</th>
                      <th>Search Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="criminal in criminals.data" :key="criminal.id">
                      <td>{{ criminal.id}}</td>
                      <td>{{ criminal.name}}</td>
                      <td>
                        <!-- img/criminal/{{criminal.photo}} -->
                       <!-- <img src="{{ asset('img/criminal/'.criminal.photo)}}" alt=""> -->
                       <!-- <img :src="getPhoto()" alt=""> -->
                           <img :src="'img/criminal/' + criminal.photo" alt="" id="criminalmImg">
                      </td>
                      <td> {{ criminal.residence}}</td>
                      <td> {{ criminal.state}}</td>
                      <td> {{ criminal.current_status}}</td>
                      <td>
                        <span v-if="criminal.search_status == 'Active'" class="badge badge-success">{{ criminal.search_status}}</span>
                        <span v-if="criminal.search_status == 'Muted'" class="badge badge-danger">{{ criminal.search_status}}</span>
                        <a v-if="criminal.search_status == 'Muted'" class="btn btn-success btn-sm" @click="active(criminal.id)">Activate</a>
                        <a v-if="criminal.search_status == 'Active'" class="btn btn-danger btn-sm" @click="mute(criminal.id)">Mute</a>
                      </td>
                      <td>
                        <a class="btn btn-primary btn-sm" @click="editModal(criminal)">
                          <i class="fas fa-edit"></i>
                        </a>
                        
                        <a class="btn btn-danger btn-sm" @click="deleteCriminal(criminal.id)">
                          <i class="fas fa-trash"></i>
                        </a>
                        <router-link :to="{name: 'showCriminal', params:{id: criminal.id}}" class="btn btn-success btn-sm">
                          <i class="fas fa-eye"></i>
                        </router-link>
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
                        <th></th>
                        <th></th>
                        <th></th>
                        
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- modal -->
        <div class="modal fade" id="addCriminalModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h5 v-show="!editMode" class="modal-title" id="addCriminalModel">Add Offender</h5>
                <h5 v-show="editMode" class="modal-title" id="addCriminalModel">Update Offender</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- Form -->
              <form @submit.prevent="editMode ? updateCriminal() :createCriminal()" enctype="multipart/form-data">

                  <div class="modal-body">

                      <div class="form-group">
                        <input v-model="form.name" type="text" name="name" id="name" placeholder="Name" 
                           class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.dob" placeholder="Date of Birth" class="form-control" type="text" onfocus="(this.type='date')" 
                          id="dob" name="dob" :class="{ 'is-invalid': form.errors.has('dob') }">
                        <has-error :form="form" field="dob"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.nid" type="text" name="nid" id="nid" placeholder="NID Number"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('nid') }">
                        <has-error :form="form" field="nid"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.residence" type="text" name="residence" id="residence" placeholder="Address" 
                          class="form-control" :class="{ 'is-invalid': form.errors.has('residence') }">
                        <has-error :form="form" field="residence"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.state" type="text" name="state" id="state" placeholder="State" 
                          class="form-control" :class="{ 'is-invalid': form.errors.has('state') }">
                        <has-error :form="form" field="state"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.skin_color" type="text" name="skin_color" id="skin_color" placeholder="Skin Color"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('skin_color') }">
                        <has-error :form="form" field="skin_color"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.hair_color" type="text" name="hair_color" id="hair_color" placeholder="Hair Color" 
                          class="form-control" :class="{ 'is-invalid': form.errors.has('hair_color') }">
                        <has-error :form="form" field="hair_color"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.height" type="number" name="height" id="height" placeholder="Height (cm)" 
                          class="form-control" :class="{ 'is-invalid': form.errors.has('height') }">
                        <has-error :form="form" field="height"></has-error>
                      </div>

                      <div class="form-group"> <p>Gender : 
                        <label class="radio-inline">
                          <input v-model="form.gender" type="radio" value="male" id="gender" name="gender"
                            :class="{ 'is-invalid': form.errors.has('gender') }">Male
                          <has-error :form="form" field="gender"></has-error>
                        </label>
                        <label class="radio-inline">
                          <input v-model="form.gender" type="radio" value="female" id="gender" name="gender"
                            :class="{ 'is-invalid': form.errors.has('gender') }">Female
                          <has-error :form="form" field="gender"></has-error>
                        </label> </p>
                      </div>

                      <div class="form-group">
                            <select v-model="form.current_threat_level" class="form-control" id="current_threat_level" 
                             :class="{ 'is-invalid': form.errors.has('current_threat_level') }">
                              <option value="">Select Current Threat Level</option>
                              <option value="Low">Low</option>
                              <option value="Medium">Medium</option>
                              <option value="High">High</option>
                            </select>
                            <has-error :form="form" field="current_threat_level"></has-error>
                      </div>

                      <div class="form-group">
                            <select v-model="form.current_status" class="form-control" id="current_status"
                              :class="{ 'is-invalid': form.errors.has('current_status') }">
                              <option value="">Select Current Status</option>
                              <option value="Detained">Detained</option>
                              <option value="Free">Free</option>
                              <option value="Most Wanted">Most Wanted</option>
                            </select>
                            <has-error :form="form" field="current_status"></has-error>
                      </div>

                      <div class="form-group">
                        <input type="file" @change="upPhoto" name="photo" id="photo" placeholder="Photo" class="form-control"
                          :class="{ 'is-invalid': form.errors.has('photo') }">
                        <has-error :form="form" field="photo"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.registration_ending_date" placeholder="Registration Ending Date" class="form-control" type="text" onfocus="(this.type='date')" 
                          id="registration_ending_date" name="registration_ending_date" :class="{ 'is-invalid': form.errors.has('registration_ending_date') }">
                        <has-error :form="form" field="registration_ending_date"></has-error>
                      </div>
                      

                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button v-show="!editMode" type="submit" class="btn btn-primary">Add</button>
                    <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
                    
                  </div>
              </form>
              <!--./form-->
            </div>
          </div>
        </div>
        <!-- /.modal -->
    </div>
</template>


<script>
import JQuery from 'jquery';
var $ = JQuery;
import dt from 'datatables.net';
    //  window.addEventListener("load",()=>{
    //   $(document).ready( function () {
    //    $('#crm_table').DataTable();
    //   } );

    //  }, false);
    
    export default {
       data(){
        return{
          editMode: false,
          criminals : {},
          tableData:[],
          form: new Form({
            id                       : '',
            name                     : '',
            dob                      : '',
            nid                      : '',
            residence                : '',
            skin_color               : '',
            hair_color               : '',
            height                   : '',
            gender                   : '',
            current_threat_level     : '',
            current_status           : '',
            photo                    : '',
            registration_ending_date : '',
            state                    : ''



          })
        }
      },
      methods: {
        //delete criminal
        deleteCriminal(id){
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
                  this.form.delete('api/criminal/' +id).then(()=>{
                    Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    );
                    this.loadCriminals();
                  }).catch()
              }
            })
        },
        //search status
        active(crmid){
          let id = crmid;
          // alert(id);
          axios.get('api/activeStatus/' +id)
          .then(this.loadCriminals())
          .catch()
        },
        mute(crmid){
          let id = crmid;
          // alert(id);
          axios.get('api/muteStatus/' +id)
          .then(this.loadCriminals())
          .catch()
        },
         // pagination
        getResults(page = 1) {
          axios.get('api/criminal?page=' + page)
            .then(response => {
              this.criminals = response.data;
            });
        },

        updateCriminal(){
          this.form.put('api/criminal/'+ this.form.id)
          .then(() => {
            $('#addCriminalModel').modal('hide');
            Toast.fire({
                type: 'success',
                title: 'Criminal Info Updated successfully'
              });
              Fire.$emit('afterCreate');
          })
          .catch()
        },
        editModal(criminal){
          this.form.clear();
          this.editMode = true;
          this.form.reset();
          $('#addCriminalModel').modal('show');
          this.form.fill(criminal);
        },
        exportCSV(){
          var rows = this.tableData;

            let csvContent = "data:text/csv;charset=utf-8,";

            rows.forEach(function(rowArray) {
                let row = rowArray.join(",");
                csvContent += row + "\r\n";
            });
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "my_data.csv");
            document.body.appendChild(link); // Required for FF

            link.click();
        },

        newModal(){
          this.form.clear();
          this.editMode = false;
          this.form.reset();
          $('#addCriminalModel').modal('show');
        },
        // getPhoto(){
        //   return "img/criminal/"+ this.criminals.photo;
        // },

        loadCriminals(){
          axios.get('api/criminal').then(({ data }) => {
            this.criminals = data;
            setTimeout(()=>{
              var tableData=[
                  [
                    'id' , 'name' , 'dob', 'nid', 'address', 'state','skin color',
                  'hair color', 'height', 'gender', 'current Threat level',
                  'current status', 'registration ending date'
                  ]
              ];
              data.data.forEach(info => {
                tableData.push([
                      info.id, 
                      info.name,
                      info.dob,
                      info.nid,
                      info.residence,
                      info.state,
                      info.skin_color,
                      info.hair_color,
                      info.height,
                      info.gender,
                      info.current_threat_level,
                      info.current_status,
                      info.registration_ending_date
                    ]);
              });
              this.tableData=tableData;
              $('#crm_table_data').DataTable({
                "order": [[0, "desc"]],
                "bDestroy": true,
                "bRetrieve": true,

                  //Custom filter
                     initComplete: function () {
                      
                      this.api().columns([4,5]).every( function () {
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

        upPhoto(e){
          let file = e.target.files[0];
          console.log(file);
          let reader = new FileReader();
          if(file['type'] == 'image/png' || file['type'] == 'image/jpg' || file['type'] == 'image/jpeg'){
              reader.onloadend = (file) => {
              // console.log('RESULT', reader.result);
              this.form.photo = reader.result;
              }
              reader.readAsDataURL(file);

          }else{
              Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Allowed image type png,jpg,jpeg'
              });
              
          }

        },

        createCriminal(){
          this.form.post('api/criminal')
          .then(() => {
              this.loadCriminals();
              $('#addCriminalModel').modal('hide');

              Toast.fire({
                type: 'success',
                title: 'Criminal profile created successfully'
              });

          })
           .catch(()=>{

            });
          
        }
      },
        created() {
            this.loadCriminals();
           Fire.$on('afterCreate', () => {
             this.loadCriminals();
           });
        }
    }
</script>
