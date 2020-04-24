<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Index Booking Penyewaan
                    </div>
                    <div class="card-body table-responsive">
                        <router-link v-bind:to="{name:'booking-penyewaan-create'}" class="btn btn-sm btn-primary">Tambah</router-link>
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>Nomor Booking</th>
                                    <th>Nama Member</th>
                                    <th>Tanggal Booking</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(booking_penyewaan, index) in booking_penyewaans" v-bind:key="booking_penyewaan.id">
                                    <td>{{booking_penyewaan.no_booking}}</td>
                                    <td>{{booking_penyewaan.member.nama}}</td>
                                    <td>{{booking_penyewaan.tanggal_booking}}</td>
                                    <td>{{booking_penyewaan.status}}</td>
                                    <td>
                                        <router-link v-bind:to="{name:'booking-penyewaan-edit', params:{id:booking_penyewaan.id}}" class="btn btn-sm btn-success">Edit</router-link>
                                        <button v-on:click="DeleteBookingPenyewaan(booking_penyewaan.id, index)" class="btn btn-sm btn-danger">Delete</button>
                                        <router-link v-bind:to="{name:'detail-booking-penyewaan', params:{id:booking_penyewaan.id, purpose:'konfirm'}}" class="btn btn-sm btn-secondary">Detail</router-link>
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
        let uri = '/api/booking_penyewaan';
        this.axios.get(uri)
            .then((response) => {
                this.booking_penyewaans = response.data.data;
            });
    },
    data(){
        return{
            booking_penyewaans:{}
        }
    },
    methods:{
        DeleteBookingPenyewaan(id, index){
            let uri = `/api/booking_penyewaan/${id}`;
            this.axios.delete(uri)
                .then((response) => {
                    this.booking_penyewaans.splice(index, 1);
                }).catch((error) => {
                    alert(error.response.data.message);
                })
        }
    }
}
</script>
