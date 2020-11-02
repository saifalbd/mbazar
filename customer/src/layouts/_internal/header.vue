<template>
<div class="e-header-inner">
    <topNav :resource="resource"></topNav>
    <subNav :resource="resource"></subNav>


</div>
</template>

<script>
import topNav from './topNav.vue';
import subNav from './subNav.vue'
export default {
    components:{
        topNav,
        subNav
    },

    props: {

    },
    data() {
        return {
            resource:{},
            isShowLoginRegister: true,
            isUserMenus:true,
        }
    },
    methods: {
        isLogged() {
            return this.$root.res.userId;
        },

    },
    created(){

        this.resource = this.$root.res.header;

    },
    mounted() {}

}
</script>

<style>

</style>
