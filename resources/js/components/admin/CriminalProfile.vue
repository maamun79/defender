<template>
    <div class="container">
        <h3 v-if="criminals.current_status == 'Most Wanted'"
          style="text-align:center; margin-top:20px;">
          <strong>
            <div class="warn-sign">
              <span style="color: red;">
                <i class="fas fa-exclamation-triangle"></i>
              </span>
              {{criminals.current_status}}
            </div>
          </strong>
        </h3>
        <div class="row">
            
            <div class="col-md-6">
                <img :src="'img/criminal/' + criminals.photo" alt="" id="criminalProfileImg">
            </div>
            <div class="col-md-6" id="criminal-info">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{criminals.name}}</td>
                        </tr>
                         <tr>
                            <th>Criminal ID</th>
                            <td>{{criminals.id}}</td>
                        </tr>
                        <tr>
                            <th>NID No.</th>
                            <td>{{criminals.nid}}</td>
                        </tr>
                        <tr>
                            <th>Date of birth</th>
                            <td>{{criminals.dob}}</td>
                        </tr>
                        <tr>
                             <th>Address</th>
                            <td>{{criminals.residence}}</td>
                        </tr>
                        <tr>
                             <th>State</th>
                            <td>{{criminals.state}}</td>
                        </tr>
                        
                        <tr>
                            <th>Skin Color</th>
                            <td>{{criminals.skin_color}}</td>
                        </tr>
                        <tr>
                            <th>Hair Color</th>
                            <td>{{criminals.hair_color}}</td>
                        </tr>
                        <tr>
                            <th>Height(cm)</th>
                            <td>{{criminals.height}}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{criminals.gender}}</td>
                        </tr>
                        <tr>
                            <th>Current Threat level</th>
                            <td>{{criminals.current_threat_level}}</td>
                        </tr>
                        <tr>
                            <th>Current Status</th>
                            <td>{{criminals.current_status}}</td>
                        </tr>
                        <tr>
                            <th>Registration Ending Date</th>
                            <td>{{criminals.registration_ending_date}}</td>
                        </tr>
                        
                        
                    </tbody>
                </table>
            </div>
        </div><hr>
        <!--Showing offense History-->
            <div>
                <h2 class="offense-title clearfix">Offence History</h2> &nbsp;
                <button class="btn btn-primary btn-sm add-btnn" @click="newModal">
                    <i class="fas fa-plus"></i>
                </button><hr>
                <!-- <h1 v-for="offense in offenses" :key="offense.id">
                  {{offense.title}}
                  </h1> -->
                 <div class="row jumbotron" v-for="offense in offenses" :key="offense.id">
                      <div class="col-md-8">
                        <table class="table table-sm">
                            <tbody>
                                <h3>Offense : {{offense.title}}</h3>
                                <tr>
                                    <th>Location</th>
                                    <td>{{offense.location}}</td>
                                </tr>
                                <tr>
                                    <th>Occurence Date</th>
                                    <td>{{offense.date}}</td>
                                </tr>
                                <tr>
                                    <th>Detain Date</th>
                                    <td>{{offense.detain_date}}</td>
                                </tr>
                                <tr>
                                    <th>Release Date</th>
                                    <td>{{offense.release_date}}</td>
                                </tr>
                                <tr>
                                    <th>Release Type</th>
                                    <td>{{offense.release_type}}</td>
                                </tr>
                                <tr>
                                    <th>Statute</th>
                                    <td>{{offense.statute}}</td>
                                </tr>
                                <tr>
                                    <th>Judgment</th>
                                    <td>{{offense.judgment}}</td>
                                </tr>
                                <tr>
                                    <th>Victim Gender</th>
                                    <td>{{offense.victim_gender}}</td>
                                </tr>
                                <tr>
                                    <th>Victim Age</th>
                                    <td>{{offense.victim_age}}</td>
                                </tr>
                                <div class="editDelete-btnn">
                                  <a href="#"><i class="fas fa-trash"></i></a>&nbsp;
                                  <a href="#" @click="editModal(offense)"><i class="fas fa-edit"></i></a>
                                </div>
                                
                            </tbody>
                        </table>
                      </div>
                      <div class="col-md-4">
      
                      </div>
                  </div>
                  
                
            </div>
            <!--./Showing offense History-->
            

        <div class="modal fade" id="addOffenseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h5 v-show="!editMode" class="modal-title" id="addOffenseModal">Add Offense History</h5>
                <h5 v-show="editMode" class="modal-title" id="addOffenseModal">Update Offense History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- Form -->
              <form @submit.prevent="editMode ? updateOffense() : createOffense()">
                <div class="modal-body">
                  <div class="form-group">
                    <input v-model="form.title"  type="text" name="title" id="title" placeholder="Offense title"
                       class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                      <has-error :form="form" field="title"></has-error>
                  </div>

                  <div class="form-group">
                    <input v-model="form.location" type="text" name="location" id="location" placeholder="Location"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('location') }">
                      <has-error :form="form" field="location"></has-error>
                  </div>

                  <div class="form-group">
                    <input v-model="form.date" type="text" onfocus="(this.type='date')" name="date" id="date" placeholder="Date"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('date') }">
                       <has-error :form="form" field="date"></has-error>
                  </div>

                  <div class="form-group">
                    <input v-model="form.detain_date" type="text" onfocus="(this.type='date')" name="detain_date" id="detain_date" placeholder="Detain Date"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('detain_date') }">
                       <has-error :form="form" field="detain_date"></has-error>
                  </div>

                  <div class="form-group">
                    <input v-model="form.release_date" type="text" onfocus="(this.type='date')" name="release_date" id="release_date" placeholder="Release Date"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('release_date') }">
                       <has-error :form="form" field="release_date"></has-error>
                  </div>

                  <div class="form-group">
                    <input v-model="form.release_type" type="text" name="release_type" id="release_type" placeholder="Release Type"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('release_type') }">
                       <has-error :form="form" field="release_type"></has-error>
                  </div>

                  <div class="form-group">
                    <input v-model="form.statute" type="text" name="statute" id="statute" placeholder="Statute"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('statute') }">
                       <has-error :form="form" field="statute"></has-error>
                  </div>

                  <div class="form-group">
                    <input v-model="form.judgment"  type="text" name="judgment" id="judgment" placeholder="Judgment"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('judgment') }">
                      <has-error :form="form" field="judgment"></has-error>
                  </div>

                  <div class="form-group"> <p>Victim Gender : 
                        <label class="radio-inline">
                          <input v-model="form.victim_gender" type="radio" value="male" id="victim_gender" name="victim_gender">Male
                        </label>
                        <label class="radio-inline">
                          <input v-model="form.victim_gender"  type="radio" value="female" id="victim_gender" name="victim_gender">Female
                        </label> </p>
                   </div>

                    <div class="form-group">
                        <input v-model="form.victim_age"  type="number" name="victim_age" id="victim_age" placeholder="Victim Age"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('victim_age') }">
                        <has-error :form="form" field="victim_age"></has-error>
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
    </div>
</template>

<script>
    export default {

       data(){
        return {
          editMode  : false,
          criminals : [],
          offenses  : {},

          form: new Form({
            id            : '',
            title         : '',
            location      : '',
            date          : '',
            detain_date   : '',
            release_date  : '',
            release_type  : '',
            statute       : '',
            judgment      : '',
            victim_gender : '',
            victim_age    : ''

          })
        

        }
      },
      methods:{

        updateOffense(){
          this.form.put('api/offense/' + this.form.id)
          .then(() => {
            $('#addOffenseModal').modal('hide');
            Toast.fire({
                type: 'success',
                title: 'Offense Updated successfully'
              });
              Fire.$emit('afterCreate');
          })
          .catch()
        },

        editModal(offense){
          this.form.clear();
          this.editMode = true;
          this.form.reset();
          $('#addOffenseModal').modal('show');
          this.form.fill(offense);
        },

        newModal(){
          this.form.clear();
          this.editMode = false;
          this.form.reset();
          $('#addOffenseModal').modal('show');
        },

         loadOffenses(){
          let id = this.$route.params.id;
          axios.get('api/offense/' + id)
          //  .then(({ data }) => (this.offenses = data.data));
            .then(response => {
                    this.offenses = response.data;
            })
            .catch(response => {
                    // Error Handling
            });
          
        },

        createOffense(){
          let id = this.$route.params.id;
          this.form.post('api/offense/create/'+ id)
        .then(() => {
            Fire.$emit('afterCreate');
              $('#addOffenseModal').modal('hide');

              Toast.fire({
                type: 'success',
                title: 'Offense inserted successfully'
              });

          })
        .catch(()=>{

            });
          
        }

      },
      

        // loadCriminals(){
        //   axios.get('api/criminalProfile'+this.$route.params.id).then(({ data }) => (this.criminals = data.data));
        // },
       
     created() {
         let id = this.$route.params.id;
            axios.get('api/criminal/' + id)
            .then(response => this.criminals = response.data)
            .catch();

          this.loadOffenses();
          Fire.$on('afterCreate', () => {
             this.loadOffenses();
           });
           
        }
    }
</script>
