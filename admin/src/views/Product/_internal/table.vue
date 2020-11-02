<template>
<v-card>

    <v-sheet
        :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
        class="pa-3"
        v-if="overlay">
        <v-skeleton-loader
            class="mx-auto"
            type="table"></v-skeleton-loader>
    </v-sheet>

    <template v-else>
        <v-card-title>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details></v-text-field>
        </v-card-title>
        <v-data-table
            :headers="headers"
            :items="products"
            :search="search"
            hide-default-footer
            :single-expand="true"
            :expanded.sync="expanded"
            item-key="id"
            show-expand
            class="elevation-1">
            <template v-slot:item.isActive="{ item }">
                <v-btn
                    icon
                    color="deep-purple accent-4"
                    v-if="item.isActive">
                    <v-icon>
                        mdi-check-underline
                    </v-icon>
                </v-btn>
                <v-btn
                    icon
                    color="deep-orange"
                    v-else>
                    <v-icon>
                        mdi-close-box
                    </v-icon>
                </v-btn>
            </template>
            <template v-slot:item.image="{ item }">
                <v-avatar>
                    <img :src="item.image" alt="John">
                </v-avatar>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-btn
                    icon
                    color="indigo"
                    small
                    @click="editItem(item)">
                    <v-icon>
                        mdi-pencil
                    </v-icon>
                </v-btn>
                <v-btn
                    icon
                    color="green"
                    small
                    @click="showItem(item)">
                    <v-icon>
                        mdi-eye
                    </v-icon>
                </v-btn>
                <v-btn
                    icon
                    color="pink"
                    small
                    @click="deleteItem(item)">
                    <v-icon>
                        mdi-delete
                    </v-icon>
                </v-btn>
            </template>
            <template v-slot:expanded-item="{ headers, item }">
                <td :colspan="headers.length">
                    <span>
                        <price
                            v-if="item.hasPrice"
                            :item="item"></price>

                        <addPrice
                            :item="item"
                            v-else>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    depressed
                                    color="primary"
                                    v-on="on">
                                    Add Prices
                                </v-btn>
                            </template>
                        </addPrice>
                    </span>
                    <span>
                        <rules :item="item"></rules>

                    </span>
                </td>

            </template>

        </v-data-table>
        <v-pagination
            v-model="meta.current_page"
            :length="meta.total"></v-pagination>
        <deleteConfim
            v-model="dialogDelete"
            @confirm="deleteConfim"></deleteConfim>
    </template>
</v-card>
</template>

<script>
import {
    axios
} from '@/plugins/axios';
import deleteConfim from '../../../components/deleteConfirm.vue';
import {
    Product
} from '@/models/index.js';
import addPrice from './_tableInternal/addPrice.vue';
import price from './_tableInternal/prices.vue';
import rules from './_tableInternal/rules.vue';
export default {
    components: {
        deleteConfim,
        addPrice,
        price,
        rules
    },
    inject: {
        theme: {
            default: {
                isDark: false
            },
        },
    },
    data() {
        return {
            expanded: [],
            dialog: false,
            dialogDelete: false,
            editedIndex: -1,
            itemForDelete: null,
            search: '',
            overlay: false,
            headers: [{
                    text: 'serial',
                    align: 'start',
                    filterable: false,
                    value: 'id',
                },
                {
                    text: 'thumb',
                    value: 'image'
                },
                {
                    text: 'title',
                    value: 'title'
                },
                {
                    text: 'slug',
                    value: 'slug'
                },
                {
                    text: 'isActive',
                    value: 'isActive'
                },
                {
                    text: 'createOn',
                    value: 'createOn'
                },
                {
                    text: 'updateOn',
                    value: 'updateOn'
                },
                {
                    text: 'Actions',
                    value: 'actions',
                    sortable: false
                },
            ],
            defaultItem: {
                title: '',
                slug: 0,
                isActive: 0,
                createOn: 0,
                updateOn: 0,
                Actions: ''
            },

            meta: {
                current_page: 1,
                total: 1,
            },

        }

    },
    computed: {
        products() {
            // Fetch all post records.
            return Product.query().with(['category', 'price', 'media']).get()
        }
    },
    methods: {
        showItem(item) {
            this.$emit('show', item);

        },
        editItem(item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true;
            this.$emit('item', this.editedItem);
        },

        deleteItem(item) {
            this.itemForDelete = item;
            this.dialogDelete = true
        },

        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },
        async deleteConfim(rule) {
            if (rule) {
                const id = this.itemForDelete.id;
                this.closeDelete();
                const product = Product.find(id);
                product.$delete();
                await axios.delete(`/products/${id}`);
            }
        },

    },
    async created() {
        this.overlay = true;
        const {
            data
        } = await axios.get('/products');
        Product.insert({
            data: data.data
        })
        this.desserts = data.data;
        this.overlay = false;

    }
}
</script>
