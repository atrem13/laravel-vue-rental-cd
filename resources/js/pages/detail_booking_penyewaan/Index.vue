<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Index Detail Booking Penyewaan
                    </div>
                    <div class="card-body table-responsive">
                        <router-link v-bind:to="{name:'booking-penyewaan'}" class="btn btn-sm btn-secondary mb-3">Back</router-link>
                        <div v-if="detail_booking_penyewaans">
                            <table class="table mb-3">
                                <thead>
                                    <tr>
                                        <th>Judul Kaset</th>
                                        <th>Deskripsi</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(detail_booking_penyewaan, index) in detail_booking_penyewaans" v-bind:key="detail_booking_penyewaan.id">
                                        <td>{{detail_booking_penyewaan.kaset.judul}}</td>
                                        <td>{{detail_booking_penyewaan.kaset.deskripsi}}</td>
                                        <td>{{detail_booking_penyewaan.kaset.jumlah}}</td>
                                        <td>{{detail_booking_penyewaan.status}}</td>
                                        <td>
                                            <button v-on:click="DeleteDetailBookingPenyewaan(detail_booking_penyewaan.id, index, detail_booking_penyewaan.kaset_id)" class="btn btn-sm btn-danger">
                                                cancel
                                            </button>
                                            <button v-on:click="KonfirmBookingTersedia(detail_booking_penyewaan.id, index)" class="btn btn-sm btn-warning">
                                                siap dibooking
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td>
                                            <router-link v-bind:to="{name:'booking-penyewaan'}" class="btn btn-sm btn-success">Selesai</router-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-if="this.$route.params.purpose != 'konfirm'">
                            <div if="kasets">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(kaset, index) in kasets" v-bind:key="kaset.id">
                                            <td>{{kaset.judul}}</td>
                                            <td>{{kaset.deskripsi}}</td>
                                            <td>{{kaset.jumlah}}</td>
                                            <td>
                                                <button v-on:click="AddDetailBookingPenyewaan(kaset.id, kaset.jumlah,index)" class="btn btn-sm btn-primary">Add</button>
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
    </div>
</template>
<script>
export default {
    created(){
        let uri = `/api/detail_booking_penyewaan/${this.$route.params.id}`;
        this.axios.get(uri)
            .then((response) => {
                this.detail_booking_penyewaans = response.data.data;
            });
        let uri2 = `/api/create/detail_booking_penyewaan/${this.$route.params.id}`;
        this.axios.get(uri2)
            .then((response) => {
                this.kasets = response.data.data;
            });
        // console.log(new Date(dateString));
    },
    data(){
        return{
            kasets:{},
            detail_booking_penyewaans:{},
            kaset_dipilih:{
                kaset_id:'',
                booking_penyewaan_id:this.$route.params.id,
                // jumlah:'',
                status:0
            },
            konfirm_kaset:{}
        }
    },
    methods:{
        DeleteDetailBookingPenyewaan(id, index, kaset_id){
            this.kaset_dipilih.kaset_id = kaset_id;
            let uri = `/api/detail_booking_penyewaan/${id}`;
            this.axios.put(uri, this.kaset_dipilih)
                .then((response) => {
                    this.detail_booking_penyewaans.splice(index, 1);
                    this.kasets.push(response.data.data);
                }).catch((error)=>{
                    alert(error.response.data.message);
                });
        },
        AddDetailBookingPenyewaan(kaset_id, jumlah, index){
            this.kaset_dipilih.kaset_id = kaset_id;
            if(jumlah!=0){
                this.kaset_dipilih.status = 1;
            }

            let uri = '/api/detail_booking_penyewaan';
            this.axios.post(uri, this.kaset_dipilih)
                .then((response) => {
                    this.kasets.splice(index, 1);
                    this.detail_booking_penyewaans.push(response.data.data);
                }).catch((error) => {
                    alert(error.response.data.message);
                });
        },
        KonfirmBookingTersedia(id, index){
            this.konfirm_kaset.detail_booking_penyewaan_id = id;
            let current_datetime = new Date()
            let formatted_date = current_datetime.getFullYear() + "-" + (current_datetime.getMonth() + 1) + "-" + current_datetime.getDate()

            this.konfirm_kaset.tanggal_diletakan = formatted_date;
            this.konfirm_kaset.status = 1;
            let uri = '/api/booking_penyewaan_tersedia';
            this.axios.post(uri, this.konfirm_kaset)
                .then((response) => {
                    let uri2 = `/api/detail_booking_penyewaan/${id}`;
                    this.axios.delete(uri2)
                        .then((response) => {
                            this.detail_booking_penyewaans.splice(index, 1);
                            this.detail_booking_penyewaans.push(response.data.data);
                        }).catch((error) => {
                            alert('gagal1');
                        });
                }).catch((error) => {
                    alert('gagal2');
                });

        }
    }
}
</script>
