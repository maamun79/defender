<template>
    <div class="container">
        <h2>Safety And Education</h2><hr>
        <div class="">
            <div v-for="safety in safeties" :key="safety.id">
                <h3>{{safety.title}}</h3>
                <p style="text-align:justify;">{{safety.description}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                safeties : {},
                
            }
        },
      methods: {
          loadSafeties(){
              axios.get('api/safety').then(({ data }) => (this.safeties = data.data));
            },
      },
        created() {
            this.loadSafeties();
        }
    }
</script>
