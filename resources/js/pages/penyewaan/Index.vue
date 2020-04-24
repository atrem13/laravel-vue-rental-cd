<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Index Penyewaan
                    </div>
                    <div class="card-body table-responsive">
                        <router-link v-bind:to="{name:'penyewaan-create'}" class="btn btn-sm btn-primary">Tambah</router-link>
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>Nomor Penyewaan</th>
                                    <th>Nama Member</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Total DP</th>
                                    <th>Total Sisa Pembayaran</th>
                                    <th>Denda</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(penyewaan, index) in penyewaans" v-bind:key="penyewaan.id">
                                    <td>{{penyewaan.no_penyewaan}}</td>
                                    <td>{{penyewaan.member.nama}}</td>
                                    <td>{{penyewaan.tanggal_sewa}}</td>
                                    <td>{{penyewaan.tanggal_kembali}}</td>
                                    <td>{{penyewaan.total_dp}}</td>
                                    <td>{{penyewaan.total_sisa_pembayaran}}</td>
                                    <td>{{penyewaan.denda}}</td>
                                    <td>{{penyewaan.status}}</td>
                                    <td>
                                        <router-link v-bind:to="{name:'penyewaan-edit', params:{id:penyewaan.id}}" class="btn btn-sm btn-success">Edit</router-link>
                                        <button v-on:click="DeletePenyewaan(penyewaan.id, index)" class="btn btn-sm btn-danger">Delete</button>
                                        <!-- <router-link v-bind:to="{name:'detail-penyewaan', params:{id:penyewaan.id}}" class="btn btn-sm btn-secondary">Detail</router-link> -->
                                        <router-link v-bind:to="{name:'pengembalian', params:{id:penyewaan.id}}" class="btn btn-sm btn-warning  ">Pengembalian</router-link>
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
        let uri = '/api/penyewaan';
        this.axios.get(uri)
            .then((response) => {
                this.penyewaans = response.data.data;
            });
    },
    data(){
        return{
            penyewaans:{}
        }
    },
    methods:{
        DeletePenyewaan(id, index){
            let uri = `/api/penyewaan/${id}`;
            this.axios.delete(uri)
                .then((response) => {
                    this.penyewaans.splice(index, 1);
                }).catch((error) => {
                    alert(error.response.data.message);
                })
        }
    }
}
</script>
