<template>
<v-simple-table class="mt-2 mb-2">
    <template v-slot:default>
        <thead>
            <tr>
                <th class="text-center">
                    isFeatured
                </th>
                <th class="text-center">
                    isFavorite
                </th>
                <th class="text-center">
                    isBest
                </th>
                <th class="text-center">
                    isTopSale
                </th>
                <!-- <th class="text-center">
                    edit
                </th> -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>

                    <v-row class="d-flex justify-center">
                        <v-switch
                        :loading="loder.isFeatured"
                        :disabled="loder.isFeatured"
                            v-model="isFeatured"
                            :label="isFeatured?'Yes':'No'"></v-switch>
                    </v-row>
                </td>
                <td>

                    <v-row class="d-flex justify-center">
                        <v-switch
                        :loading="loder.isFavorite"
                        :disabled="loder.isFavorite"
                            v-model="isFavorite"
                            :label="isFavorite?'Yes':'No'"></v-switch>
                    </v-row>

                </td>
                <td>
                    <v-row class="d-flex justify-center">
                        <v-switch
                        :disabled="loder.isBest"
                        :loading="loder.isBest"
                            v-model="isBest"
                            :label="isBest?'Yes':'No'"></v-switch>
                    </v-row>

                </td>

                <td>
                    <v-row class="d-flex justify-center">
                        <v-switch
                        :disabled="loder.isTopSale"
                        :loading="loder.isTopSale"
                            v-model="isTopSale"
                            :label="isTopSale?'Yes':'No'"></v-switch>
                    </v-row>

                </td>

                <!-- <td>
                    <editPrice

                        :item="price">
                        <template v-slot:activator="{ on }">
                            <v-btn
                                x-small
                                color="secondary"
                                dark
                                v-on="on">
                                <v-icon
                                    left
                                    dark>
                                    mdi-pencil
                                </v-icon>
                                Edit
                            </v-btn>
                        </template>
                    </editPrice>
                </td> -->
            </tr>

        </tbody>
    </template>
</v-simple-table>
</template>

<script>
import editPrice from './editPrice.vue';
import {
    mdiRefreshCircle
} from '@mdi/js';
import {
    Price,
    Product
} from '@/models/index.js';
import {
    axios
} from '@/plugins/axios';
export default {
    components: {
        editPrice
    },
    props: {
        item: {
            type: [Object, null],
            required: true
        }
    },
    data() {
        return {
            hasPrice: true,
            newPrice: null,
            refreshIcon: mdiRefreshCircle,
             isFeatured: false,
                isFavorite: false,
                isBest: false,
                isTopSale: false,

            loder: {
                isFeatured: false,
                isFavorite: false,
                isBest: false,
                isTopSale: false,
            }

        }

    },

    computed: {
      

    },
    methods: {
        setValues(rules) {
            const {
                isFeatured,
                isFavorite,
                isBest,
                isTopSale
            } = rules;
            this.isFeatured = isFeatured;
            this.isFavorite = isFavorite;
            this.isBest = isBest;
            this.isTopSale = isTopSale;

        },
        async changeRule(rule, val) {
            let value = Number(val);
            this.loder[rule] = true;
            let {
                data
            } = await axios.put(`/products/${this.item.id}/rule`, {
                value,
                rule
            });
            Product.update({
                where: this.item.id,
                data
            });

            this.loder[rule] = false;
            return Promise.resolve(true);

        }
    },
    watch: {
        async isFeatured(val) {
            let rule = "isFeatured";

            await this.changeRule(rule, val);

        },
        async isFavorite(val) {
            let rule = "isFavorite";
            await this.changeRule(rule, val);
        },
        async isBest(val) {
            let rule = "isBest";
            await this.changeRule(rule, val);
        },
        async isTopSale(val) {
            let rule = " isTopSale";
            await this.changeRule(rule, val);
        }
    },
    created() {
        this.setValues(this.item.rules)
    }
}
</script>
