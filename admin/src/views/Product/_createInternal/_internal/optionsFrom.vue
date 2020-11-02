<template>
<v-simple-table>
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
                    p-rice
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

            </tr>
        </thead>
        <tbody>
            <tr
                v-for="(v ,index) in mixVariants"
                :key="index">
                <td>
                    {{v.slug}}
                </td>
                <td>{{v.variantTitle}}</td>
                <td>{{v.optionTitle}}</td>
                <td>
                    <eInput
                        type='number'
                        v-model="v.price"></eInput>
                </td>
                <td>
                    <eInput
                        type='number'
                        v-model="v.comparePrice"></eInput>
                </td>
                <td>
                    <v-btn
                        x-small
                        block
                        color="black"
                        dark
                        v-if="v.isUnlimited">
                        unlimited storage
                    </v-btn>
                    <vp
                        v-else
                        v-slot="{ errors }"
                        vid="title"
                        name="Title"
                        rules="required|max:150">
                        <eInput
                            type='number'
                            errors="errors"
                            v-model="v.inventory_quantity"></eInput>
                    </vp>
                </td>
                <td>
                    <eSelect
                        :items="storageDropdowns"
                        v-model="v.inventory_store"></eSelect>

                         <vp
                                    v-slot="{ errors }"
                                    vid="title"
                                    name="Title"
                                    rules="required">
                                    <v-text-field
                                        outlined
                                        type='number'
                                        v-model="v.comparePrice"
                                        hide-details
                                        :errors="errors"
                                        dense></v-text-field>
                                </vp>
                </td>
                <td>
                    {{v.sku}}
                </td>
                <td class="pointer">
                    <v-badge
                        bordered
                        overlap
                        color="deep-purple accent-4 "
                        :content="v.images.length">
                        <v-avatar size="36">
                            <v-img :src="v.images[0].dataUrl"></v-img>
                        </v-avatar>
                    </v-badge>

                </td>

            </tr>
        </tbody>
    </template>
</v-simple-table>
</template>

<script>
import eInput from './_inputs/eInput'
import eSelect from './_inputs/eSelect'
import {
    properties
} from './js/dataCollector'
export default {
    name: 'variantsAttForm',
    components: {
        eInput,
        eSelect
    },
    props: {
        storageDropdowns: {
            type: Array,
            required: true,
        }
    },
    data() {
        return {
            model: '',

            storage: [
                // its come from server now for test add data
                {
                    storageId: 1,
                    title: 'store A'
                }
            ],

        }
    },

    computed: {
        mixVariants() {
            return properties();
            return []

        }
    },

    methods: {

        uniqueSku(index) {
            var d = new Date(1603216886124);
            var n = d.getTime() + index + 1;
            return n;
        },
        slugCase(str) {
            return str.replace("  ", "-").replace(",", "-").replace(" ", "-")
        },
        slug(productTitle, variantTitle, optionTitle) {

            return `${this.slugCase(productTitle)}-${this.slugCase(variantTitle)}-${this.slugCase(optionTitle)}`
        }
    },
    created() {

    }

}
</script>

<style lang="scss" scoped>
.pointer {
    cursor: pointer;
}
</style>
