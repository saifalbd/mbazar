<template>
<v-navigation-drawer v-model="primaryDrawer.model" :permanent="primaryDrawer.type === 'permanent'" :temporary="primaryDrawer.type === 'temporary'" :clipped="false" :floating="primaryDrawer.floating" :mini-variant.sync="primaryDrawer.mini" absolute overflow app>
    <v-list-item class="px-2">
        <v-list-item-avatar>

            <v-img v-if="$store.state.user.img" :src="$store.state.user.img"></v-img>
            <v-icon color="green darken-2" v-else>
                mdi-image
            </v-icon>
        </v-list-item-avatar>

        <v-list-item-title>{{$store.state.user.fullName}}</v-list-item-title>

        <v-btn icon @click.stop="primaryDrawer.mini  = !primaryDrawer.mini">
            <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
    </v-list-item>

    <v-divider></v-divider>

    <v-list dense>

        <v-list-item link v-for="item in items" :key="item.title" :href="item.href">

            <v-list-item-icon>
                <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
                <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
            <!-- <v-list-item-icon>
                <toggleArrow></toggleArrow>
            </v-list-item-icon> -->

        </v-list-item>

        <!-- <subMenus  v-for="item in items"  :key="item.title">
            <template v-slot:activator="{ on }">
         </template>
          </subMenus> -->
    </v-list>

</v-navigation-drawer>
</template>

<script>
import subMenus from './subMenus.vue';
import menus from '../plugins/menus'
import toggleArrow from './toggleArrow.vue';
export default {
    props: ['value'],
    components: {
        subMenus,
        toggleArrow
    },
    data() {
        return {
            primaryDrawer: {
                model: null,
                type: '',
                clipped: false,
                floating: false,
                mini: false,

            },
            items: [],
        }
    },
    methods: {
        menuOpen() {
            if (this.$root.isMobile) {

                this.primaryDrawer.mini = false;
                this.primaryDrawer.model = !this.primaryDrawer.model;
                this.primaryDrawer.type = 'temporary';
            } else {
                this.primaryDrawer.model = true
                this.primaryDrawer.mini = !this.primaryDrawer.mini;
                this.primaryDrawer.type = '';
            }

        },
    },
    watch: {
        value() {
            this.menuOpen()
        }
    },
    created() {
        this.items = menus;
    }
}
</script>
