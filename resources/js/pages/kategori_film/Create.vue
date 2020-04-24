<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        Add Kategori Film
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="AddKategoriFilm">
                            <div class="form-group">
                              <label for="">Nama</label>
                              <input type="text" class="form-control" placeholder="" v-model="kategori_film.nama">
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
            kategori_film:{},
            validation:[]
        }
    },
    methods:{
        AddKategoriFilm(){
            let uri = '/api/kategori_film';
            this.axios.post(uri, this.kategori_film)
                .then((response) => {
                    this.$router.push({
                        name:'kategori-film'
                    });
                }).catch((error) => {
                    this.validation = error.response.data.data;
                    console.log(error.response);
                });
        }
    }
}
</script>
