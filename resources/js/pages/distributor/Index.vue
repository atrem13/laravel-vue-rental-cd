<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Index Distributor
                    </div>
                    <div class="card-body table-responsive">
                        <router-link v-bind:to="{name:'distributor-create'}" class="btn btn-sm btn-primary">Tambah</router-link>
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Notelp</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(distributor, index) in distributors" v-bind:key="distributor.id">
                                    <td>{{distributor.nama}}</td>
                                    <td>{{distributor.notelp}}</td>
                                    <td>{{distributor.alamat}}</td>
                                    <td>
                                        <router-link v-bind:to="{name:'distributor-edit', params:{id:distributor.id}}" class="btn btn-sm btn-success">Edit</router-link>
                                        <button v-on:click="DeleteDistributor(distributor.id, index)" class="btn btn-sm btn-danger">Delete</button>
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
        let uri = '/api/distributor';
        this.axios.get(uri)
            .then((response) => {
                this.distributors = response.data.data;
            })
    },
    data(){
        return{
            distributors:[]
        }
    },
    methods:{
        DeleteDistributor(id, index){
            let uri = `/api/distributor/${id}`;
            this.axios.delete(uri)
                .then((response) => {
                    this.distributors.splice(index, 1);
                }).catch((error)=>{
                    alert(error.response.data.message);
                })
        }
    }
}
</script>
