<template>
<vo
    ref="variantOptionsAtt"
    v-slot="{ handleSubmit }">

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
    <v-row
        tag='form'
        @submit.prevent="handleSubmit(complete)">

        <v-col cols="12">
            <v-row>

            </v-row>
            <v-simple-table class="variants-table">
                <template v-slot:default>
                    <thead>
                        <tr>
                            <th class="text-left">
                                slug
                            </th>
                            <th class="text-left">
                                Variant
                            </th>
                            <th class="text-left">
                                option
                            </th>
                            <th class="text-left">
                                price
                            </th>
                            <th class="text-left">
                                compare Price
                            </th>
                            <th class="text-left">
                                inventory_quantity
                            </th>
                            <th class="text-left">
                                inventory_store
                            </th>
                            <th class="text-left">
                                sku
                            </th>
                            <th class="text-left">
                                images
                            </th>
                            <th class="text-left">
                                default
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(item,i) in  collection.variants"
                            :key="i">
                            <td>
                                {{i}}
                                <!-- {{item.slug}} -->
                            </td>
                            <td>{{item.variantTitle}}</td>
                            <td>{{item.optionTitle}}</td>

                            <vp
                                tag="td"
                                v-slot="{ errors }"
                                :vid="`price${i}`"
                                name="price"
                                rules="required">
                                <v-text-field
                                    class="variant-input"
                                    outlined
                                    type='number'
                                    v-model="item.price"
                                    :error-messages="errors"></v-text-field>
                            </vp>
                            <vp
                                tag="td"
                                v-slot="{ errors }"
                                :vid="`comparePrice${i}`"
                                name="comparePrice"
                                rules="required">
                                <v-text-field
                                    class="variant-input"
                                    outlined
                                    type='number'
                                    v-model="item.comparePrice"
                                    :error-messages="errors"
                                    dense></v-text-field>
                            </vp>

                            <td>
                                <v-btn
                                    x-small
                                    block
                                    color="black"
                                    dark
                                    v-if="item.isUnlimited">
                                    unlimited storage
                                </v-btn>
                                <vp
                                    v-else
                                    v-slot="{ errors }"
                                    :vid="`inventory_quantity${i}`"
                                    name="inventory_quantity"
                                    rules="required">
                                    <v-text-field
                                        outlined
                                        class="variant-input"
                                        type='number'
                                        v-model="item.inventory_quantity"
                                        :error-messages="errors"
                                        dense></v-text-field>

                                </vp>
                            </td>

                            <vp
                                tag="td"
                                v-slot="{ errors }"
                                :vid="`inventory_store${i}`"
                                name="inventory_store"
                                rules="required">
                                <v-select
                                    outlined
                                    class="variant-input"
                                    :items="storageDropdowns"
                                    v-model="item.inventory_store"
                                    item-text="title"
                                    item-value="id"
                                    :error-messages="errors"
                                    dense></v-select>
                            </vp>

                            <td>
                                {{item.sku}}
                            </td>
                            <td class="pointer">
                          
                                   
                                        <v-badge
                                       
                                            bordered
                                            overlap
                                            color="deep-purple accent-4 "
                                            :content="item.images.length?item.images.length:collection.product.images.length">
                                            <imagesDialog @images="item.images = $event">
                                                <template v-slot:activator="{ on}">
                                            <v-avatar size="36"  v-on="on"> 
                                                <v-img :src="item.images.length?item.images[0].dataUrl:collection.product.images[0].dataUrl"></v-img>
                                            </v-avatar>
                                                </template>
                                            </imagesDialog>
                                        </v-badge>
                                  
                                
                            </td>
                            <td class="pointer">
                                <v-checkbox
                                    v-model="item.isDefault"
                                    :true-value="true"
                                    :false-value="false"
                                    @click="isdefault(i)"></v-checkbox>
                            </td>

                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-col>

        <v-col cols="12">
            <v-btn
                color="primary"
                type="submit">
                Continue
            </v-btn>

            <v-btn
                text
                @click="back">
                Back
            </v-btn>
        </v-col>
    </v-row>
          
</vo>
</template>

<script>
var cloneDeep = require('lodash.clonedeep');
import {
    properties
} from './js/dataCollector'
import {
    addItemsCollection
} from './js/formDataCanerete'
import imagesDialog from '@/components/imagesCreateDialog.vue'
export default {
    name: 'variantOptionsAttr',
    components: {
        imagesDialog
    },
    props: {
        storageDropdowns: {
            type: Array,
            required: true,
        },
        items: {
            type: Object,
            required: true,
        },

    },
    data() {
        return {
            collection: {},
            overlay: false,
         

        }
    },

    computed: {

    },
    methods: {

        async complete() {
            //this.overlay = true;
            await addItemsCollection(this.collection);
           // this.overlay = false;

            // this.$emit('input', this.variants);
            // this.$emit('complete', 6);

        },
        back() {
            this.$emit('back', 4);
        },

        isdefault(index) {

            this.collection.variants = this.collection.variants.map((item, key) => {
                if (key == index) {
                    item.isDefault = true;

                } else {
                    item.isDefault = false
                }
                return item;
            })
        },
        cloneVariants(arr) {

        },
        getFields() {

        },
        setFields() {

        },
        
      

    },
    watch: {
        items: {
            deep: true,
            handler(obj) {
                this.collection = cloneDeep(properties(obj));
            }

        }
    },
    updated() {
        // this.variants = [...properties(this.value)];
    },
    created() {
        this.collection = cloneDeep(properties(this.items));

    }

}
</script>

<style lang="scss" scoped>
.variants-table {
    th {
        padding: 0 3px;
    }

    td {
        padding: 0 3px;

    }

    .variant-input {
        min-width: 100px;
    }
}
</style>
