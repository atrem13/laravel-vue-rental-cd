<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        Edit Booking Penyewaan
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="UpdateBookingPenyewaan">
                            <div class="form-group">
                              <select class="form-control" v-model="booking_penyewaan.member_id" disabled readonly>
                                  <option value="">-Pilih-</option>
                                  <option v-for="item in members" v-bind:key="item.id" v-bind:value="item.id">{{item.nama}}</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="">Tanggal Booking</label>
                              <input type="date"  class="form-control" placeholder="" v-model="booking_penyewaan.tanggal_booking">
                            </div>
                            <div class="form-group">
                                <button type="reset" class="btn btn-sm btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-sm btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    created(){
        let uri = `/api/booking_penyewaan/${this.$route.params.id}`;
        this.axios.get(uri)
            .then((response) => {
                this.booking_penyewaan = response.data.data;
                console.log(this.booking_penyewaan);
            }).catch((error) => {
                alert(error.response.data.message);
            });
        let uri2 = '/api/create/booking_penyewaan';
        this.axios.get(uri2)
            .then((response) => {
                this.members = response.data.data;
            });
    },
    data(){
        return{
            members:{},
            booking_penyewaan:{},
            validation:[]
        }
    },
    methods:{
        UpdateBookingPenyewaan(){
            let uri = `/api/booking_penyewaan/${this.$route.params.id}`;
            this.axios.put(uri, this.booking_penyewaan)
                .then((response) => {
                    this.$router.push({
                        name:'booking-penyewaan'
                    });
                }).catch((error) => {
                    this.validation = error.response.data.data;
                });
            // console.log(this.penyewaan);
        }
    }
}
</script>
