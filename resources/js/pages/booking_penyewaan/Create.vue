<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        Add Booking Penyewaan
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="AddBookingPenyewaan">
                            <div class="form-group">
                              <label for="">Member</label>
                              <select class="form-control" v-model="booking_penyewaan.member_id">
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
        let uri = '/api/create/booking_penyewaan';
        this.axios.get(uri)
            .then((response) => {
                this.members = response.data.data;
            });
    },
    data(){
        return{
            members:{},
            booking_penyewaan:{
                // test: Math.floor(new Date().valueOf()+Math.random())
                no_booking:new Date().getTime()
            },
            validation:[]
        }
    },
    methods:{
        AddBookingPenyewaan(){
            let uri = '/api/booking_penyewaan';
            this.axios.post(uri, this.booking_penyewaan)
                .then((response) => {
                    this.$router.push({
                        name:'detail-booking-penyewaan',
                        params:{id:response.data.data}
                    });
                }).catch((error) => {
                    this.validation = error.response.data.data;
                });
            // console.log(this.penyewaan);
        }
    }
}
</script>
