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
            :items="desserts"
            :search="search"
            hide-default-footer
            class="elevation-1">
            <!-- <template v-slot:item.image="{ item }">
                <v-avatar>
                    <img :src="item.image" alt="John">
                </v-avatar>
            </template> -->
          
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
                    color="pink"
                    small
                    @click="deleteItem(item)">
                    <v-icon>
                        mdi-delete
                    </v-icon>
                </v-btn>
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
import Category from '@/models/Category';
import { Collection } from './collection';

export default {
    components: {
        deleteConfim
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
            dialog: false,
            dialogDelete: false,
            editedIndex: -1,
            itemForDelete: null,
            overlay: false,
            search: '',
            headers: [{
                    text: 'serial',
                    align: 'start',
                    filterable: false,
                    value: 'item_id',
                },
                {
                    text: 'name',
                    value: 'name'
                },
                {
                    text: 'group_name',
                    value: 'group_name'
                },
                {
                    text: 'qty',
                    value: 'qty'
                },
                {
                    text: 'unit_name',
                    value: 'unit_name'
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
       
    },
    methods: {
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
                const category = Category.find(id);
                category.$delete();
                await axios.delete(`/categories/${id}`);
            }
        },

    },
     created() {
        this.overlay = true;
        
        this.desserts = Collection;
        this.overlay = false;

    }
}
</script>
