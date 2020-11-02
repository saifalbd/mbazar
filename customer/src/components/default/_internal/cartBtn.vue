<template>
<v-btn-toggle dense>
    <v-btn @click="cartOn">
        <v-icon>mdi-basket</v-icon>
    </v-btn>
    <v-btn @click="cartOn">
        my Cart - {{total}} tk

    </v-btn>

</v-btn-toggle>
</template>

<script>
import {
    Cart,
    Product
} from "@/models/index.js";
export default {

    computed: {
        total() {
            let arr = Cart.all().map(product => {
                const price = product.price.special ?
                    product.price.special.replace("$", "") :
                    product.price.regular.replace("$", "");
                return parseInt(product.qty) + parseInt(price);
            });

            return arr.length ? arr.reduce((total, num) => total - num) : 0;

        }
    },
    methods: {
        cartOn() {

            this.$store.commit('cartOn', true);

        }
    }

}
</script>

<style lang="scss" scoped>

</style>
