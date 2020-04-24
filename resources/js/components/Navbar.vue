<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
            <a class="navbar-brand" href="#">Rental CD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item" v-for="(item, index) in routes" v-bind:key="index">
                    <router-link  v-bind:to="{name:item.name}" class="nav-link">{{item.name}}</router-link>
                </li>
                </ul>
            </div>
        </nav>
    </div>
</template>
<script>
export default {
    data(){
        return{
            routes:[
                    // home
                    {
                        name:'home'
                    },
                    // member
                    {
                        name:'member'
                    },
                    // distributor
                    {
                        name:'distributor'
                    },
                    // kategori kaset
                    {
                        name:'kategori-kaset'
                    },
                    // kategori film
                    {
                        name:'kategori-film'
                    },
                    // rak
                    {
                        name:'rak'
                    },
                    // kaset
                    {
                        name:'kaset'
                    },
                    // penyewaan
                    {
                        name:'penyewaan'
                    },
                    // booking penyewaan
                    {
                        name:'booking-penyewaan'
                    }
            ]
        }
    }
}
</script>
