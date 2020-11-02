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

        <v-data-table
            :headers="headers"
            :items="collection"
            :search="search"
            hide-default-footer
            
            :single-expand="true"
            :expanded.sync="expanded"
            item-key="id"
            show-expand
            class="elevation-1">
            <template v-slot:top>
                <add v-model="add" />

                <v-toolbar flat>
                    <!-- <v-toolbar-title>{{title}}</v-toolbar-title> -->
                    <!-- <v-divider
                        class="mx-4"
                        inset
                        vertical></v-divider> -->
                    <v-spacer></v-spacer>
                    <v-btn
                        color="primary"
                        dark
                        class="mb-2"
                        @click="add= true">
                        New Item
                    </v-btn>
                </v-toolbar>
                <v-card-title>
                    <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        label="Search"
                        single-line
                        hide-details></v-text-field>
                </v-card-title>

            </template>
            <template v-slot:item.image="{ item }">
                <v-avatar>
                    <img :src="item.image" alt="John">
                </v-avatar>
            </template>
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
            <template v-slot:item.actions="{ item }">
                <edit :item="item">
                    <template v-slot:activator="{ on }">
                        <v-btn
                            icon
                            color="indigo"
                            small
                            @click="on">
                            <v-icon>
                                mdi-pencil
                            </v-icon>
                        </v-btn>
                    </template>
                </edit>

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
                   <optionsTable :items="item.options"></optionsTable>
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
import deleteConfim from '@/components/deleteConfirm.vue';
import optionsTable from './optionsTable'
import {
    Variant
} from '@/models';
import {
    apiVariant
} from '@/api';
import add from './add.vue';
import edit from './edit.vue';
export default {
    props: {
        title: {
            type: String,
            default: 'title'
        },
        collection:{
            type:Array,
            required:true
        }
    },
    components: {
        deleteConfim,
        add,
        edit,
        optionsTable
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
            add: false,
            edit: false,
            editItem: null,
            dialog: false,
            dialogDelete: false,

            itemForDelete: null,
            overlay: false,
            search: '',
            headers: [{
                    text: 'serial',
                    align: 'start',
                    filterable: false,
                    value: 'id',
                },

                {
                    text: 'title',
                    value: 'title'
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
        editOnItem(item) {
            this.editItem = item;
            this.dialog = true;
            this.$emit('item', this.item);
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

                await apiVariant.destroy(id);
            }
        },

    },
    async created() {
        this.overlay = true;

      
        this.overlay = false;

    }
}
</script>
