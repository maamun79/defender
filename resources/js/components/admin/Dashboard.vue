<template>
    <div class="container">
        <!-- ============================================================
                        Offender
        ============================================================ -->
        <h3 style="padding-top:30px">Offenders</h3><hr>
        <div class="row">
            <!-- offender count -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-ninja"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Offenders</span>
                <span class="info-box-number">
                  {{countOffender}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!--most wanted offender count -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-ninja"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Most Wanted Offenders</span>
                <span class="info-box-number">
                  {{countMostWantedOffender}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!--high risk offender count -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-ninja"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">High Risk Offenders</span>
                <span class="info-box-number">
                  {{countHighRiskOffender}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        <!-- ============================================================
                        Location Update
        ============================================================ -->
        <h3 style="padding-top:10px">Location Update</h3><hr>
        <div class="row">
            <!-- location update count -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-map-marked-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Location Update</span>
                <span class="info-box-number">
                  {{countLocationUpdate}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!--pending location updatecount -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-map-marked-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pending Location Update</span>
                <span class="info-box-number">
                  {{countPendingLocationUpdate}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!--high risk offender count -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-map-marked-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Sent Location Update</span>
                <span class="info-box-number">
                  {{countSentLocationUpdate}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        <!-- ============================================================
                        Complains
        ============================================================ -->
        <h3 style="padding-top:10px">Complains</h3><hr>
        <div class="row">
            <!-- complains count -->
         
          <!--work place complain count -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-pray"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Work Place Complains</span>
                <span class="info-box-number">
                  {{countWorkPlaceComplains}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!--pending work place complain count -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-pray"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pending Work Place Complains</span>
                <span class="info-box-number">
                  {{countPendingWorkPlaceComplains}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!--sent work place complain count -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-pray"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Sent Work Place Complains</span>
                <span class="info-box-number">
                  {{countSentWorkPlaceComplains}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!--public place complain count -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-globe-asia"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Public Place Complains</span>
                <span class="info-box-number">
                  {{countPublicPlaceComplains}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!--pending public place complain count -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-globe-asia"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pending Public Place Complains</span>
                <span class="info-box-number">
                  {{countPendingPublicPlaceComplains}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!--sent public place complain count -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-globe-asia"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Sent Public Place Complains</span>
                <span class="info-box-number">
                  {{countSentPublicPlaceComplains}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!--social media complain count -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-robot"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Social Media Complains</span>
                <span class="info-box-number">
                  {{countSocialMediaComplains}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!--pending social media complain count -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-robot"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pending Social Media Complains</span>
                <span class="info-box-number">
                  {{countPendingSocialMediaComplains}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!--sent social media complain count -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-robot"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Sent Social Media Complains</span>
                <span class="info-box-number">
                  {{countSentSocialMediaComplains}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        <!-------------------chart--------------------->
          <div class="row">
            <!-------------------pie chart--------------------->
            <div class="col-md-6">
              <div class="card card-danger">
                <div class="card-header">
                  <h3>Offenders</h3>
                </div>
                <canvas id="myChart"></canvas>
              </div>
            </div>
            <!-------------------end pie chart--------------------->
            <!-------------------bar chart--------------------->
            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-header">
                  <h3>Complains</h3>
                </div>
                <canvas id="myBarChart"></canvas>
              </div>
            </div>
            <!-------------------end pie chart--------------------->
          </div>
            <!-------------------end chart--------------------->
    </div>
</template>

<script>

 window.addEventListener("load" , ()=>{
                console.log('I should work');
            if(window.location.href.indexOf('dashboard') != -1){
                if(window.location.href.length -2 == window.location.href.indexOf('#/')){
                  window.location.href = "dashboard#/dashboard";
                }
            }

    } , false);

    export default {
         data(){
        return{
          countOffender: '',
          countMostWantedOffender: '',
          countFreeOffender: '',
          countDetainedOffender: '',
          countHighRiskOffender: '',

          countLocationUpdate: '',
          countPendingLocationUpdate: '',
          countSentLocationUpdate: '',

          countWorkPlaceComplains: '',
          countPendingWorkPlaceComplains:'',
          countSentWorkPlaceComplains:'',

          countPublicPlaceComplains: '',
          countPendingPublicPlaceComplains: '',
          countSentPublicPlaceComplains: '',

          countSocialMediaComplains: '',
          countPendingSocialMediaComplains: '',
          countSentSocialMediaComplains: ''
        }        
      },
      methods: {
          //--------------------------------------offender------------------------------
        offenderCount(){
          axios.get('api/offenderCount').then(({ data }) => (this.countOffender = data));
        },
        mostWantedOffenderCount(){
          axios.get('api/mostWantedOffenderCount').then(({ data }) => (this.countMostWantedOffender = data));
        },
        freeOffenderCount(){
          axios.get('api/freeOffenderCount').then(({ data }) => (this.countFreeOffender = data));
        },
        detainedOffenderCount(){
          axios.get('api/detainedOffenderCount').then(({ data }) => (this.countDetainedOffender = data));
        },
        highRiskOffenderCount(){
          axios.get('api/highRiskOffenderCount').then(({ data }) => (this.countHighRiskOffender = data));
        },
        //-------------------------------------location update-----------------------------------
        locationUpdateCount(){
          axios.get('api/locationUpdateCount').then(({ data }) => (this.countLocationUpdate = data));
        },
        pendingLocationUpdateCount(){
          axios.get('api/pendingLocationUpdateCount').then(({ data }) => (this.countPendingLocationUpdate = data));
        },
        sentLocationUpdateCount(){
          axios.get('api/sentLocationUpdateCount').then(({ data }) => (this.countSentLocationUpdate = data));
        },
        //------------------------------------Complains-----------------------------------------
        //workplace
        workPlaceComplainsCount(){
          axios.get('api/workPlaceComplainsCount').then(({ data }) => (this.countWorkPlaceComplains = data));
        },
        pendingWorkPlaceComplainsCount(){
          axios.get('api/pendingWorkPlaceComplainsCount').then(({ data }) => (this.countPendingWorkPlaceComplains = data));
        },
        sentWorkPlaceComplainsCount(){
          axios.get('api/sentWorkPlaceComplainsCount').then(({ data }) => (this.countSentWorkPlaceComplains = data));
        },
        //public
        publicPlaceComplainsCount(){
          axios.get('api/publicPlaceComplainsCount').then(({ data }) => (this.countPublicPlaceComplains = data));
        },
        pendingPublicPlaceComplainsCount(){
          axios.get('api/pendingPublicPlaceComplainsCount').then(({ data }) => (this.countPendingPublicPlaceComplains = data));
        },
        sentPublicPlaceComplainsCount(){
          axios.get('api/sentPublicPlaceComplainsCount').then(({ data }) => (this.countSentPublicPlaceComplains = data));
        },
        //social
        socialMediaComplainsCount(){
          axios.get('api/socialMediaComplainsCount').then(({ data }) => (this.countSocialMediaComplains = data));
        },
        pendingSocialMediaComplainsCount(){
          axios.get('api/pendingSocialMediaComplainsCount').then(({ data }) => (this.countPendingSocialMediaComplains = data));
        },
        sentSocialMediaComplainsCount(){
          axios.get('api/sentSocialMediaComplainsCount').then(({ data }) => (this.countSentSocialMediaComplains = data));
        },
      },
      created() {
          console.log('I am loaded');

         //----------------------pie chart-------------------------------
            if(typeof document.getElementById('myChart') !='undefined'){
              setTimeout(()=>{
              let myChart = document.getElementById('myChart').getContext('2d');
                      let myPieChart = new Chart(myChart, {
                        type: 'pie',
                        data:  {
                      datasets: [{
                          data: [this.countMostWantedOffender, this.countDetainedOffender, this.countFreeOffender],
                          backgroundColor: ['#FF6384','#36A2EB','#FFCD56',]
                      }
                    ],
                      // These labels appear in the legend and in the tooltips when hovering different arcs
                      labels: [
                          'Most Wanted',
                          'Detained',
                          'Free'
                      ]
                    }
                      });
                
              } , 5000);
                
            }
          //----------------------------bar chart----------------------
          if(typeof document.getElementById('myBarChart') !='undefined'){
              setTimeout(()=>{
              let myChart = document.getElementById('myBarChart').getContext('2d');
                      let myPieChart = new Chart(myChart, {
                        type: 'bar',
                        data:  {
                      datasets: [{
                          data: [this.countWorkPlaceComplains, this.countPublicPlaceComplains, this.countSocialMediaComplains],
                          backgroundColor: ['red','yellow','green',]
                      }
                    ],
                      // These labels appear in the legend and in the tooltips when hovering different arcs
                      labels: [
                          'Work place complain',
                          'Public place complain',
                          'Social media complain'
                      ]
                    }
                      });
                
              } , 5000);
                
            }
          
            this.offenderCount();
            this.mostWantedOffenderCount();
            this.detainedOffenderCount();
            this.freeOffenderCount();
            this.highRiskOffenderCount();

            this.locationUpdateCount();
            this.pendingLocationUpdateCount();
            this.sentLocationUpdateCount();

            this.workPlaceComplainsCount();
            this.pendingWorkPlaceComplainsCount();
            this.sentWorkPlaceComplainsCount();

            this.publicPlaceComplainsCount();
            this.pendingPublicPlaceComplainsCount();
            this.sentPublicPlaceComplainsCount();

            this.socialMediaComplainsCount();
            this.pendingSocialMediaComplainsCount();
            this.sentSocialMediaComplainsCount();
           
        }
    }
</script>
