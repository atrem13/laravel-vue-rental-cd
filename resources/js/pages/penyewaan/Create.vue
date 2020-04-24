<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        Add Penyewaan
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="AddPenyewaan">
                            <div class="form-group">
                              <label for="">Member</label>
                              <select class="form-control" v-model="penyewaan.member_id">
                                  <option value="">-Pilih-</option>
                                  <option v-for="item in members" v-bind:key="item.id" v-bind:value="item.id">{{item.nama}}</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="">Tanggal Sewa</label>
                              <input type="date"  class="form-control" placeholder="" v-model="penyewaan.tanggal_sewa">
                            </div>
                            <div class="form-group">
                              <label for="">Tanggal Kembali</label>
                              <input type="date"  class="form-control" placeholder="" v-model="penyewaan.tanggal_kembali">
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
        let uri = '/api/create/penyewaan';
        this.axios.get(uri)
            .then((response) => {
                this.members = response.data.data;
            });
    },
    data(){
        return{
            members:{},
            penyewaan:{
                // test: Math.floor(new Date().valueOf()+Math.random())
                no_penyewaan:new Date().getTime()
            },
            validation:[],
            range:0
        }
    },
    methods:{
        AddPenyewaan(){
            let oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
            let firstDate = new Date(this.penyewaan.tanggal_sewa);
            let secondDate = new Date(this.penyewaan.tanggal_kembali);
            let diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
            this.range = diffDays;
            console.log(this.range);

            let uri = '/api/penyewaan';
            this.axios.post(uri, this.penyewaan)
                .then((response) => {
                    this.$router.push({
                        name:'detail-penyewaan',
                        params:{id:response.data.data, range:this.range}
                    });
                }).catch((error) => {
                    this.validation = error.response.data.data;
                });
            console.log(this.penyewaan);
        }
    }
}
</script>
