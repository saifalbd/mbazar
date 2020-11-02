<template>
<v-row>
    <v-slide-group
        class="pt-3 pb-3"
        active-class="success"
        show-arrows>

        <v-slide-item
            v-for="(p,i) in collection"
            :key="i"
            v-slot:default="{ active, toggle }">

            <productItem
                :item="p"
                :regular-price="p.price.regular"
                :special-price="p.price.special"
                :image="p.img"
                :title="p.title"
                :badge-label="p.badgeLabel"
                :is-added-to-cart="p.cart?true:false"
                @click:add-to-cart="addToCart(p)"></productItem>

        </v-slide-item>
    </v-slide-group>

</v-row>
</template>

<script>
import productItem from '@/components/product/cart.vue'
import {
    axios,
    axiosWithoutToken
} from '../../../plugins/axios'
import {
    Cart,
    Product
} from '../../../models'
export default {
    
    components: {
        productItem,

    },
    data() {
        return {
            badgeLabel: 'off',
            badgeColor: 'red',

            name: "Black Shoes for Men",
            rating: 3,
            price: 57.00,
            reduc: 0.5,

        }
    },
    computed: {
        collection() {
            return Product.query().withAll().get()
        }
    },
    methods: {
        async addToCart(i) {

            let d = {
                product_id: i.id,
                qty: 1,
            }
            let {
                data
            } = await axios.post('./carts', d)

            Cart.insert({
                data
            })

        },
    },

    async created() {
        if (!Product.query().count()) {
            const {
                data
            } = await axiosWithoutToken.get('/products')
            Product.insert({
                data: data.data
            });
        }

    }
}
</script>

<style lang="scss" scoped>
.test {
    background-color: red;
}
</style>
