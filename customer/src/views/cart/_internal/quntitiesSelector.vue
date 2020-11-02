<template>
<v-text-field
    class="quantitySelector"
    dense
    outlined
    hide-details
    @input="$emit('input', parseInt($event, 10))"
    :value="qty">

    <template #append>
        <v-btn
            icon
            small
            @click="$emit('input', parseInt(qty, 10) - 1)"
            color="black">
            <v-icon>mdi-minus-box</v-icon>
        </v-btn>
    </template>
    <template #prepend-inner>
        <v-btn
            @click="$emit('input', parseInt(qty, 10) + 1)"
            icon
            small
            color="black">
            <v-icon>mdi-plus-box</v-icon>
        </v-btn>
    </template>

</v-text-field>
</template>

<script>
import SfInput from "@/components/atoms/SfInput/SfInput.vue";
import SfButton from "@/components/atoms/SfButton/SfButton.vue";
export default {
    name: "SfQuantitySelector",
    components: {
        SfInput,
        SfButton,
    },
    inheritAttrs: false,
    model: {
        prop: "qty",
    },
    props: {
        /** Quantity */
        qty: {
            type: [Number, String],
            default: 1,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
    },
    watch: {
        qty(val) {
            if (val < 1 || isNaN(val)) {
                this.$emit("input", 1);
            }
        },
    },
};
</script>
