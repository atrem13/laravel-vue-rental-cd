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
                        <div v-if="booking_penyewaan_tersedias">
                            <table class="table mb-3">
                                <thead>
                                    <tr>
                                        <th>Nomor Booking</th>
                                        <th>Judul Kaset</th>
                                        <th>Tanggal Booking</th>
                                        <th>Tanggal Diletakan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in booking_penyewaan_tersedias" v-bind:key="item.id">
                                        <td>{{item.booking_penyewaan.no_booking}}</td>
                                        <td>{{item.kaset.judul}}</td>
                                        <td>{{item.booking_penyewaan.tanggal_booking}}</td>
                                        <td>{{item.booking_penyewaan_tersedia.tanggal_diletakan}}</td>
                                        <td>{{item.booking_penyewaan_tersedia.status}}</td>
                                        <td>
                                            <button v-on:click="BookingDiambil(item.booking_penyewaan_tersedia.id, item.id ,index)" class="btn btn-sm btn-success">
                                                Diambil
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
    </div>
</template>
<script>
export default {
    created(){
        let uri = '/api/booking_penyewaan_tersedia';
        this.axios.get(uri)
            .then((response) => {
                // console.log(response.data.data)
                this.booking_penyewaan_tersedias = response.data.data;
                console.log(this.booking_penyewaan_tersedias);
            });
    },
    data(){
        return{
            booking_penyewaan_tersedias:[],
            diambil:{}
        }
    },
    methods:{
        BookingDiambil(id, id2, index){
            this.diambil.booking_penyewaan_tersedia_id = id;
            this.diambil.detail_booking_penyewaan_id = id2;
            let uri = `/api/booking_penyewaan_tersedia/${id}`;
            this.axios.put(uri, this.diambil)
                .then((response) => {
                    this.booking_penyewaan_tersedias.splice(index, 1);
                    this.booking_penyewaan_tersedias.push(response.data.data);
                }).catch((error) => {
                    alert(error.response.data.message);
                })
        }
    }
}
</script>

