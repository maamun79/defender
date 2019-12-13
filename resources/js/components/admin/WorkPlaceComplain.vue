<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Work Place Complains</h3>
              </div>  <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover" id="wpc_table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>Company Type</th>
                            <th>Accused Person Name</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="complain in complains" :key="complain.id">
                            <td>{{ complain.id}}</td>
                            <td>{{ complain.company_name}}</td>             
                            <td>{{ complain.company_type}}</td>
                            <td> {{ complain.person_name}}</td>
                            <td v-if="complain.status == 'pending'"><span class="badge badge-warning"> {{ complain.status}} </span></td>
                            <td v-if="complain.status == 'Sent'"><span class="badge badge-success"> {{ complain.status}} </span></td>
                            <td>
                              <a class="btn btn-danger btn-sm"  @click="deleteWorkPlaceComplain(complain.id)" >
                                <i class="fas fa-trash"></i>
                              </a>

                              <a class="btn btn-success btn-sm" @click="viewDetails(complain)">
                                <i class="fas fa-eye"></i>
                              </a>

                              <a class="btn btn-primary btn-sm" @click="complainToPoliceStation(complain)">
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
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal  -->
                <!-- Modal for work place complain Details -->
        <div class="modal fade" id="complainDetails" tabindex="-1" role="dialog" aria-labelledby="publicPlaceComplainDetailsTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h5 class="modal-title" id="complainDetailsTitle">Complain Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                 <table class="table table-borderless table-sm">
                    <tbody>
                        <tr>
                            <th>Accused Company</th>
                            <td id="comp_name"></td>
                        </tr>

                        <tr>
                            <th>Company Type</th>
                            <td id="comp_type"></td>
                        </tr>

                        <tr>
                            <th>Company Address</th>
                            <td><p id="comp_address"></p></td>
                        </tr>

                        <tr>
                            <th>Accused Employee</th>
                            <td><p id="employee"></p></td>
                        </tr>

                        <tr>
                            <th>Employee's Designation</th>
                            <td><p id="designation"></p></td>
                        </tr>

                        <tr>
                            <th>Crime Type</th>
                            <td><p id="crime_type"></p></td>
                        </tr>

                        <tr>
                            <th>Complain Description</th>
                            <td><p id="complain_desc"  style="text-align:justify;"></p></td>
                        </tr>

                        <tr>
                            <th>Complainant's Contact</th>
                            <td><p id="comp_contact"></p></td>
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
        <!--/ Modal for work place complain Details-->

        <!-- Modal for Sending work place Complain -->
          <div class="modal fade" id="complainToPoliceStation" tabindex="-1" role="dialog" aria-labelledby="complainToPoliceStationTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h5 class="modal-title">Send Complain to Police Station</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5 id="complainToPoliceStationTitle"></h5>
                   <div class="form-group">
                            <select @change="policeStationChanged" class="form-control" id="selectPoliceStation" >
                              <option value="">Select Police Station</option>
                              <option :value="station.email"  v-for="station in stations" :key="station.id" >{{station.name}}, {{station.district}}</option>
                            </select>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                   <button type="button" class="btn btn-success" data-dismiss="modal" @click="sendComplain()">Send</button>
                </div>
              </div>
            </div>
          </div>
        <!--/modal-->
    </div>
</template>


<script>
    export default {
        data(){
            return{
                complains: {},
                stations:[],
                complain:{},
                emailToSend:''
            }
        },
        methods:{
            //delete workplace complain
            deleteWorkPlaceComplain(id){
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
                  axios.delete('api/deleteWorkPlaceComplain/' +id).then(()=>{
                    Swal.fire(
                      'Deleted!',
                      'Complain has been deleted.',
                      'success'
                    );
                    this.loadComplains();
                  }).catch()
              }
            })
            },
            // viewing complain details
            viewDetails(complain){
              this.complain    = complain;
              let compName     = document.getElementById("comp_name");
              let compType     = document.getElementById("comp_type");
              let compAddress  = document.getElementById("comp_address");
              let accusedEmp   = document.getElementById("employee");
              let designation  = document.getElementById("designation");
              let crimeType  = document.getElementById("crime_type");            
              let complainDesc = document.getElementById("complain_desc");
              let compContact  = document.getElementById("comp_contact");

              compName.innerHTML     = complain.company_name;
              compType.innerHTML     = complain.company_type;
              compAddress.innerHTML  = complain.company_address;
              accusedEmp.innerHTML   = complain.person_name;
              designation.innerHTML  = complain.designation;
              crimeType.innerHTML    = complain.crime_type;
              complainDesc.innerHTML = complain.description;
              compContact.innerHTML  = complain.sender_contact;
              
              $('#complainDetails').modal('show');
            }, // End viewing complain details

            // sending complain details to police station
            complainToPoliceStation(complain){
              this.complain = complain;
              let title = document.getElementById("complainToPoliceStationTitle");
              let titleText = complain.description.substring(0 , 20);
              if(complain.description.length > 20){
                title.innerHTML = titleText+"...";
              }else{
                title.innerHTML = titleText;
              }
              //console.log(complain)
              $('#complainToPoliceStation').modal('show');
            }, // End sending complain details to police station
            deleteComplain(complain){
              $('#deleteComplain').modal('show');
            },
            //deleteComplain
            loadComplains(){
                axios.get('api/complain').then(({ data }) => {
                  this.complains = data.data;
                  setTimeout(()=>{
                    $('#wpc_table').DataTable({
                      "order": [[0, "desc"]],
                      "bDestroy": true,
                      "bRetrieve": true,
                      //Custom filter
                      initComplete: function () {
                        
                        this.api().columns([2]).every( function () {
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

                  },100)
                  
                });
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
            sendComplain(){
              let url = 'api/complain/'+this.complain.id+'/'+this.emailToSend;
                 axios.get(url).then(({ data }) =>{
                   this.loadComplains();
                  $('#locationToPoliceStation').modal('hide');
                    Swal.fire(
                        'Sent',
                        'Email sent successfully',
                        'success'
                    );
                    return true;
                    
              } );


            //  console.log(this.complain);
            //  alert(emailToSend);
            },

        },
        created() {
            this.loadComplains();
            this.loadPoliceStations();
        }
    }
</script>
