<template>
    <div class="container">
        <div class="">
           <div class="row">
              <div class="col-md-8">
                <h2 class="mwHeading">Most Wanted Offenders</h2>
                <p style="font-size: 17px">Here is the list of Most Wanted Offenders. Please notify us if you find or see anywhere</p>           
              </div>
              <div class="col-md-4">
                <div class="form-group searchMostWanted">
                      <input type="text" class="form-control" @keyup.enter="searchingMostWanted" v-model="searchMostWanted" placeholder="Search...">
                </div>
              </div>
           </div><hr>
           <div class="row justify-content-center" style="margin-top:25px">
                <div v-for="criminal in criminals" :key="criminal.id" class="col-md-10 breadcrumb">
                        <div class="col-md-2">
                            <router-link :to="{name: 'showMostWanted', params:{id: criminal.id}}">
                              <img :src="'img/criminal/' + criminal.photo" alt="" class="searchCriminalmImg">
                            </router-link>
                        </div>
                        
                        <div class="col-md-10 searchResult">
                            
                            <h3>
                                <router-link :to="{name: 'showMostWanted', params:{id: criminal.id}}">
                                    {{criminal.name}}
                                </router-link>
                            </h3>
                            
                            <p>NID : {{criminal.nid}}</p>
                            <p>Address : {{criminal.residence}}</p>
                            <p>Status : {{criminal.current_status}}</p>
                            <p>Threat Level : {{criminal.current_threat_level}}</p>
                        </div>                                       
                </div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
              searchMostWanted: '',
              criminals : []
            }

        },
        methods: {
            searchingMostWanted(){
                let query = this.searchMostWanted;
                axios.get('api/findMostWanted?q=' + query)
                // .then(({ data }) => (this.offenders = data[0]))
                // .catch()
                .then(data => {
                     this.criminals = data.data.data;
                     console.log(data);
                 })
            },
            loadCriminals(){
                axios.get('api/mostWanted').then(({ data }) => (this.criminals = data));
            }
        },
        created() {
            this.loadCriminals();
        }
    }
</script>
