<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Public Place Complains</h3>
              </div>
                            <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Location</th>
                            <th>Complainant's Contact</th>
                            <th>Complain Date</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="publicPlaceComplain in publicPlaceComplains" :key="publicPlaceComplain.id">
                            <td>{{ publicPlaceComplain.id}}</td>
                            <td>{{ publicPlaceComplain.location}}</td>             
                            <td>{{ publicPlaceComplain.sender_contact}}</td>
                            <td> {{ publicPlaceComplain.created_at}}</td>
                            <td v-if="publicPlaceComplain.status == 'pending'"><span class="badge badge-warning"> {{ publicPlaceComplain.status}} </span></td>
                            <td v-if="publicPlaceComplain.status == 'Sent'"><span class="badge badge-success"> {{ publicPlaceComplain.status}} </span></td>
                           
                           
                            <td>
                              <a class="btn btn-danger btn-sm"  @click="deletePublicPlaceComplain(publicPlaceComplain.id)" >
                                <i class="fas fa-trash"></i>
                              </a>

                              <a class="btn btn-success btn-sm" @click="viewPublicDetails(publicPlaceComplain)">
                                <i class="fas fa-eye"></i>
                              </a>

                              <a class="btn btn-primary btn-sm" @click="publicComplainToPoliceStation(publicPlaceComplain)">
                                <i class="fas fa-envelope"></i>
                              </a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
               </div>
            </div>
          </div>
        </div>
                            <!-- Modal for public place complain Details -->
        <div class="modal fade" id="publicPlaceComplainDetails" tabindex="-1" role="dialog" aria-labelledby="publicPlaceComplainDetailsTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h5 class="modal-title" id="publicPlaceComplainDetails">Complain Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                 <table class="table table-borderless table-sm">
                    <tbody>
                        <tr>
                            <th>Location</th>
                            <td id="location"></td>
                        </tr>
                        <tr>
                            <th>Complain Description</th>
                            <td><p id="complain_description"  style="text-align:justify;"></p></td>
                        </tr>
                        <tr>
                            <th>Complainant's Contact</th>
                            <td><p id="com_contact"></p></td>
                        </tr>

                        <tr>
                            <th>Photo Proof</th>
                            <td id="img"></td>
                        </tr>

                        <tr>
                            <th>Video Proof</th>
                            <td id="video"></td>
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
        <!--/ Modal for public place complain Details-->
                  <div class="modal fade" id="publicComplainToPoliceStation" tabindex="-1" role="dialog" aria-labelledby="publicComplainToPoliceStationTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h5 class="modal-title">Send Public Place Complain to Police Station</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <div class="form-group">
                            <select @change="policeStationChangedPublic" class="form-control" id="selectPoliceStationPublic" >
                              <option value="">Select Police Station</option>
                              <option :value="station.email"  v-for="station in stations" :key="station.id" >{{station.name}}, {{station.district}}</option>
                            </select>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                   <button type="button" class="btn btn-success" data-dismiss="modal" @click="sendPublicComplain()">Send</button>
                </div>
              </div>
            </div>
          </div>
          <!--/ Modal for Sending public place Complain -->
    </div>
</template>

<script>
    export default {
        data(){
            return{
                publicPlaceComplains: {},
                stations:[],
                publicPlaceComplain: {},
                emailToSendPublic: ''
            }
        },
        methods:{
                      //delete public place complain
          deletePublicPlaceComplain(id){
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
                  axios.delete('api/deletePublicPlaceComplain/' +id).then(()=>{
                    Swal.fire(
                      'Deleted!',
                      'Complain has been deleted.',
                      'success'
                    );
                    this.loadPublicPlaceComplains();
                  }).catch()
              }
            })
          },
          viewPublicDetails(publicPlaceComplain){
            this.publicPlaceComplain = publicPlaceComplain;

            let location      = document.getElementById("location");
            let details       = document.getElementById("complain_description");
            let comp_contact  = document.getElementById("com_contact");
            let image         = document.getElementById("img");
            let video         = document.getElementById("video");

            location.innerHTML     = publicPlaceComplain.location;
            details.innerHTML      = publicPlaceComplain.description;
            comp_contact.innerHTML = publicPlaceComplain.sender_contact;
            image.innerHTML        = "<img src='/img/publicPlaceComplain/"+ publicPlaceComplain.photo + "' style='height:100px; width:130px'>";
            video.innerHTML        = "<video src='/video/publicPlaceComplain/"+publicPlaceComplain.video + "' width='180' height='100' controls></video>";

            $('#publicPlaceComplainDetails').modal('show');

          },
          loadPoliceStations(){
                axios.get('api/policeStation').then(({ data }) =>{
                  //console.log(data.data);
                  return (this.stations = data.data)
                  } );
            },
          loadPublicPlaceComplains(){
                axios.get('api/getPublicPlaceComplain').then(({ data }) => (this.publicPlaceComplains = data.data));
            },
          publicComplainToPoliceStation(publicPlaceComplain){
              this.publicPlaceComplain = publicPlaceComplain;
              $('#publicComplainToPoliceStation').modal('show');
          },
          policeStationChangedPublic(){
             this.emailToSendPublic = document.getElementById("selectPoliceStationPublic").value;
            
            },
          sendPublicComplain(){
            let url = 'api/publicComplain/'+this.publicPlaceComplain.id+'/'+this.emailToSendPublic;
                 axios.get(url).then(({ data }) =>{
                   this.loadPublicPlaceComplains();
                   $('#locationToPoliceStation').modal('hide');
                    Swal.fire(
                        'Sent',
                        'Email sent successfully',
                        'success'
                    );
                  return true;
              } );
              // alert(url);
          },
        },
        created() {
            this.loadPublicPlaceComplains();
            this.loadPoliceStations();
        }
    }
</script>
