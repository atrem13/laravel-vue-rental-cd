<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Index Kategori Kaset
                    </div>
                    <div class="card-body">
                        <router-link v-bind:to="{name:'kategori-kaset-create'}" class="btn btn-sm btn-primary">Tambah</router-link>
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(kategori_kaset, index) in kategori_kasets" v-bind:key="kategori_kaset.id">
                                    <td>{{kategori_kaset.nama}}</td>
                                    <td>
                                        <router-link v-bind:to="{name:'kategori-kaset-edit', params:{id:kategori_kaset.id}}" class="btn btn-sm btn-success">Edit</router-link>
                                        <button v-on:click="DeleteKategoriKaset(kategori_kaset.id, index)" class="btn btn-sm btn-danger">Delete</button>
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
        let uri = '/api/kategori_kaset';
        this.axios.get(uri)
            .then((response) => {
                this.kategori_kasets = response.data.data;
            });
    },
    data(){
        return{
            kategori_kasets:[]
        }
    },
    methods:{
        DeleteKategoriKaset(id, index){
            let uri = `/api/kategori_kaset/${id}`;
            this.axios.delete(uri)
                .then((response) => {
                    this.kategori_kasets.splice(index, 1);
                }).catch((error) => {
                    alert(error.response.data.message);
                });
        }
    }
}
</script>
