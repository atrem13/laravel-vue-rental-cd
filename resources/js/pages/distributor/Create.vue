<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        Add Distributor
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="AddDistributor">
                            <div class="form-group">
                              <label for="">Nama</label>
                              <input type="text"  class="form-control" placeholder="" v-model="distributor.nama">
                              <div v-if="validation.nama">
                                  <span class="btn btn-sm btn-danger">{{validation.nama[0]}}</span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="">notelp</label>
                              <input type="text"  class="form-control" placeholder="" v-model="distributor.notelp">
                              <div v-if="validation.notelp">
                                  <span class="btn btn-sm btn-danger">{{validation.notelp[0]}}</span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="">alamat</label>
                              <textarea class="form-control" rows="5" placeholder="" v-model="distributor.alamat"></textarea>
                              <div v-if="validation.alamat">
                                  <span class="btn btn-sm btn-danger">{{validation.alamat[0]}}</span>
                              </div>
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
            distributor:{},
            validation:[]
        }
    },
    methods:{
        AddDistributor(){
            let uri = '/api/distributor';
            this.axios.post(uri, this.distributor)
                .then((response) => {
                    this.$router.push({
                        name:'distributor'
                    });
                }).catch((error) => {
                        this.validation = error.response.data.data;
                        console.log(error.response);
                });
        }
    }
}
</script>
