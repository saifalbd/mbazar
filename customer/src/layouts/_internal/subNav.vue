<template>
<!-- Image and text -->
<div class="e-sub-nav" v-show="$root.canSubMenus">
    <div class="e-left">
<button class="e-btn e-list-item menu-open" @click="$root.showAside = !$root.showAside">
              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
    <path fill="currentColor" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" />
</svg>
          </button>
    </div>
    <div class="e-middle">
    <template v-for="(menu,key) in resource.client_sub_menus" >
<a :href="menu.url" class="e-list-item"  :key="key" >{{menu.title}}</a>
    </template>

    </div>
    <div class="e-right e-pr-5">
         <a class="e-cart-btn e-p-5 e-fixed-in-small" :href="resource.header_right.wishCount.url">

            <svg class="e-icon" viewBox="0 0 24 24">
    <path fill="currentColor" d="M10,0V4H8L12,8L16,4H14V0M1,2V4H3L6.6,11.59L5.25,14.04C5.09,14.32 5,14.65 5,15A2,2 0 0,0 7,17H19V15H7.42C7.29,15 7.17,14.89 7.17,14.75L7.2,14.63L8.1,13H15.55C16.3,13 16.96,12.59 17.3,11.97L21.16,4.96L19.42,4H19.41L18.31,6L15.55,11H8.53L8.4,10.73L6.16,6L5.21,4L4.27,2M7,18A2,2 0 0,0 5,20A2,2 0 0,0 7,22A2,2 0 0,0 9,20A2,2 0 0,0 7,18M17,18A2,2 0 0,0 15,20A2,2 0 0,0 17,22A2,2 0 0,0 19,20A2,2 0 0,0 17,18Z" />
</svg>
             <span class="e-title e-hide-in-small">
                carts
            </span>
            <span class="e-count">
                {{resource.header_right.wishCount.count}}
            </span>

        </a>
    </div>
</div>
</template>

<script>
import token from './token.vue'
export default {
    comments: {
        token
    },
    props: {

        resource: {

        }
    },
    data() {
        return {
            isShowLoginRegister: true,
            isUserMenus:true,
        }
    },
    methods: {
        isLogged() {
            return this.$root.res.userId;
        },

    },
    mounted() {

    }

}
</script>

<style>

</style>
