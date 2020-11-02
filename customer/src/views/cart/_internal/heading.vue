<template>
<div class="sf-heading">
    <!--@slot Heading title. Slot content will replace default <h> tag-->
    <slot
        name="title"
        v-bind="{ title }">
        <component :is="`h${level}`">
            {{ title }}
        </component>
    </slot>
    <!--@slot Heading description. Slot content will replace default <div> tag-->
    <slot
        name="description"
        v-bind="{ description }">
        <div
            v-if="hasDescription"
            class="h2">
            {{ description }}
        </div>
    </slot>
</div>
</template>

<script>
export default {
    name: "SfHeading",
    props: {
        /**
         * Heading level
         */
        level: {
            type: Number,
            default: 1,
        },
        /**
         * Heading title
         */
        title: {
            type: String,
            default: "",
        },
        /**
         * Heading description
         */
        description: {
            type: String,
            default: "",
        },
    },
    computed: {
        hasDescription() {
            return !!this.description || this.$slots.hasOwnProperty("description");
        },
    },
};
</script>

<style lang="scss">

</style>
