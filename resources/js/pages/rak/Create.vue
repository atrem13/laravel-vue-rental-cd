<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        Add Rak
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="AddRak">
                            <div class="form-group">
                              <label for="">Nama</label>
                              <input type="text" class="form-control" placeholder="" v-model="rak.nama">
                              <div v-if="validation.nama">
                                  <span class="btn btn-sm btn-danger">{{validation.nama[0]}}</span>
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
            rak:{},
            validation:[]
        }
    },
    methods:{
        AddRak(){
            let uri = '/api/rak';
            this.axios.post(uri, this.rak)
                .then((response) => {
                    this.$router.push({
                        name:'rak'
                    });
                }).catch((error) => {
                    this.validation = error.response.data.data;
                    console.log(error.response);
                });
        }
    }
}
</script>
