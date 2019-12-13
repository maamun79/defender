<template>
    <div class="container">
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
    </div>
</template>

<script>
    export default {

       data(){
        return {
          missingPerson : []
        }
      },
      methods:{
        

      },
      
     created() {
         let id = this.$route.params.id;
            axios.get('api/missingPerson/' + id)
            .then(response => this.missingPerson = response.data)
            .catch();
           
        }
    }
</script>

