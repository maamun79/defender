<template>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-md-8">
                <div class="breadcrumb">
                    <p>
                        If you seen this person anywhere, please let us know 
                        the location of this person.
                        &nbsp; &nbsp;
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#locationUpdateModal">Notify</button>
                    </p>
                </div>
            </div>
        </div>
        <h3 style="text-align:center; margin-top:20px;">
          <strong>
            <div class="warn-sign">
              <span style="color: red;">
                <i class="fas fa-exclamation-triangle"></i>
              </span>
              Missing
            </div>
          </strong>
        </h3>
        <div class="row">         
            <div class="col-md-6">
                <img :src="'img/missingPerson/' + missingPerson.photo" alt="" id="criminalProfileImg">
            </div>
            <div class="col-md-6" id="criminal-info">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{missingPerson.name}}</td>
                        </tr>
                         <tr>
                            <th>DOB</th>
                            <td>{{missingPerson.dob}}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{missingPerson.gender}}</td>
                        </tr>
                        <tr>
                            <th>Height</th>
                            <td>{{missingPerson.height}}</td>
                        </tr>
                        <tr>
                             <th>Weight</th>
                            <td>{{missingPerson.weight}}</td>
                        </tr>
                        <tr>
                             <th>Hair Color</th>
                            <td>{{missingPerson.hair_color}}</td>
                        </tr>
                        
                        <tr>
                            <th>Eye Color</th>
                            <td>{{missingPerson.eye_color}}</td>
                        </tr>
                        <tr>
                            <th>Skin Color</th>
                            <td>{{missingPerson.skin_color}}</td>
                        </tr>
                        <tr>
                            <th>Missing From</th>
                            <td>{{missingPerson.missing_from}}</td>
                        </tr>
                        <tr>
                            <th>Clothing Description</th>
                            <td>{{missingPerson.clothing_description}}</td>
                        </tr>
                        <tr>
                            <th>Unique Identifiers</th>
                            <td>{{missingPerson.unique_identifiers}}</td>
                        </tr>
                        <tr>
                            <th>Missing Date</th>
                            <td>{{missingPerson.date_missing}}</td>
                        </tr>
                        <tr>
                            <th>Details</th>
                            <td>{{missingPerson.details}}</td>
                        </tr>                       
                    </tbody>
                </table>
            </div>
        </div>
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
                    <form @submit.prevent="createMLocation">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.where_seen" type="text" name="where_seen" id="where_seen" placeholder="Location where seen"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('where_seen') }">
                                <has-error :form="form" field="where_seen"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.clothing_details" type="text" name="clothing_details" id="clothing_details" placeholder="Clothing Details"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('clothing_details') }">
                                <has-error :form="form" field="clothing_details"></has-error>
                            </div>
                            <div class="form-group">
                                <textarea v-model="form.details" name="details" id="details" placeholder="Details"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('details') }">

                                </textarea>
                                <has-error :form="form" field="details"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.date_of_seen" type="text" name="date_of_seen" id="date_of_seen" placeholder="Date of seen" onfocus="(this.type='date')"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('date_of_seen') }">
                                <has-error :form="form" field="date_of_seen"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.sender_name" type="text" name="sender_name" id="sender_name" placeholder="Your Name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('sender_name') }">
                                <has-error :form="form" field="sender_name"></has-error>
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
          missingPerson : [],
          locations : {},
          form: new Form({
                    id                : '',
                    where_seen        : '',
                    clothing_details  : '',
                    details           : '',
                    date_of_seen      : '',
                    sender_name       : '',
                    sender_contact    : ''
           })
        }
      },
      methods:{
          createMLocation(){
                let id = this.$route.params.id;
                this.form.post('api/missingPersonLocation/create/' + id)
                .then(() => {
                    $('#locationUpdateModal').modal('hide');

                    Swal.fire(
                        'Sent',
                        'You information sent successfully, we will contact with you if needed',
                        'success'
                    )

                })
                .catch(()=>{

                });
            }

      },
      
     created() {
         let id = this.$route.params.id;
            axios.get('api/missingPerson/' + id)
            .then(response => this.missingPerson = response.data)
            .catch();
           
        }
    }
</script>

