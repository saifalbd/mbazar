<template>
<div>
    <v-text-field
        :placeholder="placeholder"
        outlined
        :type='type'
        v-model="val"
        hide-details
        :errors="errors"
        dense></v-text-field>
</div>
</template>

<script>
export default {
    name: 'eInput',
    props: {
        value: {},
        errors: {
            type: Array,
            default () {
                return []
            }
        },
        placeholder: {
            type: String,
            default: ''
        },
        type: {
            type: String,
            default: 'text'
        }
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
