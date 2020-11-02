<template>
<v-row justify="center">
    <v-dialog
        v-model="dialog"
        persistent
        max-width="300px">
        <template v-slot:activator="{ on }">
            <slot
                name="activator"
                v-bind:on="on"></slot>

        </template>
        <vo v-slot="{ handleSubmit }">
            <v-card
                tag="form"
                ref="addPriceform"
                @submit.prevent="handleSubmit(onSubmit)">
                <!-- start overly -->
                <v-overlay
                    :absolute="true"
                    :value="overlay">
                    <v-progress-circular
                        indeterminate
                        size="100"
                        color="primary"></v-progress-circular>
                </v-overlay>
                <!-- end overly -->
                <v-card-title>
                    <span class="headline">Edit Price</span>
                </v-card-title>
                <v-card-text>

                    <v-container>
                        <vp
                            v-slot="{ errors }"
                            vid="price"
                            name="price"
                            rules="required|max:10">
                            <v-text-field
                                type="number"
                                v-model="price"
                                :counter="10"
                                :error-messages="errors"
                                label="Price"
                                outlined
                                placeholder="product price hear"
                                :dense="dense"
                                required></v-text-field>
                        </vp>
                        <vp
                            v-slot="{ errors }"
                            vid="special_price"
                            name="special price"
                            rules="required|max:10">
                            <v-text-field
                                type="number"
                                v-model="special_price"
                                :counter="10"
                                :error-messages="errors"
                                label="Special Price"
                                outlined
                                placeholder="product Special Price hear"
                                :dense="dense"
                                required></v-text-field>
                        </vp>
                        <vp
                            v-slot="{ errors }"
                            vid="sku"
                            name="sku"
                            rules="required|max:10">
                            <v-text-field
                                v-model="sku"
                                type="number"
                                :counter="10"
                                :error-messages="errors"
                                label="SKU Number"
                                outlined
                                placeholder="SKU Number hear Optional"
                                :dense="dense"
                                required></v-text-field>
                        </vp>

                    </v-container>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="dialog = false">
                        Close
                    </v-btn>
                    <v-btn
                        type="submit"
                        dark
                        color="indigo"
                        small>
                        edit
                    </v-btn>
                </v-card-actions>
            </v-card>
        </vo>
    </v-dialog>
</v-row>
</template>

<script>
import {
    axios
} from '@/plugins/axios';
import validationErrors from '@/plugins/validationErrors.js';
import {
    Price
} from '@/models/index.js';
export default {
    props: {
        item: {
            type: Object,
            required: true
        }
    },
    data: () => ({
        dialog: false,
        price: 0,
        special_price: null,
        sku: null,
        dense: true,
        overlay: false
    }),
    methods: {
        async onSubmit() {
            const formdata = {};

            formdata.price = this.price;
            formdata.special_price = this.special_price;
            formdata.sku = this.sku;
            this.overlay = true
            try {
                const {
                    data
                } = await axios.put(`/prices/${this.item.id}`, formdata);
                Price.update({
                    where: this.item.id,
                    data
                })
                this.dialog = false
            } catch (e) {

                if (e.response.status == 422) {
                    validationErrors.apply(this, [e.response.data]);
                }
            }
            this.overlay = false

        }
    },
    created() {
        this.price = this.item.price;
        this.special_price = this.item.special_price;
        this.sku = this.item.sku;
    }
}
</script>
