<template>
<v-row no-gutters class="d-flex justify-between" id="menuTab">
    <v-col>
        <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn text :height="height" v-bind="attrs" v-on="on">
                    <v-icon left>mdi-menu</v-icon>
                    <span>
                        All Categories
                    </span>
                    <v-icon right>mdi-menu-down</v-icon>
                </v-btn>
            </template>
            <!-- <v-list>
                <v-list-item v-for="(item, index) in categories" :key="index">
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item>
            </v-list> -->
            <v-card class="mx-auto" max-width="300" tile>
                <v-list dense>
                    <v-subheader>CATEGORIES</v-subheader>
                    <v-list-item-group v-model="item" color="primary">
                        <v-list-item v-for="(item, i) in categories" :key="i" :to="{ name: 'Category', 
                                        params: { slug: item.slug }}">

                            <v-list-item-avatar>
                                <v-img :src="item.img"></v-img>
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-title v-text="item.title"></v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-item-group>
                </v-list>
            </v-card>
        </v-menu>
    </v-col>

    <v-col class="d-none d-sm-flex" cols="auto">
        <v-tabs>
            <v-tab>Item One</v-tab>
            <v-tab>Item Two</v-tab>
            <v-tab>Item Three</v-tab>
            <v-tab>Item Three</v-tab>
            <v-tab>Item Three</v-tab>
            <v-tab>Item Three</v-tab>
        </v-tabs>
    </v-col>

    <v-col class="d-flex justify-end">
        <cartBtn></cartBtn>
    </v-col>
</v-row>
</template>

<script>
import cartBtn from './cartBtn.vue';
export default {
    props: {
        categories: {
            type: Array,
            default: []
        }
    },
    components: {

        cartBtn,

    },
    data() {
        return {
            height: '40px',
            item:'',
            items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
        }
    }
}
</script>

<style lang="scss" scoped>
.t {
    background-color: royalblue;

}
</style>
