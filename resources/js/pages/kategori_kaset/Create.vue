<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        Add Kategori Kaset
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="AddKategoriKaset">
                            <div class="form-group">
                              <label for="">Nama</label>
                              <input type="text" class="form-control" placeholder="" v-model="kategori_kaset.nama">
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
            kategori_kaset:{},
            validation:[]
        }
    },
    methods:{
        AddKategoriKaset(){
            let uri = '/api/kategori_kaset';
            this.axios.post(uri, this.kategori_kaset)
                .then((response) => {
                    this.$router.push({
                        name:'kategori-kaset'
                    });
                }).catch((error) => {
                    this.validation = error.response.data.data;
                    console.log(error.response);
                });
        }
    }
}
</script>
