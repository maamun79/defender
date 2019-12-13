<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Missing Persons Location Update</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="missing_person_location_table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Where Seen</th>
                      <th>Clothing Details</th>
                      <th>Person ID</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="location in locations" :key="location.id">
                      <td>{{location.id}}</td>
                      <td>{{location.where_seen}}</td>
                      <td>{{location.clothing_details}}</td>
                      <td>{{location.missing_person_id}}</td>
                      <td v-if="location.status == 'Pending'"><span class="badge badge-warning"> {{ location.status}} </span></td>
                      <td v-if="location.status == 'Sent'"><span class="badge badge-success"> {{ location.status}} </span></td>
                      
                      <td>                        
                        <a class="btn btn-danger btn-sm" @click="deleteLocationUpdate(location.id)">
                          <i class="fas fa-trash"></i>
                        </a>
                         <a class="btn btn-success btn-sm" @click="viewDetails(location, person)">
                          <i class="fas fa-eye"></i>
                        </a>
                         <a class="btn btn-primary btn-sm" @click="locationToPoliceStation(location)">
                          <i class="fas fa-envelope"></i>
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
                        <th></th>                        
                    </tr>
                  </tfoot>
                </table>
              </div> 
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <!--./modal-->
        <!-- Modal for Details -->

        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                  <h5 class="modal-title" id="exampleModalLongTitle">Location Update Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6">
                      <h5><strong>Person Details</strong></h5><hr>
                      <table class="table table-borderless table-sm">
                        <tbody style="border-right: 1px #cfcdcd solid;">
                            <tr>
                                <th>Name</th>
                                <td>{{persons.name}}</td>
                            </tr>
                            <tr>
                                <th>DOB</th>
                                <td>{{persons.dob}}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{persons.gender}}</td>
                            </tr>
                            <tr>
                                <th>Height</th>
                                <td>{{persons.height}}</td>
                            </tr>
                            <tr>
                                <th>Weight</th>
                                <td>{{persons.weight}}</td>
                            </tr>
                            <tr>
                                <th>Hair Colour</th>
                                <td>{{persons.hair_color}}</td>
                            </tr>
                            <tr>
                                <th>Eye Color</th>
                                <td>{{persons.eye_color}}</td>
                            </tr>
                            <tr>
                                <th>Skin Color</th>
                                <td>{{persons.skin_color}}</td>
                            </tr>
                            <tr>
                                <th>Missing From</th>
                                <td>{{persons.missing_from}}</td>
                            </tr>
                            <tr>
                                <th>Clothing Description</th>
                                <td>{{persons.clothing_description}}</td>
                            </tr>
                            <tr>
                                <th>Unique Identifiers</th>
                                <td>{{persons.unique_identifiers}}</td>
                            </tr>
                            <tr>
                                <th>Missing Date</th>
                                <td>{{persons.date_missing}}</td>
                            </tr>
                            <tr>
                                <th>Details</th>
                                <td>{{persons.details}}</td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-6">
                      <h5><strong>Location Details</strong></h5><hr>
                      <img :src="'img/missingPerson/' + persons.photo" alt="" id="locationDetailsImg">
                      <table class="table table-borderless table-sm">
                        <tbody>
                            <tr>
                                <th>Where seen</th>
                                <td id="whereSeen"></td>
                            </tr>
                            <tr>
                                <th>Clothing Details</th>
                                <td id="clothingDetails"></td>
                            </tr>
                            <tr>
                                <th>Details</th>
                                <td id="details"></td>
                            </tr>
                            <tr>
                                <th>Date of seen</th>
                                <td id="dateSeen"></td>
                            </tr>
                            <tr>
                                <th>Sender Name</th>
                                <td id="senderName"></td>
                            </tr>
                            <tr>
                                <th>Sender Contact</th>
                                <td id="senderContact"></td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!--/ Modal for Details-->
        <!-- Modal for Sending Complain -->
          <div class="modal fade" id="locationToPoliceStation" tabindex="-1" role="dialog" aria-labelledby="locationToPoliceStationTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h5 class="modal-title">Send Location to Police Station</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <div class="form-group">
                            <select @change="policeStationChanged" class="form-control" id="selectPoliceStation" >
                              <option value="">Select Police Station</option>
                              <option :value="station.email"  v-for="station in stations" :key="station.id" >{{station.name}}, {{station.district}}</option>
                            </select>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                   <button type="button" class="btn btn-success" data-dismiss="modal" @click="sendLocation()">Send</button>
                </div>
              </div>
            </div>
          </div>
          <!--/ Modal for Sending Complain -->

   </div>
</template>

<script>
    export default {
         data(){
            return{
                locations: {},
                location : {},
                persons: {},
                person : {},
                stations : [],
                emailToSend:'',
                selectedPersonId:0,
                selectedLocationId:0
            }
        },
        methods:{
          //delete location update
            deleteLocationUpdate(id){
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
                  axios.delete('api/missingPersonLocation/' +id).then(()=>{
                    Swal.fire(
                      'Deleted!',
                      'Location update has been deleted.',
                      'success'
                    );
                    this.loadLocations();
                  }).catch()
              }
            })
            },
           
            viewDetails(location, person){
                this.location = location;
                this.person = person;
                axios.get('api/missingPerson/' + this.location.missing_person_id)
                .then(({ data }) => {
                  console.log(data);
                  this.persons = data;
                  })
                .catch();

               let whereSeen        = document.getElementById("whereSeen");
               let clothingDetails  = document.getElementById("clothingDetails");
               let details          = document.getElementById("details");
               let dateSeen         = document.getElementById("dateSeen");
               let senderName       = document.getElementById("senderName");
               let senderContact    = document.getElementById("senderContact");

               whereSeen.innerHTML       = location.where_seen;
               clothingDetails.innerHTML = location.clothing_details;
               details.innerHTML         = location.details;
               dateSeen.innerHTML        = location.date_of_seen;
               senderName.innerHTML      = location.sender_name;
               senderContact.innerHTML   = location.sender_contact;
               $('.bd-example-modal-lg').modal('show');
            },
             loadLocations(){
                axios.get('api/missingPersonLocation').then(({ data }) => {
                  this.locations = data.data;
                  setTimeout(()=>{
                  $('#missing_person_location_table').DataTable({
                    "order": [[0, "desc"]],
                    "bDestroy": true,
                    "bRetrieve": true,

                      //Custom filter
                        initComplete: function () {
                          
                          this.api().columns([1]).every( function () {
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
             locationToPoliceStation(location){
              this.selectedPersonId=location.missing_person_id;
              this.selectedLocationId=location.id;
              $('#locationToPoliceStation').modal('show');
            },
            loadPoliceStations(){
                axios.get('api/policeStation').then(({ data }) =>{
                  //console.log(data.data);
                  return (this.stations = data.data)
                } );
            },
            policeStationChanged(){
             this.emailToSend = document.getElementById("selectPoliceStation").value;
            
            },
            sendLocation(){

              let url = 'api/sendMiddingPersonLocation/'+this.selectedLocationId+'/'+this.selectedPersonId+'/'+this.emailToSend;
                 axios.get(url).then(({ data }) =>{
                  $('#locationToPoliceStation').modal('hide');
                  this.loadLocations();
                    Swal.fire(
                        'Sent',
                        'Email sent successfully',
                        'success'
                    );
                    return true;
              } );



            //  console.log(this.complain);
            //  alert(url);
            },
            
           

            // loadCriminals(){
            //     let url = 'api/criminal/'+this.location.criminal_id;
            //     console.log(url);
            // }
        },
        created() {
            this.loadPoliceStations();
            this.loadLocations();
            // this.loadCriminals();
        }
    }
</script>
