<template>
<div class="product">
    <app>

       
        <v-stepper v-model="tab">
            <v-stepper-header>
                <v-stepper-step
                    :complete="tab > 1"
                    step="1">
                    Product
                </v-stepper-step>
                <v-divider></v-divider>
                <v-stepper-step
                    :complete="tab > 2"
                    step="2">
                    Inventory
                </v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step
                    :complete="tab > 3"
                    step="3">
                    Images
                </v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step
                    :complete="tab > 4"
                    step="4">
                    Variant
                </v-stepper-step>

                <v-stepper-step
                    :complete="tab > 5"
                    step="5">
                    Variant Options Configure
                </v-stepper-step>

                <v-stepper-step
                    :complete="tab > 6"
                    step="6">
                    Success
                </v-stepper-step>

            </v-stepper-header>

            <v-stepper-items>
                <v-stepper-content step="1">
                    <product
                        v-model="collection.product"
                        @complete="tabUpper"
                        @back="tab=$event"></product>
                </v-stepper-content>

                <v-stepper-content step="2">
                    <productStock
                        :storage-collection="inventory_storages()"
                        v-model="collection.inventory"
                        @complete="tabUpper"
                        @back="tab=$event"></productStock>
                </v-stepper-content>

                <v-stepper-content step="3">
                    <imageCreate
                        @images="imagesAdd"
                        @complete="tabUpper"
                        @back="tab=$event"></imageCreate>
                </v-stepper-content>

                <v-stepper-content step="4">
                    <variant
                        v-model="collection.variants"
                        @complete="tabUpper"
                        @back="tab=$event"></variant>
                </v-stepper-content>

                <v-stepper-content step="5">
                    <variantOptionsAttr
                        :storage-dropdowns="inventory_storages()"
                        :items="collection"
                        @complete="submitData"
                        @back="tab=$event"></variantOptionsAttr>
                </v-stepper-content>

                <v-stepper-content step="6">
                    <submitResponse />
                </v-stepper-content>
            </v-stepper-items>
        </v-stepper>
        <!-- <vueCrop/> -->

    </app>
</div>
</template>

<script>
// @ is an alias to /src

import product from './_createInternal/product';
import variant from './_createInternal/variant';
import productStock from './_createInternal/productStock';
import variantOptionsAttr from './_createInternal/variantOptionsAttrRow';
import imageCreate from './_createInternal/imageCreate.vue';
import submitResponse from './_createInternal/submitResponse.vue'





//end for testing

import app from '@/components/app.vue';
import {
    mdiSitemap
} from '@mdi/js';
import {
 apiWarehouse
} from '@/api';
export default {
    name: 'ProductCreate',
    components: {
        app,
        product,
        variant,
        productStock,
        imageCreate,
        variantOptionsAttr,
        submitResponse

    },
    data() {
        return {
            tab: 3,
            forSubmitCollection: {},
            optionsVariants:[],
            collection: {
                product: {
                    title: 'amanr',
                    price: 50,
                    comparePrice: 50,
                    categories: [{"$id":"1","id":1,"image":"https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg","title":"men clothing","slug":"men-clothing","isActive":true,"createOn":"23 hours ago","updateOn":"23 hours ago","parent_id":null,"product":[],"description":"Your perfect pack for everyday use and walks in the forest. Stash your laptop (up to 15 inches) in the padded sleeve, your everyday"},{"$id":"2","id":2,"image":"https://fakestoreapi.com/img/71-3HjGNDUL._AC_SY879._SX._UX._SY._UY_.jpg","title":"men clothing","slug":"men-clothing","isActive":true,"createOn":"23 hours ago","updateOn":"23 hours ago","parent_id":null,"product":[],"description":"Slim-fitting style, contrast raglan long sleeve, three-button henley placket, light weight & soft fabric for breathable and comfortable wearing. And Solid stitched shirts with round neck made for durability and a great fit for casual fashion wear and diehard baseball fans. The Henley style round neckline includes a three-button placket."}],
                    brand_id: '',
                },
                images: [],
                inventory: {
                    inventory_quantity: 1000,
                    inventory_store: 1,
                    isUnlimited: false
                },
                variants: [],
            }
        }
    },
    computed:{
      
    },
    methods: {
        imagesAdd($event) {
            // console.log($event[0].dataUrl)
            this.collection.images = $event

        },
        inventory_storages() {
            return [{
                    title: 'store A',
                    id: 1
                },
                {
                    title: 'store B',
                    id: 2
                },
                {
                    title: 'store C',
                    id: 3
                },
            ]
        },
        tabUpper($event){
            this.tab = $event;
            this.forSubmitCollection = this.collection;

        },
        submitData() {
            
        }
    },
    created(){



        // console.log(formDataCanerete.getData())
    }
}
</script>
