<template>
    <div class="container">
        <div class="breadcrumb">
            <p style="font-size:15px">
                If you know this offender or see anywhere, please let us know 
                the location of this offender. We will keep hide your identity.
                &nbsp; &nbsp;
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#locationUpdateModal">Notify</button>
             </p>
        </div>
        <h3 style="text-align:center; margin-top:20px;">
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
        </div>
         <!--Showing offense History-->
            <div>
                <h2 class="offense-title clearfix">Offence History</h2> &nbsp;
                <hr>
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
                                    <th>Date</th>
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
                                
                            </tbody>
                        </table>
                      </div>
                      <div class="col-md-4">
      
                      </div>
                  </div>
                  
                
            </div>
            <!--./Showing offense History-->
            <!--Location Update Modal-->
            <div class="modal fade" id="locationUpdateModal" tabindex="-1" role="dialog" aria-labelledby="locationUpdateModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="locationUpdateModal">Location Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Form -->
                    <form @submit.prevent="createLocation">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.location" type="text" name="location" id="location" placeholder="Location where seen"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('location') }">
                                <has-error :form="form" field="location"></has-error>
                            </div>
                            <div class="form-group">
                                <textarea v-model="form.description" name="description" id="description" placeholder="Description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">

                                </textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.sender_contact" type="text" name="sender_contact" id="sender_contact" placeholder="Your Contact"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('sender_contact') }">
                                <has-error :form="form" field="sender_contact"></has-error>
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <!--./Location Update Modal-->
    </div>
</template>

<script>
    export default {
        data(){
            return {
                criminals : {},
                offenses  : {},
                locations : {},
                form: new Form({
                    id                       : '',
                    location                 : '',
                    description              : '',
                    sender_contact           : ''
                })
            }
        },
        methods : {
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
            createLocation(){
                let id = this.$route.params.id;
                this.form.post('api/location/create/' + id)
                .then(() => {
                    $('#locationUpdateModal').modal('hide');

                    Swal.fire(
                        'Sent',
                        'You information sent successfully, we will contact with you',
                        'success'
                    )

                })
                .catch(()=>{

                });
            }
        },
        
        created() {
            let id = this.$route.params.id;
            axios.get('api/criminal/' + id)
            .then(response => this.criminals = response.data)
            .catch();

            this.loadOffenses();
        }
    }
</script>
