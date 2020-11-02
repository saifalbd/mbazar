<template>
<v-row class="d-flex justify-center">

    <cartIncreaseBtn
        v-if="hasOnCart"
        :item-id="itemId"
        :loading="loading"
        :value="model"
        @input="onAddToCart"
        ></cartIncreaseBtn>
    <addToCartBtn
        :loading="loading"
        @click="onAddToCart"
        v-else></addToCartBtn>

</v-row>
</template>

<script>
import cartIncreaseBtn from './cartIncreaseBtn'
import addToCartBtn from './addToCartBtn'

export default {
    components: {
        cartIncreaseBtn,
        addToCartBtn
    },
    props: {
        itemId: {
            type: Number,
            required: true,

        },
       cart: {
            type: [null,Object],
            required: true,
        }
    },
    data() {
        return {
            model: 0,
            loading: true,
        }
    },
    methods: {
        onAddToCart(val) {
            


        }
    }

}
</script>

<style lang="scss" scoped>

</style>
