<template>
    <div class="">
        <div class="row justify-content-center" id="contentField">
            <div class="col-md-7 breadcrumb">
                <p id="smText">From here you can search Offenders by their Name, NID or Address</p><hr>
                <div class="col-md-10" id="nameSearch">
                    
                        <div class="form-group searchInput">
                            <input type="text" class="form-control" @keyup.enter="searching" v-model="search" placeholder="Search...">
                        </div>
                        
                    
                </div>
                <div>
                    <button class="btn btn-success nameBtn" @click="searching"><i class="fas fa-search search-icon"></i></button>
                </div>
            </div>
        </div>
        <!----------------- search results --------------------->
        
        <div class="row justify-content-center" style="margin-top:25px">
                <!-- <h3>{{ msg }}</h3> -->
                <div class="col-md-7 breadcrumb" id="no-result-found-message" style="display:none">
                        <h3>No Result Found</h3>
                </div>
                <div v-for="offender in offenders" :key="offender.id" class="col-md-7 breadcrumb">
                        <div class="col-md-2">
                            <router-link :to="{name: 'showOffender', params:{id: offender.id}}">
                                <img :src="'img/criminal/' + offender.photo" alt="" class="searchCriminalmImg">
                            </router-link>
                        </div>
                        <div class="col-md-10 searchResult">
                            
                            <h3>
                                <router-link :to="{name: 'showOffender', params:{id: offender.id}}">
                                    {{offender.name}}
                                </router-link>
                            </h3>
                            
                            <p>NID : {{offender.nid}}</p>
                            <p>Address : {{offender.residence}}</p>
                            <p>Status : {{offender.current_status}}</p>
                            <p>Threat Level : {{offender.current_threat_level}}</p>
                        </div>                                       
                </div>
        </div>
        <!-- -------------------End Search Result------------------ -->
        <div class="about">
            <div class="container">
                <h3>ABOUT DEFENDER</h3>
                <p class="text-justify">
                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
         data(){
            return{
                search    : '',
                offenders : []
            }
        },
        methods:{
            searching(){
                let query = this.search;
                axios.get('api/findOffender?q=' + query)
                // .then(({ data }) => (this.offenders = data[0]))
                // .catch()
                .then(data => {
                     this.offenders = data.data.data;
                    let noResultFoundMessage = document.getElementById("no-result-found-message");
                     if(this.offenders.length){
                         noResultFoundMessage.style.display="none";
                     }else{
                         noResultFoundMessage.style.display="block";
                     }
                    //  console.log(data);
                 })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
