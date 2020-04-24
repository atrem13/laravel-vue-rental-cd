<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        Create Kaset
                    </div>
                  <div class="card-body">
                      <form v-on:submit.prevent="UpdateKaset">
                          <div class="form-group">
                            <label for="">Judul</label>
                            <input type="text"  class="form-control" placeholder="" v-model="kaset.judul">
                            <span class="btn btn-sm btn-danger" v-if="validation.judul">{{validation.judul[0]}}</span>

                          </div>
                          <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea rows="5" type="text"  class="form-control" placeholder="" v-model="kaset.deskripsi"></textarea>
                            <span class="btn btn-sm btn-danger" v-if="validation.deskripsi">{{validation.deskripsi[0]}}</span>

                          </div>
                          <div class="form-group">
                            <label for="">Kategori Kaset</label>
                            <select class="form-control" v-model="kaset.kategori_kaset_id">
                                <option value="">-pilih-</option>
                                <option v-for="item in bahan_kaset['kategori_kasets']" v-bind:key="item.id" v-bind:value="item.id">{{item.nama}}</option>
                            </select>
                            <span class="btn btn-sm btn-danger" v-if="validation.kategori_kaset_id">{{validation.kategori_kaset_id[0]}}</span>

                          </div>
                          <div class="form-group">
                            <label for="">Kategori Film</label>
                            <div class="row">
                                <div class="col-sm-10 offset-1">
                                    <div class="row">
                                        <div class="col-sm-3" v-for="item in bahan_kaset['kategori_films']" v-bind:key="item.id">
                                            <input type="checkbox" v-bind:value="item.id" v-model="kaset.kategori_films">
                                            <label for="">{{item.nama}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="btn btn-sm btn-danger" v-if="validation.kategori_films">{{validation.kategori_films[0]}}</span>

                          </div>
                          <div class="form-group">
                            <label for="">Jumlah</label>
                            <input type="number"  class="form-control" placeholder="" v-model="kaset.jumlah">
                            <span class="btn btn-sm btn-danger" v-if="validation.jumlah">{{validation.jumlah[0]}}</span>

                          </div>
                          <div class="form-group">
                            <label for="">Harga Beli</label>
                            <input type="number"  class="form-control" placeholder="" v-model="kaset.harga_beli">
                            <span class="btn btn-sm btn-danger" v-if="validation.harga_beli">{{validation.harga_beli[0]}}</span>

                          </div>
                          <!-- <div class="form-group">
                            <label for="">Harga Sewa</label>
                            <input type="number"  class="form-control" placeholder="" v-model="kaset.harga_sewa">
                            <span class="btn btn-sm btn-danger" v-if="validation.harga_sewa">{{validation.harga_sewa[0]}}</span>

                          </div> -->
                          <div class="form-group">
                            <label for="">Rak</label>
                            <select class="form-control" v-model="kaset.rak_id">
                                <option value="">-pilih-</option>
                                <option v-for="item in bahan_kaset['raks']" v-bind:key="item.id" v-bind:value="item.id">{{item.nama}}</option>
                            </select>
                            <span class="btn btn-sm btn-danger" v-if="validation.rak_id">{{validation.rak_id[0]}}</span>

                          </div>
                          <div class="form-group">
                            <label for="">Distributor</label>
                            <select class="form-control" v-model="kaset.distributor_id">
                                <option value="">-pilih-</option>
                                <option v-for="item in bahan_kaset['distributors']" v-bind:key="item.id" v-bind:value="item.id">{{item.nama}}</option>
                            </select>
                            <span class="btn btn-sm btn-danger" v-if="validation.distributor_id">{{validation.distributor_id[0]}}</span>

                          </div>
                          <div class="form-group">
                              <button type="reset" class="btn btn-sm btn-secondary">Reset</button>
                              <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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

        let uri2 = `/api/kaset/${this.$route.params.id}`;
        this.axios.get(uri2)
            .then((response) => {
                this.kaset = response.data.data;
                this.kaset.kategori_films = response.data.kategori_films;
                // console.log(this.kaset);
            }).catch((error) => {
                alert(error.response.data.message);
            });
        let uri ='/api/create/kaset';
        this.axios.get(uri)
            .then((response) => {
                this.bahan_kaset = response.data.data;
            });
    },
    data(){
        return{
            bahan_kaset:[],
            kaset:{
                kategori_films:[],
                harga_sewa:''
            },
            validation:[]
        }
    },
    methods:{
        UpdateKaset(){
            // this.kaset.harga_sewa = parseInt(this.kaset.harga_beli) + (this.kaset.harga_beli * 10/100);
            this.kaset.harga_sewa = Math.round(this.kaset.harga_beli * 25/100);

            let uri =  `/api/kaset/${this.$route.params.id}`;
            this.axios.put(uri, this.kaset)
                .then((response) => {
                    // console.log(response);
                    this.$router.push({
                        name:'kaset'
                    });
                }).catch((error) => {
                    this.validation = error.response.data.data;
                    // console.log(error);
                    // alert(error.response.data.message);
                });
            console.log(this.kaset);
        }
    }
}
</script>
