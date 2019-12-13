<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Location Updates of most wanted offenders</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="location_update_table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Location</th>
                      <th>Sender Contact</th>
                      <th>Offender ID</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="location in locations" :key="location.id">
                      <td>{{location.id}}</td>
                      <td>{{location.location}}</td>
                      <td>{{location.sender_contact}}</td>
                      <td>{{location.criminal_id}}</td>
                      <td v-if="location.status == 'pending'"><span class="badge badge-warning"> {{ location.status}} </span></td>
                      <td v-if="location.status == 'Sent'"><span class="badge badge-success"> {{ location.status}} </span></td>
                      
                      <td>                        
                        <a class="btn btn-danger btn-sm" @click="deleteLocationUpdate(location.id)">
                          <i class="fas fa-trash"></i>
                        </a>
                         <a class="btn btn-success btn-sm" @click="viewDetails(location, criminal)">
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
                      <h5><strong>Offender Details</strong></h5><hr>
                      <table class="table table-borderless table-sm">
                        <tbody style="border-right: 1px #cfcdcd solid;">
                            
                            <tr>
                                <th>Offender ID</th>
                                <td>{{criminals.id}}</td>
                            </tr>
                            <tr>
                                <th>Offender's Name</th>
                                <td>{{criminals.name}}</td>
                            </tr>
                            <tr>
                                <th>DOB</th>
                                <td>{{criminals.dob}}</td>
                            </tr>
                            <tr>
                                <th>NID No.</th>
                                <td>{{criminals.nid}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{criminals.residence}}</td>
                            </tr>
                            <tr>
                                <th>Skin Colour</th>
                                <td>{{criminals.skin_color}}</td>
                            </tr>
                            <tr>
                                <th>Hair Colour</th>
                                <td>{{criminals.hair_color}}</td>
                            </tr>
                            <tr>
                                <th>Height</th>
                                <td>{{criminals.height}}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{criminals.gender}}</td>
                            </tr>
                            <tr>
                                <th>Current Threat Level</th>
                                <td>{{criminals.current_threat_level}}</td>
                            </tr>
                            <tr>
                                <th>Current Status</th>
                                <td>{{criminals.current_status}}</td>
                            </tr>
                            <tr>
                                <th>Offender's Name</th>
                                <td>{{criminals.name}}</td>
                            </tr>
                            <tr>
                                <th>Registration Ending Date</th>
                                <td>{{criminals.registration_ending_date}}</td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-6">
                      <h5><strong>Location Details</strong></h5><hr>
                      <img :src="'img/criminal/' + criminals.photo" alt="" id="locationDetailsImg">
                      <table class="table table-borderless table-sm">
                        <tbody>
                            <tr>
                                <th>Location</th>
                                <td id="locationName"></td>
                            </tr>
                            <tr>
                                <th>Details</th>
                                <td id="description"></td>
                            </tr>
                            <tr>
                                <th>Sender Contact</th>
                                <td id="senderContact"></td>
                            </tr>
                            <tr>
                                <th>Reported Time</th>
                                <td id="reportTime"></td>
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
                criminals: {},
                criminal : {},
                stations : [],
                emailToSend:'',
                selectedCriminalId:0,
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
                  axios.delete('api/location/' +id).then(()=>{
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
           
            viewDetails(location, criminal){
                this.location = location;
                this.criminal = criminal;
                axios.get('api/criminal/mostWanted/' + this.location.criminal_id)
                .then(({ data }) => {
                  console.log(data[0]);
                  this.criminals = data[0];
                  })
                .catch();

               let locationName  = document.getElementById("locationName");
               let description  = document.getElementById("description");
               let senderContact  = document.getElementById("senderContact");
               let reportTime  = document.getElementById("reportTime");

               locationName.innerHTML     = location.location;
               description.innerHTML     = location.description;
               senderContact.innerHTML     = location.sender_contact;
               reportTime.innerHTML     = location.created_at;
               $('.bd-example-modal-lg').modal('show');
            },
             loadLocations(){
                axios.get('api/location').then(({ data }) => {
                  this.locations = data.data;
                  setTimeout(()=>{
                  $('#location_update_table').DataTable({
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
              this.selectedCriminalId=location.criminal_id;
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

              let url = 'api/sendLocation/'+this.selectedLocationId+'/'+this.selectedCriminalId+'/'+this.emailToSend;
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
