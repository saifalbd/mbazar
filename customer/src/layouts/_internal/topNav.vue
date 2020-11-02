<template>
<!-- Image and text -->
<div class="e-nav">
    <div class="e-left flex">
        <a class="e-logo e-sm-none"

        :href="resource.light_logo.url">
            <img :src="resource.light_logo.src" alt="" srcset="">


        </a>
         <button class="e-btn e-list-item menu-open"
          :class="$root.canSubMenus?'e-lg-none':false"
         @click="$root.showAside = !$root.showAside">
              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
    <path fill="currentColor" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" />
</svg>
          </button>
    </div>
    <div class="e-middle ">
        <div class="e-search-panel">
  <div class="e-search-box" >
            <button class="e-search-btn">
                search
            </button>
            <input class="e-search-input" type="text" placeholder="Type your email">
        </div>
        <!-- <ul class="e-search-collection">
            <li>
                ddsflkdl
            </li>
             <li>
                ddsflkdl
            </li>
        </ul> -->

        <!-- all search item hear -->
        </div>

    </div>
    <div class="e-right flex content-center items-center">
        <a class="e-list-item e-sm-none flex" :href="resource.header_right.contact_us.url">
            <svg viewBox="0 0 24 24" class="e-icon">
                <path fill="currentColor" d="M4,3A1,1 0 0,0 3,4A17,17 0 0,0 20,21A1,1 0 0,0 21,20V16.5A1,1 0 0,0 20,15.5C18.76,15.5 17.55,15.3 16.43,14.93C16.08,14.82 15.69,14.9 15.41,15.18L13.21,17.38C10.38,15.94 8.07,13.62 6.62,10.79L8.82,8.58C9.1,8.31 9.18,7.92 9.07,7.57C8.7,6.45 8.5,5.24 8.5,4A1,1 0 0,0 7.5,3M16,3V6H13V8H16V11H18V8H21V6H18V3" />
            </svg>
            <span class="e-title">
                {{resource.header_right.contact_us.title}}
            </span>

        </a>
        <a class="e-list-item flex items-center" :href="resource.header_right.offer.url">
            <svg viewBox="0 0 24 24" class="e-icon">
                <path fill="currentColor" d="M21.41,11.58L12.41,2.58C12.04,2.21 11.53,2 11,2H4A2,2 0 0,0 2,4V11C2,11.53 2.21,12.04 2.59,12.41L3,12.81C3.9,12.27 4.94,12 6,12A6,6 0 0,1 12,18C12,19.06 11.72,20.09 11.18,21L11.58,21.4C11.95,21.78 12.47,22 13,22C13.53,22 14.04,21.79 14.41,21.41L21.41,14.41C21.79,14.04 22,13.53 22,13C22,12.47 21.79,11.96 21.41,11.58M5.5,7A1.5,1.5 0 0,1 4,5.5A1.5,1.5 0 0,1 5.5,4A1.5,1.5 0 0,1 7,5.5A1.5,1.5 0 0,1 5.5,7M10,19H7V22H5V19H2V17H5V14H7V17H10V19Z" />
            </svg>

            <span class="e-title e-hide-in-small">
                {{resource.header_right.offer.title}}
            </span>

        </a>
        <a class="e-list-item e-wish-count e-sm-none flex content-center items-center" :href="resource.header_right.wishCount.url">
            <svg viewBox="0 0 24 24" class="e-icon">
                <path fill="currentColor" d="M13.5,20C6.9,13.9 3.5,10.8 3.5,7.1C3.5,4 5.9,1.6 9,1.6C10.7,1.6 12.4,2.4 13.5,3.7C14.6,2.4 16.3,1.6 18,1.6C21.1,1.6 23.5,4 23.5,7.1C23.5,10.9 20.1,14 13.5,20M12,21.1C5.4,15.2 1.5,11.7 1.5,7C1.5,6.8 1.5,6.6 1.5,6.4C0.9,7.3 0.5,8.4 0.5,9.6C0.5,13.4 3.9,16.5 10.5,22.4L12,21.1Z" />
            </svg>
            <span class="e-count">
                {{resource.header_right.wishCount.count}}
            </span>

        </a>
        <button class="e-btn e-list-item e-user-menus e-sm-none items-center" 
        @click="isUserMenus=!isUserMenus"
        v-if="isLogged()" style="display:flex">
            <img v-if="resource.header_right.user_menus.src" class="e-thumb" :src="resource.header_right.user_menus.src">
            <svg v-else viewBox="0 0 24 24" class="e-icon">
    <path fill="currentColor" d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M7.07,18.28C7.5,17.38 10.12,16.5 12,16.5C13.88,16.5 16.5,17.38 16.93,18.28C15.57,19.36 13.86,20 12,20C10.14,20 8.43,19.36 7.07,18.28M18.36,16.83C16.93,15.09 13.46,14.5 12,14.5C10.54,14.5 7.07,15.09 5.64,16.83C4.62,15.5 4,13.82 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,13.82 19.38,15.5 18.36,16.83M12,6C10.06,6 8.5,7.56 8.5,9.5C8.5,11.44 10.06,13 12,13C13.94,13 15.5,11.44 15.5,9.5C15.5,7.56 13.94,6 12,6M12,11A1.5,1.5 0 0,1 10.5,9.5A1.5,1.5 0 0,1 12,8A1.5,1.5 0 0,1 13.5,9.5A1.5,1.5 0 0,1 12,11Z" />
</svg>

            <span class="e-title e-hide-in-small">
                {{resource.header_right.user_menus.title}}
            </span>
            <svg class="e-arrow-toggle e-hide-in-small" viewBox="0 0 24 24" >
                <path fill="currentColor" d="M11,4H13V16L18.5,10.5L19.92,11.92L12,19.84L4.08,11.92L5.5,10.5L11,16V4Z" />
            </svg>
            <div class="e-right-dropdown" v-show="isUserMenus">
                <ul>
                    <li v-for="(d,key) in resource.header_right.user_menus.dropdown" :key="key">


                        <a :href="d.url">{{d.title}}</a>
                    </li>

                </ul>

            </div>

        </button>
        <button class="e-btn e-list-item e-sm-none items-center" 
        @click="isShowLoginRegister=!isShowLoginRegister" v-else  style="display:flex">


            <svg viewBox="0 0 24 24" class="e-icon">
                <path fill="currentColor" d="M22 17V16.5C22 15.12 20.88 14 19.5 14S17 15.12 17 16.5V17C16.45 17 16 17.45 16 18V22C16 22.55 16.45 23 17 23H22C22.55 23 23 22.55 23 22V18C23 17.45 22.55 17 22 17M21 17H18V16.5C18 15.67 18.67 15 19.5 15S21 15.67 21 16.5V17M8 8C8 5.79 9.79 4 12 4S16 5.79 16 8 14.21 12 12 12 8 10.21 8 8M14 20H4V18C4 15.79 7.58 14 12 14C13.27 14 14.46 14.15 15.53 14.41C15.32 14.82 15.15 15.25 15.07 15.71C14.42 16.26 14 17.08 14 18V20Z" />
            </svg>

            <span class="e-title e-hide-in-small">
                {{resource.header_right.login_register.title}}
            </span>
            <svg class="e-arrow-toggle e-hide-in-small" viewBox="0 0 24 24">
                <path fill="currentColor" d="M11,4H13V16L18.5,10.5L19.92,11.92L12,19.84L4.08,11.92L5.5,10.5L11,16V4Z" />
            </svg>
            <div class="e-right-dropdown" v-show="isShowLoginRegister">
                <ul>
                    <li v-for="(d,key) in resource.header_right.login_register.dropdown" :key="key">
                        <p>{{d.h}}</p>

                        <a :href="d.url">{{d.title}}</a>
                    </li>

                </ul>

            </div>
        </button>

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
            isShowLoginRegister: false,
            isUserMenus:false,
        }
    },
    methods: {
        isLogged() {
            return window.hasUserId;
        },

    },
    mounted() {}

}
</script>

<style>

</style>
