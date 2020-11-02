<template>
<v-row justify="center">
    <v-dialog
        v-model="dialog"
        hide-overlay
        transition="dialog-bottom-transition">

        <v-card>
            <v-toolbar
                dark
                dense
                color="info">
                <v-btn
                    icon
                    dark
                    @click="dialog = false">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
                <v-toolbar-title>{{item.title}} Edit</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn
                        dark
                        text
                        @click="dialog = false">
                        Save
                    </v-btn>
                </v-toolbar-items>
            </v-toolbar>

            <v-divider></v-divider>
            <template>
                <vo
                    ref="editForm"
                    v-slot="{ handleSubmit }">
                    <v-card
                        class="mx-auto"
                        max-width="700"
                        outlined
                        tag="form"
                        @submit.prevent="handleSubmit(onSubmit)">
                        <!-- start overly -->
                        <v-overlay
                            :absolute="true"
                            :value="overlay">
                            <v-progress-circular
                                indeterminate
                                size="100"
                                color="primary"></v-progress-circular>
                        </v-overlay>
                        <!-- end overly -->
                        <v-card-text>
                            <vp
                                v-slot="{ errors }"
                                vid="title"
                                name="Name"
                                rules="required|max:150">
                                <v-text-field
                                    v-model="title"
                                    :counter="10"
                                    :error-messages="errors"
                                    label="Title"
                                    outlined
                                    placeholder="product title hear"
                                    :dense="dense"
                                    required></v-text-field>
                            </vp>
                            <vp
                                v-slot="{ errors }"
                                name="Category"
                                rules="required">
                                <v-select
                                    v-model="category_id"
                                    :error-messages="errors"
                                    label="Category"
                                    outlined
                                    :dense="dense"
                                    :items="categories"
                                    item-text="title"
                                    item-value="id"
                                    required>

                                </v-select>
                            </vp>
                            <vp
                                v-slot="{ errors }"
                                name="Brand"
                                vid="brand_id"
                                rules="">
                                <v-select
                                    v-model="brand_id"
                                    :error-messages="errors"
                                    label="Brand (optional)"
                                    outlined
                                    :dense="dense"
                                    :items="brands"
                                    item-text="title"
                                    item-value="id"
                                    required>

                                </v-select>
                            </vp>

                            <vp
                                v-slot="{ errors }"
                                name="Active"
                                vid="active"
                                rules="required">
                                <v-select
                                    v-model="active"
                                    :error-messages="errors"
                                    label="Active"
                                    outlined
                                    :dense="dense"
                                    :items="[{v:true,t:'yes'},{v:false,t:'no'}]"
                                    item-text="t"
                                    item-value="v"
                                    required>
                                </v-select>
                            </vp>

                            <vp
                                v-slot="{ errors }"
                                vid="images"
                                name="image"
                                rules="image">
                                <v-file-input
                                    v-model="files"
                                    :dense="dense"
                                    color="deep-purple accent-4"
                                    :error-messages="errors"
                                    counter
                                    label="File input"
                                    multiple
                                    placeholder="Select Thumb Optional"
                                    outlined
                                    :show-size="1000">
                                    <template v-slot:selection="{ index, text }">
                                        <v-chip
                                            v-if="index < 2"
                                            color="deep-purple accent-4"
                                            dark
                                            label
                                            small>
                                            {{ text }}
                                        </v-chip>

                                        <span v-else-if="index === 2" class="overline grey--text text--darken-3 mx-2">
                                            +{{ files.length - 2 }} File(s)
                                        </span>
                                    </template>
                                </v-file-input>
                            </vp>
                            <vp
                                v-slot="{ errors }"
                                vid="description"
                                name="description"
                                rules="required|max:1000">
                                <v-textarea
                                    v-model="description"
                                    :counter="1000"
                                    :error-messages="errors"
                                    label="description"
                                    outlined
                                    placeholder="product description hear"
                                    :dense="dense"
                                    required></v-textarea>
                            </vp>

                        </v-card-text>

                        <v-divider></v-divider>
                        <v-card-actions class="text-right">
                            <v-container>
                                <v-btn
                                    type="submit"
                                    dark
                                    color="indigo">
                                    save
                                </v-btn>
                            </v-container>

                        </v-card-actions>
                    </v-card>
                </vo>
            </template>

        </v-card>
    </v-dialog>
</v-row>
</template>

<script>
import {
    axios,vErrors
} from '@/plugins/axios';
import {
    Category,
    Product,
    Brand
} from '@/models/index.js';
import {
    apiProduct,apiCategory,apiBrand
} from '@/api';

export default {
    props: {
        item: {
            type: Object,
            required: true
        },
        value: Boolean
    },
    props: ['value', 'item'],
    data() {
        return {

            notifications: false,
            sound: true,
            widgets: false,
            dense: true,
            //model
            title: '',
            category_id: 1,
            brand_id: null,
            active: false,
            description: '',
            files: [],
            overlay: false,

        }
    },
    computed: {
        categories() {
            return Category.all();
        },
        brands() {
            return Brand.all();
        },
        dialog: {
            get() {
                return this.value
            },
            set(val) {
                this.$emit('input', val)
            }
        },

    },
    methods: {
        async onSubmit() {

            var formData = {
                title:this.title,
                active:Number(this.active),
                category_id:this.category_id,
                description:this.description

            };

          
            
            if (this.files) {
               for (let index = 0; index < this.files.length; index++) {
                formData[`images[${index}]`]= this.files[index];
            }
            }

            this.overlay = true;

            try {
                   await apiProduct.update(formData);
                this.dialog = false

            } catch (e) {
                if (e.response.status == 422) {
                    vErrors.apply(this, [e.response.data, 'editForm']);
                }
            }

            this.overlay = false;

        },
        async fetheDropdowns() {
            const categories = apiCategory.index();
            const brands = apiBrand.index();

            let categoryCollection = await categories;
            let brandCollection = await brands;

            Category.insert({
                data: categoryCollection.data.data
            });
            Brand.insert({
                data: brandCollection.data.data
            });
        },
        setVal() {

            this.title = this.item.title;
            this.active = this.item.isActive?true:false;
            this.description = this.item.description;
            if (this.item.category) {
                this.category_id = this.item.category.id;
            }

        }
    },
    watch: {
        item() {
            this.setVal()
        },
        value(val) {
            if (val) {
                this.setVal()
            }
        }
    },

    created() {
        this.setVal()
        this.fetheDropdowns();
    },
    mounted() {

    }

}
</script>
