<template>
<vo
    ref="productAddInfo"
    v-slot="{ handleSubmit }">

    <v-row>
     
            <vp
             class="col-12"
                v-slot="{ errors }"
                vid="title"
                name="Title"
                rules="required|max:150">
                <v-text-field
                    v-model="title"
                    :counter="100"
                    :error-messages="errors"
                    label="Title*"
                    outlined
                    placeholder="product title hear"
                    :dense="true"
                    required></v-text-field>
            </vp>

              <vp
             class="col-12 col-sm-6"
                v-slot="{ errors }"
                vid="price"
                name="Price"
                rules="required|max:150">
                <v-text-field
                    v-model="price"
                    :counter="100"
                    :error-messages="errors"
                    label="Price*"
                    outlined
                    type="number"
                    placeholder="product price hear"
                    :dense="true"
                    required></v-text-field>
            </vp>
                 <vp
             class="col-12 col-sm-6"
                v-slot="{ errors }"
                vid="comparePrice"
                name="comparePrice"
                rules="required|max:150">
                <v-text-field
                    v-model="comparePrice"
                    :counter="100"
                    :error-messages="errors"
                    label="comparePrice*"
                    outlined
                    type="number"
                    placeholder="product comparePrice hear"
                    :dense="true"
                    required></v-text-field>
            </vp>
       

        <vp
            class="col-12 col-sm-6"
            v-slot="{ errors }"
            vid="categories"
            name="Categories"
            rules="required">
            <v-combobox
                v-model="categories"
                :items="categoriesCollection"
                label="Categories"
                multiple
                outlined
                small-chips
                item-text="title"
                item-value="id"
                :error-messages="errors"
                dense></v-combobox>
        </vp>
        <vp
            class="col-12 col-sm-6"
            
            v-slot="{ errors }"
            vid="brand_id"
            name="Brand"
            rules="">
            <v-combobox
                v-model="brand_id"
                :items="brands"
                label="Brand"
                outlined
                small-chips
                item-text="title"
                item-value="id"
                :error-messages="errors"
                dense></v-combobox>
        </vp>

        <v-col cols="12">
            <v-btn
                color="primary"
                @click="complete">
                Continue
            </v-btn>

            <!-- <v-btn
                text
                @click="back">
                Cancel
            </v-btn> -->
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
    name:'productDefaultCreate',
    props: {
        value: {
            type: Object,
            required: true,
        }
    },
    data() {
        return {
            title: '',
            categories: [],
            brand_id: '',
            price: 0,
            comparePrice: 0,

        }
    },
    computed: {
        categoriesCollection() {
            //.where('isActive', true)
            return Category.query().get();
        },
        brands() {
            //.where('isActive', true)
            return Brand.query().all();
        }

    },
    methods: {
        complete() {
            this.$refs.productAddInfo.validate().then(success => {
                if (!success) {
                    return;
                }

                this.$emit('input', this.getFields());
                this.$emit('complete', 2);

            });

        },
        back() {
            this.$emit('back', 1);
        },

        async fetheDropdowns() {
            const categories = apiCategory.index();
            const brands = apiBrand.index();

            let categoryCollection = await categories;
            let brandCollection = await brands;

        },
        getFields() {
            const {
                title,
                categories,
                brand_id,
                 price,
                comparePrice,
            } = this;
            return {
                title,
                categories,
                brand_id,
                 price,
                comparePrice
            };
        },
        setFields() {
            const {
                title,
                categories,
                brand_id,
                  price,
                comparePrice
            } = this.value;
            this.title = title;
            this.categories = categories;
            this.brand_id = brand_id;
            this.price = price;
            this.comparePrice = comparePrice;

        }
    },
    created() {
        this.setFields();
        this.fetheDropdowns()
    }

}
</script>

<style lang="scss" scoped>

</style>
