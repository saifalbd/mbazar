<template>
<vo
    ref="productAddInfo"
    v-slot="{ handleSubmit }">

    <v-row>
        <vp
            class="col-12"
            v-slot="{ errors }"
            vid="variants"
            name="variants"
            rules="required">
            <v-combobox
                v-model="variants"
                :items="variantsCollection"
                label="Variants"
                multiple
                outlined
                small-chips
                item-text="title"
                :error-messages="errors"
                dense></v-combobox>
        </vp>
        <vp
            v-for="(item,index) in variants"
            :key="index"
            class="col-12"
            v-slot="{ errors }"
            :vid="`options${index}`"
            name="options"
            rules="required">
            <v-combobox
                v-model="item.selects"
                :items="item.options"
                :label="`${item.title} Variants Options`"
                multiple
                outlined
                small-chips
                item-text="title"
                :error-messages="errors"
                dense></v-combobox>
        </vp>

        <!-- <vp
            class="col-12"
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
            class="col-12"
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
        </vp> -->

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
    apiBrand,
    apiVariant
} from '@/api';
import {
    Category,
    Brand,
    Variant
} from '@/models';
export default {
    name: 'variantform',
    props: {
        value: {
            type: Array,
            required: true,
        }
    },
    data() {
        return {
            variants: [],
            options: [],
            brand_id: '',

        }
    },
    computed: {
        variantsCollection() {
            //.where('isActive', true)
            return Variant.query().get();
        },
        variantOptions() {
            return this.variants.map(item => {
                return this.variantsCollection.find(i => i.id == item.id).options;
            })
        }

    },
    methods: {
        complete() {
            this.$refs.productAddInfo.validate().then(success => {
                if (!success) {
                    return;
                }

                this.$emit('input', this.getFields());
                this.$emit('complete', 5);

            });

        },
        back() {
            this.$emit('back', 3);
        },

        async fetheDropdowns() {
            const variants = apiVariant.index();

            await variants;
            // let brandCollection = await brands;

        },
        getFields() {
            return this.variants
        },
        setFields() {

            this.variants = this.value.map(i => {
                i.selects = []
                return i;
            });

        }
    },
    watch: {
        variants(arr) {

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
