<template>
<vo
    ref="productAddInfo"
    v-slot="{ handleSubmit }">

    <v-row>

        <vp
            class="col-12 col-sm-6"
            v-slot="{ errors }"
            name="inventory_is_unlimited"
            rules="required">
            <v-select
                v-model="isUnlimited"
                :items="[{t:'Unlimited',v:true},{t:'Set Manual',v:false}]"
                :counter="100"
                :error-messages="errors"
                label="Inventory Quantites Type*"
                outlined
                :dense="true"
                item-text="t"
                item-value="v"
                required></v-select>
        </vp>

        <vp
            v-if="!isUnlimited"
            class="col-12 col-sm-6"
            v-slot="{ errors }"
            vid="inventory_quantity"
            name="inventory_quantity"
            rules="required|max:150">
            <v-text-field
                v-model="inventory_quantity"
                :counter="100"
                :error-messages="errors"
                label="inventory quantity*"
                outlined
                placeholder="Product stock quanties"
                :dense="true"
                required></v-text-field>
        </vp>

        <vp
            class="col-12 col-sm-6"
            v-slot="{ errors }"
            vid="inventory_store"
            name="inventory_store"
            rules="required|max:150">
            <v-select
                v-model="inventory_store"
                :items="storageCollection"
                :label="`inventory_store`"
                outlined
                small-chips
                item-text="title"
                                    item-value="id"
                :error-messages="errors"
                dense></v-select>
        </vp>

        <v-col cols="12">
            <v-btn
                color="primary"
                @click="complete">
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
import {
    apiProduct,
    apiCategory,
    apiBrand
} from '@/api';
import {
    Category,
    Brand
} from '@/models';
export default {
    name: 'productStock',
    props: {
        value: {
            type: Object,
            required: true,
        },
        storageCollection:{
            type:Array,
            default(){
                return []
            }
        }
    },
    data() {
        return {

            inventory_quantity: 1000,
            inventory_store: 1,
            isUnlimited: false,
        }
    },
    computed: {
      

    },
    methods: {
        complete() {
            this.$refs.productAddInfo.validate().then(success => {
                if (!success) {
                    return;
                }

                this.$emit('input', this.getFields());
                this.$emit('complete', 3);

            });

        },
        back() {
            this.$emit('back', 1);
        },

        async fetheDropdowns() {
            // const categories = apiCategory.index();
            // const brands = apiBrand.index();

            // let categoryCollection = await categories;
            // let brandCollection = await brands;

        },
        getFields() {
            const {
                inventory_quantity,
                inventory_store,
                isUnlimited

            } = this;
            return {
                inventory_quantity,
                inventory_store,
                isUnlimited
            };
        },
        setFields() {
            const {
                inventory_quantity,
                inventory_store,
                isUnlimited
            } = this.value;
            this.inventory_quantity = inventory_quantity;
            this.inventory_store = inventory_store;
            this.isUnlimited = isUnlimited;

        }
    },
    created() {
        this.setFields();

    }

}
</script>

<style lang="scss" scoped>

</style>
