<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card nt-5">
                    <div class="card-header text-center">
                        Edit Member
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="UpdateMember">
                            <div class="form-group">
                              <label for="">NIK</label>
                              <input type="text" class="form-control" placeholder="" v-model="member.nik">
                              <div v-if="validation.nik">
                                  <span class="btn btn-sm btn-danger">{{validation.nik[0]}}</span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="">Nama</label>
                              <input type="text" class="form-control" placeholder="" v-model="member.nama">
                            </div>
                            <div class="form-group">
                              <label for="">Nomor Telepon</label>
                              <input type="text" class="form-control" placeholder="" v-model="member.notelp">
                            </div>
                            <div class="form-group">
                              <label for="">Alamat</label>
                              <textarea class="form-control" rows="5" v-model="member.alamat"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="reset" class="btn btn-sm btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    created(){
        let uri = `/api/member/${this.$route.params.id}`;
        console.log(uri);
        this.axios.get(uri)
            .then((response) => {
                this.member = response.data.data;
            }).catch((error) => {
                alert(error.response.data.message);
            })
    },
    data(){
        return{
            member:{},
            validation:[]
        }
    },
    methods:{
        UpdateMember(){
            let uri = `/api/member/${this.$route.params.id}`;
            this.axios.put(uri, this.member)
                .then((response) => {
                    this.$router.push({
                        name:'member'
                    })
                }).catch((error) => {
                    this.validation = error.response.data.data;
                    console.log(this.validation);
                });
        }
    }
}
</script>
