<template>
    <div class="container">
            <div class="row">
              <div class="col-md-8">
                <h2 class="mwHeading">Missing Persons</h2>
                <p style="font-size: 17px">Here is the list of Missing Persons. Please notify us if you find or see anywhere</p>           
              </div>
              <div class="col-md-4">
              </div>
           </div><hr>
        <div class="row">
            <div v-for="missingPerson in missingPersons" :key="missingPerson.id" class="col-md-4">
               <div class="card" style="width: 18rem;">
                    <img :src="'img/missingPerson/' + missingPerson.photo" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{missingPerson.name}}</h5>
                        <p class="card-text">{{missingPerson.details}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Missing From :</b> {{missingPerson.missing_from}}</li>
                        <li class="list-group-item"><b>Clothing Details :</b> {{missingPerson.clothing_description}}</li>
                        <li class="list-group-item"><b>Unique Identifiers :</b> {{missingPerson.unique_identifiers}}</li>
                        <li class="list-group-item"><b>Missing Date : </b>{{missingPerson.date_missing}}</li>
                    </ul>
                    <div class="card-body">
                         <router-link :to="{name: 'showMissingPersonProfile', params:{id: missingPerson.id}}" class="btn btn-primary">
                                    View full details
                         </router-link>
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
                missingPersons: []
            }
        },
        methods:{
            loadMissingPersons(){
                axios.get('api/showMissingPerson').then(({ data }) => (this.missingPersons = data.data));
            }
        },
        created() {
            this.loadMissingPersons();
        }
    }
</script>
