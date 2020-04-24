<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        Index Member
                    </div>
                    <div class="card-body table-responsive ">
                        <router-link v-bind:to="{name:'member-create'}" class="btn btn-sm btn-primary">
                            Tambah Member
                        </router-link>
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Nomor Telepon</th>
                                    <th>Alamat</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(member,index) in members" v-bind:key="member.id">
                                    <td>{{member.nik}}</td>
                                    <td>{{member.nama}}</td>
                                    <td>{{member.notelp}}</td>
                                    <td>{{member.alamat}}</td>
                                    <th>
                                        <router-link v-bind:to="{name:'member-edit', params:{id:member.id}}" class="btn btn-sm btn-success">
                                            Edit
                                        </router-link>
                                        <button v-on:click.prevent="DeleteMember(member.id, index)" class="btn btn-sm btn-danger">Delete</button>
                                    </th>
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
        let uri = '/api/member';
        this.axios.get(uri)
            .then((response) => {
                this.members = response.data.data
            });
    },
    data(){
        return{
            members:[]
        }
    },
    methods:{
        DeleteMember(id, index){
            let uri = `/api/member/${id}`;
            this.axios.delete(uri)
                .then((response) => {
                    this.members.splice(index, 1);
                }).catch((error) => {
                    alert(error.response.data.message);
                });
        }
    }
}
</script>
