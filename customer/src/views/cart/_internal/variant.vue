<template>
<v-row class="pl-3">
    <span> {{name}}:</span>
&nbsp;&nbsp;
    <span> {{value}}</span>
</v-row>
</template>

<script>
export default {
    props: {
        name: {
            type: String,
            required: true,
        },
        value: {
            type: String,
            required: true,
        },
    }
}
</script>

<style lang="scss" scoped>

</style>
