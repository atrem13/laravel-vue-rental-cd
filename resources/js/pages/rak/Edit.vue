<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        Edit Rak
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="UpdateRak">
                            <div class="form-group">
                              <label for="">Nama</label>
                              <input type="text" class="form-control" placeholder="" v-model="rak.nama">
                              <div v-if="validation.nama">
                                  <span class="btn btn-sm btn-danger">{{validation.nama[0]}}</span>
                              </div>
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
        let uri = `/api/rak/${this.$route.params.id}`;
        this.axios.get(uri)
            .then((response) => {
                this.rak = response.data.data;
            }).catch((error) => {
                alert(error.response.data.message);
            });
    },
    data(){
        return{
            rak:{},
            validation:[]
        }
    },
    methods:{
        UpdateRak(){
            let uri = `/api/rak/${this.$route.params.id}`;
            this.axios.put(uri, this.rak)
                .then((response) => {
                    this.$router.push({
                        name:'rak'
                    });
                }).catch((error) => {
                    this.validation = error.response.data.data;
                });
        }
    }
}
</script>
