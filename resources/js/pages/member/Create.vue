<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card nt-5">
                    <div class="card-header text-center">
                        Add Member
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="AddMember">
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
                                <button type="submit" class="btn btn-sm btn-primary">Add</button>
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
    data(){
        return{
            member:{},
            validation:[]
        }
    },
    methods:{
        AddMember(){
            let uri = '/api/member';
            this.axios.post(uri, this.member)
                .then((response) => {
                    this.$router.push({
                        name:'member'
                    });
                }).catch((error) => {
                    this.validation = error.response.data.data;
                    console.log(this.validation);
                });
        }
    }
}
</script>
