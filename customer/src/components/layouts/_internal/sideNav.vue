<template>
<div class="e-aside-inner e-side-nav e-pt-20">

    <!-- start frofile card -->
    <div class="e-profile-card e-hide-in-lg">
        <img :src="light_logo.src" alt="John" style="width:70%">
        <p class="e-profile-title">{{site_name}}</p>

    </div>
    <!-- end profile card -->

    <p class="e-group-title e-pl-3">categories</p>
    <ul class="e-pl-3">
        <li class="e-list-item" v-for="(category ,key) in categories" 
        :key="key" :class="category.showChildren?'show-childrens':false">
            <a class="flex"
            :href="hasChildren(category)?false:category.url" @click="showChildren(key)">
                <span class="img-icon">
                    <img :src="category.thumb" alt="" srcset="">
                </span>
                <span v-text="category.title"></span>
                <span class="dropdown-icon" v-show="hasChildren(category)">
                    <toggleIcon :toggle="category.showChildren" />
                </span>
            </a>
            <template v-if="hasChildren(category)">
                <ul class="e-childrens e-ml-20">
                    <template v-for="(child,index) in category.children"  >
                        <li :key="index">
                            <a :href="child.url" v-text="child.title"></a>
                        </li>
                    </template>
                </ul>
            </template>
        </li>
        <!-- <li class="e-list-item">fdfdd</li>
        <li class="e-list-item">fdfdd</li> -->
    </ul>
    <p class="e-group-title e-hide-in-lg e-pl-3">admin</p>
    <ul class="e-pl-3 e-hide-in-lg">
        <template v-for="(menu , i) in client_sub_menus"  >
            <li class="e-list-item" :key="i">
                <a :href="menu.url">
                    <span>
                        <svg viewBox="0 0 24 24" style="width: 24px; height: 24px;">
                            <path fill="currentColor" d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z"></path>
                        </svg>
                    </span>
                    <span v-text="menu.title"></span>

                </a>
            </li>
        </template>

    </ul>
    <template  v-if="hasUserId">
    <p class="e-group-title e-hide-in-lg e-pl-3">Login or Register</p>
    <ul class="e-pl-3 e-hide-in-lg">
        <li v-for="(item,index) in login_register" :key="index" class="e-list-item">
            <button class="e-profile-button e-mt-5">
                <a :href="item.url"> {{item.title}}</a>
            </button>
        </li>
    </ul>
    </template>
    <template  v-else>
       <p class="e-group-title e-hide-in-lg e-pl-3">Logout</p>
    <ul class="e-pl-3 e-hide-in-lg">
        <li  class="e-list-item">
            <button class="e-profile-button e-mt-5">
               logout
            </button>
        </li>
    </ul>
    </template>



</div>
</template>

<script>
import toggleIcon from './toggleIcon.vue'
export default {
    components: {
        toggleIcon
    },
    data() {
        return {
            categories: [],
            client_sub_menus: [],
            login_register: [],
            light_logo: {},
            site_name: '',
            hasUserId:null

        }
    },
    methods: {
        hasChildren(category) {
            return category.children && category.children.length ? true : false;
        },
        showChildren(key) {

            this.categories = this.categories.map((item, index) => {
                if (index === key) {
                    item.showChildren = !item.showChildren;
                } else {
                    item.showChildren = false;
                }
                return item;

            })

        }

    },
    created() {
        const {
            categories,
            client_sub_menus
        } = this.$root.res.header;
        this.categories = categories;
        this.client_sub_menus = client_sub_menus;

        this.login_register = this.$root.res.header.header_right.login_register.dropdown;
        this.light_logo =this.$root.res.header.light_logo;
        this.site_name =this.$root.res.header.site_name;
        this.hasUserId =this.$root.res.header.hasUserId;

        console.log(window.location.href);
    }
}
</script>

<style>

</style>
