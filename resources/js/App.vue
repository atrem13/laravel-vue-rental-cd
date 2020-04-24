<template>
    <div>
        <NavBar></NavBar>
        <router-view></router-view>
    </div>
</template>

<script>
import NavBar from './components/Navbar'
export default {
    created(){
        // console.log(this.$root.$data.routes);
    },
    components:{
        NavBar
    }

}
</script>
