<template>
<v-simple-table class="mt-2 mb-2">
    <template v-slot:default>
        <thead>
            <tr>
                <th class="text-left">
                    Price
                </th>
                <th class="text-left">
                    Special Price
                </th>
                <th class="text-left">
                    Sku
                </th>
                <th class="text-left"  v-if="price">
                    edit
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="price">
                <td>{{ price.regular }}</td>
                <td>{{ price.special }}</td>
                <td>{{ price.sku }}</td>
                <td>
                    <editPrice
                        v-if="price"
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
                </td>
            </tr>
            <tr  v-if="!price">
                <td
                    colspan="3"
                   >

                    <v-row justify="center">
                        <v-btn
                            small
                            color="secondary"
                            @click="loadProduct">
                            <v-icon
                                left
                                dark>
                                {{refreshIcon}}
                            </v-icon>
                            refresh
                        </v-btn>
                    </v-row>
                </td>
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
            refreshIcon: mdiRefreshCircle
        }

    },

    computed: {
        price() {

            if (this.newPrice) {
                return this.newPrice;
            } else {
                let p = Product.query().with('price').find(this.item.id);

                return p.price;
            }

        }
    },
    methods: {
        loadProduct() {
            this.newPrice = Price.query().where('product_id', `${this.item.id}`).first();
        }
    }
}
</script>
