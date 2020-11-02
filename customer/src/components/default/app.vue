<template>
<v-app id="inspire">
    <v-card
        id="addSticky"
        :class="sticky?'sticky':''">
        <!-- <v-system-bar height="30" ></v-system-bar> -->

        <v-toolbar
            flat
            height="auto">

            <v-container class="hide-on-sticky">
                <v-row>

                    <v-col cols="12">

                        <v-row class="d-flex justify-between align-center">
                            <v-col
                                class="d-flex justify-between align-center"
                                cols="12"
                                lg="4">
                                <logo></logo>
                            </v-col>
                            <v-col
                                cols="12"
                                lg="6">
                                <searchBar :categories="categories"></searchBar>
                            </v-col>
                            <v-col
                                cols="12"
                                lg="2"
                                class="d-flex justify-end align-center">
                                <v-menu
                                    v-if="$store.getters.isLogged"
                                    open-on-hover
                                    top
                                    offset-y>
                                    <template v-slot:activator="{ on, attrs }">

                                        <v-chip class="ma-2">

                                            <v-avatar
                                                v-bind="attrs"
                                                v-on="on"
                                                left
                                                size="36">
                                                <template v-if="user.img">
                                                    <img :src="user.img" :alt="user.fullName">
                                                </template>
                                                <template v-else>
                                                    <v-icon>mdi-account</v-icon>
                                                </template>

                                            </v-avatar>
                                            {{user.fullName}}
                                        </v-chip>

                                    </template>

                                    <v-card
                                        class="mx-auto"
                                        max-width="300"
                                        tile>

                                        <v-subheader>
                                            {{user.fullName}}
                                        </v-subheader>
                                        <v-list-item-group color="#ffff">
                                            <v-list dense>
                                                <v-list-item
                                                    v-for="(item, index) in loginInfos"
                                                    :key="index"
                                                    :to="item.to">
                                                    <v-list-item-icon>
                                                        <v-icon v-text="item.icon"></v-icon>
                                                    </v-list-item-icon>
                                                    <v-list-item-content>
                                                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                                                    </v-list-item-content>

                                                </v-list-item>
                                            </v-list>
                                        </v-list-item-group>
                                    </v-card>
                                </v-menu>

                                <v-btn
                                    v-else
                                    link
                                    icon
                                    @click="lock">
                                    <v-icon>mdi-lock</v-icon>
                                </v-btn>

                            </v-col>

                        </v-row>

                    </v-col>
                </v-row>

            </v-container>

            <template v-slot:extension>

                <menu-tab :categories="categories"></menu-tab>

            </template>
        </v-toolbar>
        <v-card>
            <cart></cart>
            <slot></slot>
            <!-- <footerCom></footerCom> -->
        </v-card>

    </v-card>
    <v-card flat>
        <FooterV></FooterV>
    </v-card>

</v-app>
</template>

<script>
import searchBar from './_internal/searchBar.vue';
import cartBtn from './_internal/cartBtn.vue';
import logo from './_internal/logo.vue';
import menuTab from "./_internal/menuTab.vue";
// import FooterCom from './_internal/Footer.vue'
import FooterV from './_internal/FooterV.vue'
import {
    axios

} from '@/plugins/axios';
import {
    stickyNav
} from '../../plugins/appScroll.js'
import {
    Category
} from '@/models/index.js';
import cart from '../../views/cart/Cart.vue';

export default {
    components: {
        FooterV,
        searchBar,
        cartBtn,
        logo,
        menuTab,
        cart
    },
    data() {
        return {

            sticky: false,

        }
    },
    computed: {

        categories() {
            return Category.all()
        },
        user() {
            return this.$store.state.user ? this.$store.state.user : {};
        },
        loginInfos() {

            return [{
                    title: 'Your Profile',
                    icon: 'mdi-face-profile',
                    to: {
                        name: 'Home'
                    }
                },
                {
                    title: 'Your Orders',
                    icon: 'mdi-basket',
                    to: {
                        name: 'Home'
                    }
                },
                {
                    title: 'Payment History',
                    icon: 'mdi-history',
                    to: {
                        name: 'Home'
                    }
                },
                {
                    title: 'Change Password',
                    icon: 'mdi-lock-reset',
                    to: {
                        name: 'Home'
                    }
                },
                {
                    title: 'Log out',
                    icon: 'mdi-logout',
                    to: {
                        name: 'Home'
                    }
                },

            ]
        }
    },
    methods: {
        lock() {
            this.$store.dispatch('logout');
            this.$router.push({
                name: 'Login'
            })
        },
        toggleMarker() {
            this.marker = !this.marker
        },
        sendMessage() {
            this.resetIcon()
            this.clearMessage()
        },
        clearMessage() {
            this.message = ''
        },
        resetIcon() {
            this.iconIndex = 0
        },
        changeIcon() {
            this.iconIndex === this.icons.length - 1 ?
                this.iconIndex = 0 :
                this.iconIndex++
        },
        lock() {
            this.$router.push({
                name: 'Login'
            })
        }
    },
    created() {

        document.addEventListener("scroll", (e) => {
            let sticky = stickyNav.action(e);
            if (typeof sticky === "boolean") {

                if (sticky && !this.sticky) {

                    // this.sticky = true;

                } else if (!sticky && this.sticky) {

                    //  this.sticky = false;

                }
            }
        });

    }

}
</script>

<style lang="scss" scoped>
#inspire {}

.hide-on-sticky {
    transition: height 2s;
}

.sticky {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 100;

    .hide-on-sticky {
        transition: height 2s;
        height: 0px;
        overflow: hidden;
        padding: 0;
    }

}
</style>
