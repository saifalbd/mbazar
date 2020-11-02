<template>
<v-card class="d-flex">

    <!-- start card details -->
    <v-row class="pl-2">
        <v-col cols="12">

            <slot
                name="title"
                v-bind="{ title }">

                <a :href="link">
                    {{ title }}
                </a>
            </slot>
            <slot
                name="price"
                v-bind="{ specialPrice, regularPrice }">
                <v-btn-toggle
                    group
                    tile>
                    <v-btn
                        large
                        v-if="specialPrice">
                        <span class="text-decoration-line-through">{{specialPrice}}</span>
                    </v-btn>

                    <v-btn large>
                        {{regularPrice}}
                    </v-btn>

                </v-btn-toggle>

            </slot>
            <div class="sf-collected-product__configuration">
                <slot name="configuration"></slot>
            </div>

        </v-col>
        <v-col cols="12">

            <slot name="actions">

            </slot>

        </v-col>
    </v-row>
    <!-- end card details -->
    <div class="sf-collected-product__aside">
        <slot
            name="image"
            v-bind="{ image, title }">

            <v-img
                :src="image"
                :alt="title"
                :width="imageWidth"
                :height="imageHeight"></v-img>
        </slot>
        <slot name="input">
            <div class="sf-collected-product__quantity-wrapper">
                <quntitiesSelector :qty="qty"></quntitiesSelector>

            </div>
        </slot>
    </div>

</v-card>
</template>

<script>
import quntitiesSelector from './quntitiesSelector'
export default {
    name: "cartProduct",
    components: {

        quntitiesSelector
    },
    model: {
        prop: "qty",
    },
    props: {
        /**
         * Product image
         * It should be an url of the product
         */
        image: {
            type: [String, Object],
            default: "",
        },
        /**
         * Product image width, without unit
         */
        imageWidth: {
            type: [String, Number],
            default: 140,
        },
        /**
         * Product image height, without unit
         */
        imageHeight: {
            type: [String, Number],
            default: 200,
        },
        /**
         * Product title
         */
        title: {
            type: String,
            default: "",
        },
        /**
         * Product regular price
         */
        regularPrice: {
            type: [Number, String],
            default: null,
        },
        /**
         * Product special price
         */
        specialPrice: {
            type: [Number, String],
            default: null,
        },
        /**
         * Selected quantity
         */
        qty: {
            type: [Number, String],
            default: 1,
        },
        /**
         * Link to product
         */
        link: {
            type: [String, Object],
            default: "",
        },
    },
    methods: {
        removeHandler() {
            this.$emit("click:remove");
        },
    },
};
</script>

<style lang="scss">
.quantitySelector {

    background-color: antiquewhite;
    //  padding: 0!important;

    // .v-input__prepend-inner {
    //     padding-left:0 px !important;
    //    padding-right: 0px !important;
    // }
    // .v-input__append-inner{
    //    padding-left:0 px !important;
    //    padding-right: 0px !important;
    // }
    // .v-input__prepend-inner{
    //       padding-left:0 px !important;
    //    padding-right: 0px !important;
    // }

    .v-input__slot {
        padding: 0 4px !important;

    }

    .v-text-field__slot {
        // border: 1px dotted black;
    }

    input {
        text-align: center;
    }
}
</style>
