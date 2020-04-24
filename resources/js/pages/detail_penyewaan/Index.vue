<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Index Detail Peminjaman
                    </div>
                    <div class="card-body table-responsive">
                        <router-link v-bind:to="{name:'penyewaan'}" class="btn btn-sm btn-secondary mb-3">Back</router-link>
                        <div class="mb-5" v-if="detail_penyewaans">
                            <h2>List Kaset Disewa</h2>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Dp</th>
                                        <th>Sisa Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(detail_penyewaan, index) in detail_penyewaans" v-bind:key="detail_penyewaan.id">
                                        <td>{{detail_penyewaan.kaset.judul}}</td>
                                        <td>{{detail_penyewaan.kaset.deskripsi}}</td>
                                        <td>Rp. {{detail_penyewaan.dp}}</td>
                                        <td>Rp. {{detail_penyewaan.sisa_pembayaran}}</td>
                                        <td>
                                            <button v-on:click="DeleteDetailPenyewaan(detail_penyewaan.id, index, detail_penyewaan.dp, detail_penyewaan.sisa_pembayaran, detail_penyewaan.kaset_id)" class="btn btn-sm btn-danger">Cancel</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td>Rp. {{total_dp}}</td>
                                        <td>Rp. {{total_sisa_pembayaran}}</td>
                                        <td>
                                            <router-link v-bind:to="{name:'penyewaan'}" class="btn btn-sm btn-success mb-3">Selesai</router-link>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-if="kasets">
                            <h2>List Kaset Tersedia</h2>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Harga Sewa</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(kaset, index) in kasets" v-bind:key="kaset.id">
                                        <td>{{kaset.judul}}</td>
                                        <td>{{kaset.deskripsi}}</td>
                                        <td>Rp. {{kaset.harga_sewa}} x {{range}} = Rp. {{kaset.harga_sewa * range}}</td>
                                        <td>{{kaset.jumlah}}</td>
                                        <td>
                                            <div v-if="kaset.jumlah<1">
                                                <button class="btn btn-sm btn-warning">Sold Out</button>
                                            </div>
                                            <div v-if="kaset.jumlah>0">
                                                <button v-on:click="AddDetailPenyewaan(kaset.id, kaset.harga_sewa, index)" class="btn btn-sm btn-primary">Add</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    created(){
        let uri = `/api/detail_penyewaan/${this.$route.params.id}`;
        this.axios.get(uri)
            .then((response) => {
                this.detail_penyewaans = response.data.data;
                this.detail_penyewaans.forEach(item => {
                    this.total_dp += item.dp;
                    this.total_sisa_pembayaran += item.sisa_pembayaran;
                });
                // console.log(this.total_dp);
                // console.log(this.total_sisa_pembayaran);
            });
        let uri2 = `/api/create/detail_penyewaan/${this.$route.params.id}`;
        this.axios.get(uri2)
            .then((response) => {
                this.kasets = response.data.data;
            });

    },
    data(){
        return{
            detail_penyewaans:{},
            kasets:{},
            kaset_pilihan:{
                penyewaan_id: this.$route.params.id,
                kaset_id:'',
                dp:'',
                sisa_pembayaran:''
            },
            total_dp:0,
            total_sisa_pembayaran:0,
            range:this.$route.params.range
            // detail_penyewaan_pilihan:{
            //     penyewaan_id: this.$route.params.id,
            //     kaset_id:'',
            //     dp:'',
            //     sisa_pembayaran:''
            // }
        }
    },
    methods:{
        AddDetailPenyewaan(id, harga_sewa, index){
            this.kaset_pilihan.kaset_id = id;
            this.kaset_pilihan.dp = Math.round(this.range * (harga_sewa*60/100));
            this.kaset_pilihan.sisa_pembayaran = Math.round(this.range * (harga_sewa*40/100));
            // console.log(this.kaset_pilihan);
            let uri = '/api/detail_penyewaan';
            this.axios.post(uri, this.kaset_pilihan)
                .then((response) => {
                    this.total_dp += this.kaset_pilihan.dp;
                    this.total_sisa_pembayaran += this.kaset_pilihan.sisa_pembayaran;
                    this.kasets.splice(index,1);
                    this.detail_penyewaans.push(response.data.data);
                    // console.log(this.detail_penyewaans);
                }).catch((error) => {
                    alert(error.response.data.message);
                })
            // console.log(this.kaset_pilihan.penyewaan_id);
        },
        DeleteDetailPenyewaan(id, index, dp, sisa_pembayaran, kaset_id){
            this.kaset_pilihan.kaset_id = kaset_id;
            this.kaset_pilihan.dp = dp;
            this.kaset_pilihan.sisa_pembayaran = sisa_pembayaran;
            console.log(this.kaset_pilihan);
            let uri = `/api/detail_penyewaan/${id}`;
            this.axios.put(uri, this.kaset_pilihan)
                .then((response) => {
                    this.total_dp -= this.kaset_pilihan.dp;
                    this.total_sisa_pembayaran -= this.kaset_pilihan.sisa_pembayaran;
                    // console.log(response.data.data);
                    this.detail_penyewaans.splice(index, 1);
                    this.kasets.push(response.data.data);
                }).catch((error) => {
                    alert(error.response.data.message);
                })
        }
    }
}
</script>
