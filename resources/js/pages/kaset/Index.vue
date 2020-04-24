<template>
    <div class="container ">
        <div class="row justify-content-center ">
            <div class="col-sm-12 ">
                <div class="card ">
                    <div class="card-header">
                        Index Kaset
                    </div>
                    <div class="card-body table-responsive">
                        <router-link v-bind:to="{name:'kaset-create'}" class="btn btn-sm btn-primary">
                            Tambah
                        </router-link>
                        <table class="table mt-3 table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Kategori Kaset</th>
                                    <th scope="col">Kategori Film</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga Beli</th>
                                    <th scope="col">Harga Sewa</th>
                                    <th scope="col">Rak</th>
                                    <th scope="col">Distributor</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(kaset, index) in kasets" v-bind:key="kaset.id">
                                    <td scope="row">{{kaset.judul}}</td>
                                    <td>{{kaset.deskripsi}}</td>
                                    <td>{{kaset.kategori_kaset.nama}}</td>
                                    <td>
                                        <span v-for="item in kaset.kategori_films" v-bind:key="item.id">
                                            {{item.nama}}
                                        </span>
                                    </td>
                                    <td>{{kaset.jumlah}}</td>
                                    <td>{{kaset.harga_beli}}</td>
                                    <td>{{kaset.harga_sewa}}</td>
                                    <td>{{kaset.rak.nama}}</td>
                                    <td>{{kaset.distributor.nama}}</td>
                                    <td>
                                        <router-link v-bind:to="{name:'kaset-edit', params:{id:kaset.id}}" class="btn btn-sm btn-success">
                                            Edit
                                        </router-link>
                                        <button v-on:click="DeleteKaset(kaset.id, index)" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
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
        let uri ='/api/kaset';
        this.axios.get(uri)
            .then((response) => {
                this.kasets = response.data.data;
            })
    },
    data(){
        return{
            kasets:[]
        }
    },
    methods:{
        DeleteKaset(id, index){
            let uri = `/api/kaset/${id}`;
            this.axios.delete(uri)
                .then((response) => {
                    this.kasets.splice(index, 1);
                }).catch((error) => {
                    alert(error.response.data.message);
                });
        }
    }
}
</script>
