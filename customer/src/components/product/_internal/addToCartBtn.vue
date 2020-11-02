<template>
<v-btn
    small
    rounded
    outlined
    @click="addOn"
    :loading="loading"
    class="mx-auto">
    {{isAddedOnCart?'ADDED ON CART':'ADD ON CART'}}

    <v-icon right>
        {{isAddedOnCart?'mdi-cart-arrow-down':'mdi-cart-plus'}}

    </v-icon>
</v-btn>
</template>

<script>
export default {

    props: {
        isAddedOnCart: {
            type: Boolean,
            default: false
        },
        loading: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        addOn() {
            this.$emit('click', 1)
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
