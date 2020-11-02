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
                :ref="`addPriceform${item.id}`"
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
                    <span class="headline">Add Price</span>
                </v-card-title>
                <v-card-text>

                    <v-container>
                        <vp
                            v-slot="{ errors }"
                            vid="regular"
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
                            vid="special"
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
                        color="indigo">
                        save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </vo>
    </v-dialog>
</v-row>
</template>

<script>
import {
axios,vErrors
} from '@/plugins/axios';
import validationErrors from '@/plugins/validationErrors.js';
import {
    Price,
    Product
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
        price: 50,
        special_price: 40,
        sku: 5455522,
        dense: true,
        overlay: false
    }),
    methods: {
        async onSubmit() {
            const formdata = new FormData();
            formdata.append('product_id', this.item.id);
            formdata.append('regular', this.price);
            formdata.append('special', this.special_price);
            formdata.append('sku', this.sku);

            this.overlay = true

            try {
                const {
                    data
                } = await axios.post(`/prices`, formdata);
                Price.insert({
                    data
                });
                Product.update({
                    where: this.item.id,
                    data: {
                        hasPrice: true
                    }
                })
                this.dialog = false
            } catch (e) {
                if (e.response.status == 422) {
                    vErrors.apply(this, [e.response.data, `addPriceform${item.id}`]);
                }
            }
            this.overlay = false

        }
    }
}
</script>
