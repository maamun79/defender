<template>
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 70px">
            <!-- -----------------sidebar content---------------------- -->
            <div class="col-md-5">
                <div class="sidebar-cust">
                    <h3><b>Model Sexual Harassment Policy</b></h3>
                    <p class="text-justify">
                        Every employer in the New York State is required to adopt a sexual harassment prevention policy. An employer that does not adopt the model policy must ensure that the policy that they adopt meets or exceeds the following minimum standards.
                        <br><br>The policy must: 
                    </p>
                    <ul>
                        <li class="text-justify">
                            prohibit sexual harassment consistent with guidance issued by the Department of Labor in consultation with the Division of Human Rights
                        </li>
                    </ul>
                    <ul>
                        <li class="text-justify">
                            provide examples of prohibited conduct that would constitute unlawful sexual harassment
                        </li>
                    </ul>
                    <ul>
                        <li class="text-justify">
                            include information concerning the federal and state statutory provisions concerning sexual harassment, remedies available to victims of sexual harassment, and a statement that there may be applicable local laws
                        </li>
                    </ul>
                </div>
            </div>
            <!-- -----------------End sidebar content---------------------- -->
            <div class="col-md-7">
                <div class="breadcrumb">
                    <div class="row">
                        <div class="col-md-9" style="text-align: justify">
                            <h5>
                                If you faced any sextual harrasment at your work place, please complain to us. We will send this 
                                complain to responsible team.
                            </h5>
                        </div>
                        <div class="col-md-3" >
                            <button class="btn btn-primary btn-sm" @click="workPlaceComplain">Work Place Complain</button>
                        </div>
                    </div>
                </div>

                <div class="breadcrumb" style="margin-top:40px">
                    <div class="row">
                        <div class="col-md-9" style="text-align: justify">
                            <h5>
                                If you faced any sextual harrasment in public place and you have proper video or photo proof, please complain to us. We will send this 
                                complain to responsible team.
                            </h5>
                        </div>
                        <div class="col-md-3" >
                            <button class="btn btn-success btn-sm" @click="publicPlaceComplain">Public Place Complain</button>
                        </div>
                    </div>
                </div>

                <div class="breadcrumb" style="margin-top:40px">
                    <div class="row">
                        <div class="col-md-9" style="text-align: justify">
                            <h5>
                                If you faced any sextual harrasment in Social Media, please complain to us. We will send this 
                                complain to responsible team.
                            </h5>
                        </div>
                        <div class="col-md-3" >
                            <button class="btn btn-info btn-sm" @click="socialMediaComplain">Social Media Complain</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!--Work place complain Modal-->
        <div class="modal fade" id="workPlaceComplainModal" tabindex="-1" role="dialog" aria-labelledby="workPlaceComplainModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="workPlaceComplainModal">Complain For Work Place Harassment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Form -->
                    <form @submit.prevent="insertWorkPlaceComplain" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form1.company_name" type="text" name="company_name" id="company_name" placeholder="Accused Company Name"
                                class="form-control" :class="{ 'is-invalid': form1.errors.has('company_name') }">
                                <has-error :form="form1" field="company_name"></has-error>
                            </div>
                            <div class="form-group">
                                <select v-model="form1.company_type" class="form-control" id="company_type" name="company_type" 
                                    :class="{ 'is-invalid': form1.errors.has('company_type') }">
                                    <option value="">Select Company Type</option>
                                    <option value="Government" >Government</option>
                                    <option value="Non-Government" >Non-Government</option>
                                </select>
                                <has-error :form="form1" field="company_type"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form1.company_address" type="text" name="company_address" id="company_address" placeholder="Company Address"
                                class="form-control" :class="{ 'is-invalid': form1.errors.has('company_address') }">
                                <has-error :form="form1" field="company_address"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form1.person_name" type="text" name="person_name" id="person_name" placeholder="Accused Person Name"
                                class="form-control" :class="{ 'is-invalid': form1.errors.has('person_name') }">
                                <has-error :form="form1" field="person_name"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form1.designation" type="text" name="designation" id="designation" placeholder="Dasignation"
                                class="form-control" :class="{ 'is-invalid': form1.errors.has('designation') }">
                                <has-error :form="form1" field="designation"></has-error>
                            </div>
                            <div class="form-group">
                                <select v-model="form1.crime_type" class="form-control" id="crime_type" 
                                :class="{ 'is-invalid': form1.errors.has('crime_type') }">
                                    <option value="">Select Crime Type</option>
                                    <option value="Rape">Rape</option>
                                    <option value="Sexual Assault">Sexual Assault</option>
                                    <option value="Child Molestation">Child Molestation</option>
                                    <option value="Others">Others</option>
                                </select>
                                <has-error :form="form1" field="crime_type"></has-error>
                            </div>
                            <div class="form-group">
                                <textarea v-model="form1.description" name="description" id="description" placeholder="Details"
                                class="form-control" :class="{ 'is-invalid': form1.errors.has('description') }">

                                </textarea>
                                <has-error :form="form1" field="description"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form1.sender_contact" type="text" name="sender_contact" id="sender_contact" placeholder="Complainant's Contact"
                                class="form-control" :class="{ 'is-invalid': form1.errors.has('sender_contact') }">
                                <has-error :form="form1" field="sender_contact"></has-error>
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Complain</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/ .Work place complain Modal-->

        <!--Public place complain Modal-->
        <div class="modal fade" id="publicPlaceComplainModal" tabindex="-1" role="dialog" aria-labelledby="publicPlaceComplainModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title" id="publicPlaceComplainModal">Complain For Public Place Harassment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Form -->
                    <form @submit.prevent="insertPublicPlaceComplain" enctype="multipart/form-data" files=true>
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form2.location" type="text" name="location" id="location" placeholder="Location" required
                                class="form-control" :class="{ 'is-invalid': form2.errors.has('location') }">
                                <has-error :form="form2" field="location"></has-error>
                            </div>
                            <div class="form-group">
                                <textarea v-model="form2.description" name="description" id="description" placeholder="Details" required
                                class="form-control" :class="{ 'is-invalid': form2.errors.has('description') }">

                                </textarea>
                                <has-error :form="form2" field="description"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form2.sender_contact" type="text" name="sender_contact" id="sender_contact" placeholder="Complainant's Contact" required
                                class="form-control" :class="{ 'is-invalid': form2.errors.has('sender_contact') }">
                                <has-error :form="form2" field="sender_contact"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="photo">Upload Photo Proof</label>
                                <input type="file" @change="upPhotoPublicPlaceComplain" name="photo" id="photo" placeholder="Photo" class="form-control" required
                                :class="{ 'is-invalid': form2.errors.has('photo') }">
                                <has-error :form="form2" field="photo"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="video">Upload Video Proof</label>
                                <input type="file" @change="upVideoPublicPlaceComplain" name="video" id="video" placeholder="video" class="form-control" required
                                :class="{ 'is-invalid': form2.errors.has('video') }">
                                <has-error :form="form2" field="video"></has-error>
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Complain</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/ .Public place complain Modal-->

         <!--Social media complain Modal-->
        <div class="modal fade" id="socialMediaComplainModal" tabindex="-1" role="dialog" aria-labelledby="socialMediaComplainModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="socialMediaComplainModal">Complain For Social Media Harassment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Form -->
                    <form @submit.prevent="insertSocialMediaComplain">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form3.profile" type="text" name="profile" id="profile" placeholder="Accused Profile Link" required
                                class="form-control" :class="{ 'is-invalid': form3.errors.has('profile') }">
                                <has-error :form="form3" field="profile"></has-error>
                            </div>
                            <div class="form-group">
                                <textarea v-model="form3.description" name="description" id="description" placeholder="Details" required
                                class="form-control" :class="{ 'is-invalid': form3.errors.has('description') }">

                                </textarea>
                                <has-error :form="form3" field="description"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form3.sender_contact" type="text" name="sender_contact" id="sender_contact" placeholder="Complainant's Contact" required
                                class="form-control" :class="{ 'is-invalid': form3.errors.has('sender_contact') }">
                                <has-error :form="form3" field="sender_contact"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="photo">Upload Photo Proof</label>
                                <input type="file" @change="upPhotoSocialMediaComplain" name="photo" id="photo" placeholder="Photo" class="form-control" required
                                :class="{ 'is-invalid': form3.errors.has('photo') }">
                                <has-error :form="form3" field="photo"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="video">Upload Video Proof</label>
                                <input type="file" @change="upVideoSocialMediaComplain" name="video" id="video" placeholder="video" class="form-control" required
                                :class="{ 'is-invalid': form3.errors.has('video') }">
                                <has-error :form="form3" field="video"></has-error>
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Complain</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/ .Social media complain Modal-->
    </div>
</template>

<script>
    export default {
        data(){
            return {
                workPlaceComplains : {},
                form1: new Form({
                    id               : '',
                    company_name     : '',
                    company_type     : '',
                    company_address  : '',
                    person_name      : '',
                    designation      : '',
                    description      : '',
                    sender_contact   : '',
                    crime_type       : ''
                }),
                form2: new Form({
                    id               : '',
                    location         : '',
                    description      : '',
                    sender_contact   : '',
                    photo            : '',
                    video            : ''
                }),
                form3: new Form({
                    id               : '',
                    profile          : '',
                    description      : '',
                    sender_contact   : '',
                    photo            : '',
                    video            : ''
                })
            }
        },
        methods:{
            //------------- showing work place complain modal---------------------
            workPlaceComplain(){
                $('#workPlaceComplainModal').modal('show');
            },
            insertWorkPlaceComplain(){
                this.form1.post('api/complain')
                .then(res => {
                    $('#workPlaceComplainModal').modal('hide');
                    Swal.fire(
                        'Sent',
                        'You information sent successfully',
                        'success'
                    )

                    // if(res.data.status == 'success'){
                        
                    //     Swal.fire(
                    //         'success',
                    //         res.data.message
                    //     );

                    // }else{
                    //     Swal.fire(
                    //         'error',
                    //         res.data.message
                    //     );
                    // }
                })
                .catch(()=>{

                });
            },
            //--------------- showing public place complain modal-----------------------
            publicPlaceComplain(){
                $('#publicPlaceComplainModal').modal('show');
            },
            upPhotoPublicPlaceComplain(e){
                let file = e.target.files[0];
                // console.log(file);
                
                let reader = new FileReader();
                if(file['type'] == 'image/png' || file['type'] == 'image/jpg' || file['type'] == 'image/jpeg'){
                    reader.onloadend = (file) => {
                        // console.log('RESULT', reader.result);
                        this.form2.photo = reader.result;
                    }
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Allowed image type png,jpg,jpeg'
                    });
                    
                }
            },
            upVideoPublicPlaceComplain(e){
                let videoFile = e.target.files[0];
                console.log(videoFile);

                if(videoFile['type'] == 'video/mp4' || videoFile['type'] == 'video/3gp'){
                    this.form2.video = videoFile;
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Allowed video type mp4,3gp'
                    });
                }
                
                
                // let reader = new FileReader();
                // reader.onloadend = (videoFile) => {
                //     // console.log('RESULT', reader.result);
                //     this.form2.video = reader.result;
                // }
                // reader.readAsDataURL(videoFile);
                // // console.log(videoFile);
                // // let videoFile = e.target.files[0];
                // // this.form2.video = videoFile;
                // // console.log(videoFile);
            },
            insertPublicPlaceComplain(){
            let rawData = {
                location: this.form2.location,
                description: this.form2.description,
                sender_contact: this.form2.sender_contact,
                photo: this.form2.photo,
            }
            //rawData = JSON.stringify(rawData)
            let formData = new FormData()
            formData.append('video', this.form2.video, this.form2.video.name);
            formData.append('location', rawData.location);
            formData.append('description', rawData.description);
            formData.append('sender_contact', rawData.sender_contact);
            formData.append('photo', rawData.photo);
            let response =  axios.post('api/publicPlaceComplain', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
            }).then(()=>{
                $('#publicPlaceComplainModal').modal('hide');

                    Swal.fire(
                        'Sent',
                        'You information sent successfully',
                        'success'
                )
            });
                // this.form2.post('api/publicPlaceComplain')
                // .then(() => {
                //     $('#publicPlaceComplainModal').modal('hide');

                //     Swal.fire(
                //         'Sent',
                //         'You information sent successfully',
                //         'success'
                //     )

                // })
                // .catch(()=>{

                // });
            },
           
            // ----------------showing social media complain modal-------------------
            socialMediaComplain(){
                $('#socialMediaComplainModal').modal('show');
            },
            upPhotoSocialMediaComplain(e){
                let file = e.target.files[0];
                // console.log(file);
                let reader = new FileReader();
                if(file['type'] == 'image/png' || file['type'] == 'image/jpg' || file['type'] == 'image/jpeg'){
                        reader.onloadend = (file) => {
                            // console.log('RESULT', reader.result);
                            this.form3.photo = reader.result;
                        }
                        reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Allowed image type png,jpg,jpeg'
                    });
              
                }
            },
            upVideoSocialMediaComplain(e){
                let videoFile = e.target.files[0];
                if(videoFile['type'] == 'video/mp4' || videoFile['type'] == 'video/3gp'){
                         this.form3.video = videoFile;
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Allowed video type mp4,3gp'
                    });
                }

            },
            insertSocialMediaComplain(){
                let rawData = {
                    profile: this.form3.profile,
                    description: this.form3.description,
                    sender_contact: this.form3.sender_contact,
                    photo: this.form3.photo,
                }
                //rawData = JSON.stringify(rawData)
                let formData2 = new FormData()
                formData2.append('video', this.form3.video, this.form3.video.name);
                formData2.append('profile', rawData.profile);
                formData2.append('description', rawData.description);
                formData2.append('sender_contact', rawData.sender_contact);
                formData2.append('photo', rawData.photo);
                let response =  axios.post('api/socialMediaComplain', formData2, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
                }).then(()=>{
                    $('#socialMediaComplainModal').modal('hide');

                        Swal.fire(
                            'Sent',
                            'You information sent successfully',
                            'success'
                    )
                });
                //  this.form3.post('api/socialMediaComplain')
                // .then(() => {
                //     $('#socialMediaComplainModal').modal('hide');

                //     Swal.fire(
                //         'Sent',
                //         'You information sent successfully, we will contact with you',
                //         'success'
                //     )

                // })
                // .catch(()=>{

                // });
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
