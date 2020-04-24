<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Index Pengembalian
                    </div>
                    <div class="card-body table-responsive">
                        <router-link v-bind:to="{name:'penyewaan'}" class="btn btn-sm btn-secondary mb-3">Back</router-link>
                        <div class="mb-5" v-if="pengembalians">
                            <h2>List kaset disewa oleh {{member.nama}} harus kembali pada {{penyewaan.tanggal_kembali}}</h2>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Dp</th>
                                        <th>Sisa Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pengembalian in pengembalians" v-bind:key="pengembalian.id">
                                        <td>{{pengembalian.kaset.judul}}</td>
                                        <td>{{pengembalian.kaset.deskripsi}}</td>
                                        <td>Rp. {{pengembalian.dp}}</td>
                                        <td>Rp. {{pengembalian.sisa_pembayaran}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td>Rp. {{penyewaan.total_dp}}</td>
                                        <td>Rp. {{penyewaan.total_sisa_pembayaran}}</td>
                                    </tr>
                                    <tr>
                                        <td>Telat: </td>
                                        <td class="form-inline">
                                            {{range}}-hari
                                        </td>
                                        <td colspan="">Denda: </td>
                                        <td>
                                            {{Denda}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td>Total:</td>
                                        <td>{{penyewaan.total_sisa_pembayaran + penyewaan.denda}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>
                                            <button v-on:click="Konfirm" class="btn btn-sm btn-success">Konfirm</button>
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
        let uri = `/api/pengembalian/${this.$route.params.id}`;
        this.axios.get(uri)
            .then((response) => {
                this.pengembalians = response.data.pengembalians;
                this.penyewaan = response.data.penyewaan;
                this.member = response.data.member;
            });
    },
    data(){
        return{
            pengembalians:{},
            member:{},
            penyewaan:{},
            range:0
            // denda:0
            // denda:this.telat * this.penyewaan.total_sisa_pembayaran * 20/100
        }
    },
    methods:{
        Konfirm(){
            let uri = 'api/pengembalian/konfirm';
            this.axios.post(uri, this.penyewaan)
                .then((response) => {
                    // console.log(response.data.data);
                    this.$router.push({
                        name:'penyewaan'
                    });
                }).catch((error) => {
                    alert(error.response.data.message);
                });
            // console.log(this.penyewaan);
        }
    },
    computed:{
        Denda:function(){
            let current_datetime = new Date()
            let formatted_date = current_datetime.getFullYear() + "-" + (current_datetime.getMonth() + 1) + "-" + current_datetime.getDate();

            let oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
            let firstDate = new Date(formatted_date);
            let secondDate = new Date(this.penyewaan.tanggal_kembali);
            let diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
            this.range = diffDays;

            console.log(this.range);

            this.penyewaan.denda = Math.round(this.range * ( ( parseInt(this.penyewaan.total_sisa_pembayaran) + parseInt(this.penyewaan.total_dp) ) * 10/100));
            return this.penyewaan.denda;
        }
    }
}
</script>
