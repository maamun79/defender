<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Missing Persons</h3>

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
                <table class="table table-striped" id="missing_person_table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Photo</th>
                      <th>Gender</th>
                      <th>Missing From</th>
                      <th>Unique Identifiers</th>                   
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="missingPerson in missingPersons.data" :key="missingPerson.id">
                      <td>{{ missingPerson.id}}</td>
                      <td>{{ missingPerson.name}}</td>
                      <td>
                        <!-- img/criminal/{{criminal.photo}} -->
                       <!-- <img src="{{ asset('img/criminal/'.criminal.photo)}}" alt=""> -->
                       <!-- <img :src="getPhoto()" alt=""> -->
                           <img :src="'img/missingPerson/' + missingPerson.photo" alt="" id="criminalmImg">
                      </td>
                      <td> {{ missingPerson.gender}}</td>
                      <td> {{ missingPerson.missing_from}}</td>
                      <td> {{ missingPerson.unique_identifiers}}</td>
                      <td>
                        <span v-if="missingPerson.status == 'Active'" class="badge badge-success">{{ missingPerson.status}}</span>
                        <span v-if="missingPerson.status == 'Mute'" class="badge badge-danger">{{ missingPerson.status}}</span>
                        <a v-if="missingPerson.status == 'Mute'" class="btn btn-success btn-sm" @click="active(missingPerson.id)">Activate</a>
                        <a v-if="missingPerson.status == 'Active'" class="btn btn-danger btn-sm" @click="mute(missingPerson.id)">Mute</a>
                      </td>
                      <td>
                        <a class="btn btn-primary btn-sm" @click="editModal(missingPerson)">
                          <i class="fas fa-edit"></i>
                        </a>
                        
                        <a class="btn btn-danger btn-sm" @click="deleteMissingPerson(missingPerson.id)">
                          <i class="fas fa-trash"></i>
                        </a>
                        <router-link :to="{name: 'showMissingPerson', params:{id: missingPerson.id}}" class="btn btn-success btn-sm">
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
                <h5 v-show="!editMode" class="modal-title" id="addCriminalModel">Add Missing Person</h5>
                <h5 v-show="editMode" class="modal-title" id="addCriminalModel">Update Missing Person</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- Form -->
              <form @submit.prevent="editMode ? updateMissingPerson() :createMissingPerson()" enctype="multipart/form-data">

                  <div class="modal-body">

                      <div class="form-group">
                        <input v-model="form.name" type="text" name="name" id="name" placeholder="Missing Person Name" 
                           class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.dob" placeholder="Date of Birth" class="form-control" max="2019-11-30" type="text" onfocus="(this.type='date')" 
                          id="dob" name="dob" :class="{ 'is-invalid': form.errors.has('dob') }">
                        <has-error :form="form" field="dob"></has-error>
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
                        <input v-model="form.height" type="number" name="height" id="height" placeholder="Height (cm)" 
                          class="form-control" :class="{ 'is-invalid': form.errors.has('height') }">
                        <has-error :form="form" field="height"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.weight" type="text" name="weight" id="weight" placeholder="Weight" 
                          class="form-control" :class="{ 'is-invalid': form.errors.has('weight') }">
                        <has-error :form="form" field="weight"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.hair_color" type="text" name="hair_color" id="hair_color" placeholder="Hair Color" 
                          class="form-control" :class="{ 'is-invalid': form.errors.has('hair_color') }">
                        <has-error :form="form" field="hair_color"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.eye_color" type="text" name="eye_color" id="eye_color" placeholder="Eye Color" 
                          class="form-control" :class="{ 'is-invalid': form.errors.has('eye_color') }">
                        <has-error :form="form" field="eye_color"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.skin_color" type="text" name="skin_color" id="skin_color" placeholder="Skin Color"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('skin_color') }">
                        <has-error :form="form" field="skin_color"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.missing_from" type="text" name="missing_from" id="missing_from" placeholder="Missing From"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('missing_from') }">
                        <has-error :form="form" field="missing_from"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.clothing_description" type="text" name="clothing_description" id="clothing_description" placeholder="Clothing Description" 
                          class="form-control" :class="{ 'is-invalid': form.errors.has('clothing_description') }">
                        <has-error :form="form" field="clothing_description"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.unique_identifiers" type="text" name="unique_identifiers" id="unique_identifiers" placeholder="Unique Identifiers" 
                          class="form-control" :class="{ 'is-invalid': form.errors.has('unique_identifiers') }">
                        <has-error :form="form" field="unique_identifiers"></has-error>
                      </div>

                      <div class="form-group">
                        <input v-model="form.date_missing" type="text" name="date_missing" id="date_missing" placeholder="Missing Date" onfocus="(this.type='date')" 
                          class="form-control" :class="{ 'is-invalid': form.errors.has('date_missing') }">
                        <has-error :form="form" field="date_missing"></has-error>
                      </div>

                      <div class="form-group">
                            <textarea v-model="form.details" name="details" id="details" placeholder="Details"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('details') }">

                            </textarea>
                            <has-error :form="form" field="details"></has-error>
                       </div>

                      <div class="form-group">
                        <input type="file" v-on:change="upPhoto" name="photo" id="photo" placeholder="Photo" class="form-control"
                          :class="{ 'is-invalid': form.errors.has('photo') }">
                        <has-error :form="form" field="photo"></has-error>
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
    
    export default {
       data(){
        return{
          editMode: false,
          missingPersons : {},
          tableData:[],
          form: new Form({
            id                   : '',
            name                 : '',
            dob                  : '',
            gender               : '',
            height               : '',
            weight               : '',
            hair_color           : '',
            eye_color            : '',
            skin_color           : '',
            missing_from         : '',
            clothing_description : '',
            unique_identifiers   : '',
            date_missing         : '',
            details              : '',
            photo                : ''

          })
        }
      },
      methods: {
        //---------------file download-----------------
        
        //----------------end download-----------------
        //delete criminal
        deleteMissingPerson(id){
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
                  this.form.delete('api/missingPerson/' +id).then(()=>{
                    Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    );
                    this.loadMissingPersons();
                  }).catch()
              }
            })
        },
        //search status
        active(missing_person_id){
          let id = missing_person_id;
          // alert(id);
          axios.get('api/missingPersonActiveStatus/' +id)
          .then(this.loadMissingPersons())
          .catch()
        },
        mute(missing_person_id){
          let id = missing_person_id;
          // alert(id);
          axios.get('api/missingPersonMuteStatus/' +id)
          .then(this.loadMissingPersons())
          .catch()
        },

        updateMissingPerson(){
          this.form.put('api/missingPerson/'+ this.form.id)
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
        editModal(missingPerson){
          this.form.clear();
          this.editMode = true;
          this.form.reset();
          $('#addCriminalModel').modal('show');
          this.form.fill(missingPerson);
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

        loadMissingPersons(){
          axios.get('api/missingPerson').then(({ data }) => {
            this.missingPersons = data;
            setTimeout(()=>{
              $('#missing_person_table').DataTable({
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

        upPhoto(e){
          let file = e.target.files[0];
          // console.log(file);
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

        createMissingPerson(){
          this.form.post('api/missingPerson')
          .then(() => {
              this.loadMissingPersons();
              $('#addCriminalModel').modal('hide');

              Toast.fire({
                type: 'success',
                title: 'Missing Person profile created successfully'
              });

          })
           .catch(()=>{

            });
          
        }
      },
        created() {
            this.loadMissingPersons();
           Fire.$on('afterCreate', () => {
             this.loadMissingPersons();
           });
        }
    }
</script>
