<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        Edit Penyewaan
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent="UpdatePenyewaan">
                            <div class="form-group">
                              <select class="form-control" v-model="penyewaan.member_id" disabled readonly>
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
        let uri = `/api/penyewaan/${this.$route.params.id}`;
        this.axios.get(uri)
            .then((response) => {
                this.penyewaan = response.data.data;
                console.log(this.penyewaan);
            }).catch((error) => {
                alert(error.response.data.message);
            });
        let uri2 = '/api/create/penyewaan';
        this.axios.get(uri2)
            .then((response) => {
                this.members = response.data.data;
            });
    },
    data(){
        return{
            members:{},
            penyewaan:{
                // test: Math.floor(new Date().valueOf()+Math.random())
                // no_penyewaan:new Date().getTime()
            },
            validation:[]
        }
    },
    methods:{
        UpdatePenyewaan(){
            let uri = `/api/penyewaan/${this.$route.params.id}`;
            this.axios.put(uri, this.penyewaan)
                .then((response) => {
                    this.$router.push({
                        name:'penyewaan'
                    });
                }).catch((error) => {
                    this.validation = error.response.data.data;
                });
            // console.log(this.penyewaan);
        }
    }
}
</script>
