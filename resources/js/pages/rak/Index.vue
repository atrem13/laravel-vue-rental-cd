<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 ">
                <div class="card">
                    <div class="card-header">
                        Index Rak
                    </div>
                    <div class="card-body">
                        <router-link v-bind:to="{name:'rak-create'}" class="btn btn-sm btn-primary">Tambah</router-link>
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(rak, index) in raks" v-bind:key="rak.id">
                                    <td>{{rak.nama}}</td>
                                    <td>
                                        <router-link v-bind:to="{name:'rak-edit', params:{id:rak.id}}" class="btn btn-sm btn-success">Edit</router-link>
                                        <button v-on:click="DeleteRak(rak.id, index)" class="btn btn-sm btn-danger">Delete</button>
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
        let uri = '/api/rak';
        this.axios.get(uri)
            .then((response) => {
                this.raks = response.data.data;
            });
    },
    data(){
        return{
            raks:[]
        }
    },
    methods:{
        DeleteRak(id, index){
            let uri = `/api/rak/${id}`;
            this.axios.delete(uri)
                .then((response) => {
                    this.raks.splice(index, 1);
                }).catch((error) => {
                    alert(error.response.data.message);
                });
        }
    }
}
</script>
