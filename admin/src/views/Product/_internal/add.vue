<template>
<v-row justify="center">
    <v-dialog
        v-model="dialog"
        hide-overlay
        transition="dialog-bottom-transition">

        <v-card>
            <v-toolbar
                dark
                color="primary">
                <v-btn
                    icon
                    dark
                    @click="dialog = false">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
                <v-toolbar-title>Entry Product</v-toolbar-title>
                <v-spacer></v-spacer>

            </v-toolbar>

            <v-divider></v-divider>
            <template>
                <vo
                    ref="addForm"
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
                                name="Title"
                                rules="required|max:150">
                                <v-text-field
                                    v-model="title"
                                    :counter="10"
                                    :error-messages="errors"
                                    label="Title*"
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
                                    label="Category*"
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
                                vid="images"
                                name="images"
                                rules="required">
                                <v-file-input
                                    v-model="files"
                                    :dense="dense"
                                    color="deep-purple accent-4"
                                    :error-messages="errors"
                                    counter
                                    label="File input*"
                                    multiple
                                    placeholder="Select your files*"
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
                                    label="description*"
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
    Category,
    Product,
    Brand
} from '@/models/index.js';
import {
    axios,vErrors
} from '@/plugins/axios';
import {
    apiProduct,apiCategory,apiBrand
} from '@/api';
export default {
    props: ['value'],
    data() {
        return {

            notifications: false,
            sound: true,
            widgets: false,
            dense: true,
            //model
            title: '',
            description: `is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.`,
          
            category_id: 1,
            brand_id: null,
            files: [],
            overlay: false,

        }
    },
    computed: {
        categories() {
            return Category.query().where('isActive', true).get();
        },
        brands() {
            return Brand.query().where('isActive', true).all();
        },
        dialog: {
            get() {
                return this.value
            },
            set(val) {
                this.$emit('input', val)
            }
        }
    },
    methods: {
        async fetheDropdowns() {
            const categories = apiCategory.index();
            const brands = apiBrand.index();



            let categoryCollection = await categories;
            let brandCollection = await brands;

           
        },
        async onSubmit() {
            var formData = {};
            for (let index = 0; index < this.files.length; index++) {
                formData[`images[${index}]`]= this.files[index];
            }

formData[`category_id`]= this.category_id;
formData[`title`]=  this.title;
formData[`description`]=  this.description;

            this.overlay = true;

            try {

               await apiProduct.create(formData);
                // Category.update({where: this.item.id,data})
                this.dialog = false

            } catch (e) {
                if (e.response.status == 422) {
                    vErrors.apply(this, [e.response.data, 'addForm']);
                }
            }

            this.overlay = false;

        }
    },
    created() {
        this.fetheDropdowns()
    }

}
</script>
