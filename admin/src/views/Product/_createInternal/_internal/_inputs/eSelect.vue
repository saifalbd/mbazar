<template>
<div>
    <v-select
        outlined
        :items="items.map(i=>i.title)"
        v-model="val"
        hide-details
        dense></v-select>
</div>
</template>

<script>
export default {
    name: 'eSelect',
    props: {
        value: {},
        items: {
            type: Array,

        },

    },
    computed: {
        val: {
            get() {
                return this.value;
            },
            set(val) {
                this.$emit('input', val)
            }
        }
    }

}
</script>

<style lang="scss" scoped>

</style>
