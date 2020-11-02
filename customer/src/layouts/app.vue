<template>

    

<div id="app-inner"  :class="$root.showAside?'app-with-aside':false">
    <MobileCartIcon></MobileCartIcon>
    <header :class="$root.canSubMenus?'e-with-sub-menus':false">
        <Header></Header>
    </header>

    <aside >
        <SideNav></SideNav>
        </aside>
    <main>

    <div class="app-container">
     
<slot/>
    </div>
    <footer>
        <Footer></Footer>
    </footer>

        </main>

</div>
  
</template>

<script>
import Header from './_internal/header.vue';
import Footer from './_internal/footer.vue';
import SideNav from './_internal/sideNav.vue';
import MobileCartIcon from './_internal/mobileCartIcon.vue';

export default {
    components:{
        Header,Footer,SideNav,MobileCartIcon
    },
    data(){
        return {
               showAside:true,
    canSubMenus:false
        }
    },
    mounted(){
        console.log(this.$store.state.header);
    }
}
</script>

<style>

</style>