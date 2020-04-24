<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Index Kategori Film
                    </div>
                    <div class="card-body">
                        <router-link v-bind:to="{name:'kategori-film-create'}" class="btn btn-sm btn-primary">Tambah</router-link>
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(kategori_film, index) in kategori_films" v-bind:key="kategori_film.id">
                                    <td>{{kategori_film.nama}}</td>
                                    <td>
                                        <router-link v-bind:to="{name:'kategori-film-edit', params:{id:kategori_film.id}}" class="btn btn-sm btn-success">Edit</router-link>
                                        <button v-on:click="DeleteKategoriFilm(kategori_film.id, index)" class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    created(){
        let uri = '/api/kategori_film';
        this.axios.get(uri)
            .then((response) => {
                this.kategori_films = response.data.data;
            });
    },
    data(){
        return{
            kategori_films:[]
        }
    },
    methods:{
        DeleteKategoriFilm(id, index){
            let uri = `/api/kategori_film/${id}`;
            this.axios.delete(uri)
                .then((response) => {
                    this.kategori_films.splice(index, 1);
                }).catch((error) => {
                    alert(error.response.data.message);
                });
        }
    }
}
</script>
