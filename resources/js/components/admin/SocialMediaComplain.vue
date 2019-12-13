<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Social Media Complains</h3>
              </div>
                            <!-- /.card-header -->
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Accused Profile Link</th>
                            <th>Complainant's Contact</th>
                            <th>Complain Date</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="socialMediaComplain in socialMediaComplains" :key="socialMediaComplain.id">
                            <td>{{ socialMediaComplain.id}}</td>
                            <td>{{ socialMediaComplain.profile}}</td>             
                            <td>{{ socialMediaComplain.sender_contact}}</td>
                            <td>{{ socialMediaComplain.created_at}}</td>
                            <td v-if="socialMediaComplain.status == 'pending'"><span class="badge badge-warning"> {{ socialMediaComplain.status}} </span></td>
                            <td v-if="socialMediaComplain.status == 'Sent'"><span class="badge badge-success"> {{ socialMediaComplain.status}} </span></td>
                           
                           
                            <td>
                              <a class="btn btn-danger btn-sm"  @click="deleteSocialMediaComplain(socialMediaComplain.id)" >
                                <i class="fas fa-trash"></i>
                              </a>

                              <a class="btn btn-success btn-sm" @click="viewSocialDetails(socialMediaComplain)">
                                <i class="fas fa-eye"></i>
                              </a>

                              <a class="btn btn-primary btn-sm" @click="socialComplainToPoliceStation(socialMediaComplain)">
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
        <!-- Modal for social media complain Details -->
        <div class="modal fade" id="socialMediaComplainDetails" tabindex="-1" role="dialog" aria-labelledby="socialMediaComplainDetailsTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h5 class="modal-title" id="socialMediaComplainDetails">Complain Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                 <table class="table table-borderless table-sm">
                    <tbody>
                        <tr>
                            <th>Accused Profile Link</th>
                            <td id="profile"></td>
                        </tr>
                        <tr>
                            <th>Complain Description</th>
                            <td><p id="complain_details"  style="text-align:justify;"></p></td>
                        </tr>
                        <tr>
                            <th>Complainant's Contact</th>
                            <td><p id="com_phn"></p></td>
                        </tr>

                        <tr>
                            <th>Photo Proof</th>
                            <td id="img_proof"></td>
                        </tr>

                        <tr>
                            <th>Video Proof</th>
                            <td id="video_proof"></td>
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
        <!--/ Modal for social media complain Details-->
          <!-- Modal for Sending social media Complain -->
          <div class="modal fade" id="socialComplainToPoliceStation" tabindex="-1" role="dialog" aria-labelledby="socialComplainToPoliceStationTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h5 class="modal-title">Send Social Media Complain to Police Station</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <div class="form-group">
                            <select @change="policeStationChangedSocial" class="form-control" id="selectPoliceStationSocial" >
                              <option value="">Select Police Station</option>
                              <option :value="station.email"  v-for="station in stations" :key="station.id" >{{station.name}}, {{station.district}}</option>
                            </select>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                   <button type="button" class="btn btn-success" data-dismiss="modal" @click="sendSocialComplain()">Send</button>
                </div>
              </div>
            </div>
          </div>
          <!--/ Modal for Sending social media Complain -->
    </div>
</template>

<script>
    export default {
        data(){
            return{
                socialMediaComplains: {},
                stations:[],
                socialMediaComplain: {},
                emailToSendSocial: ''
            }
        },
        methods:{
          //delete social media complain
          deleteSocialMediaComplain(id){
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
                  axios.delete('api/deleteSocialMediaComplain/' +id).then(()=>{
                    Swal.fire(
                      'Deleted!',
                      'Complain has been deleted.',
                      'success'
                    );
                    this.loadSocialMediaComplains();
                  }).catch()
              }
            })
          },
          viewSocialDetails(socialMediaComplain){
            this.socialMediaComplain = socialMediaComplain;

            let profile  = document.getElementById("profile");
            let comp_det  = document.getElementById("complain_details");
            let com_phn  = document.getElementById("com_phn");
            let img_proof  = document.getElementById("img_proof");
            let video_proof         = document.getElementById("video_proof");

            profile.innerHTML     = "<a href='"+socialMediaComplain.profile+"' target='_blank'>Profile Link</a>";
            comp_det.innerHTML   = socialMediaComplain.description;
            com_phn.innerHTML   = socialMediaComplain.sender_contact;
            img_proof.innerHTML   = "<img src='/img/socialMediaComplain/"+ socialMediaComplain.photo + "' style='height:100px; width:130px'>";
            video_proof.innerHTML        = "<video src='/video/socialMediaComplain/"+socialMediaComplain.video + "' width='180' height='100' controls></video>";

            
            $('#socialMediaComplainDetails').modal('show');
          },
          loadPoliceStations(){
                axios.get('api/policeStation').then(({ data }) =>{
                  //console.log(data.data);
                  return (this.stations = data.data)
                  } );
            },
          loadSocialMediaComplains(){
                axios.get('api/getSocialMediaComplain').then(({ data }) => (this.socialMediaComplains = data.data));
          },
          socialComplainToPoliceStation(socialMediaComplain){
              this.socialMediaComplain = socialMediaComplain;
              $('#socialComplainToPoliceStation').modal('show');
          },
          policeStationChangedSocial(){
             this.emailToSendSocial = document.getElementById("selectPoliceStationSocial").value;
            
            },
          sendSocialComplain(){
            let url = 'api/socialComplain/'+this.socialMediaComplain.id+'/'+this.emailToSendSocial;
                 axios.get(url).then(({ data }) =>{
                  this.loadSocialMediaComplains();
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
            this.loadSocialMediaComplains();
            this.loadPoliceStations();
        }
    }
</script>
