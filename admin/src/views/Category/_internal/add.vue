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
                color="primary">
                <v-btn
                    icon
                    dark
                    @click="dialog = false">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
                <v-toolbar-title>Settings</v-toolbar-title>
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
                                name="Name"
                                rules="required|max:10">
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
                                name="Parent"
                                vid="parent_id"
                                rules="">
                                <v-select
                                    v-model="parent"
                                    :error-messages="errors"
                                    label="Parent optional"
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
                                name="image"
                                vid="image"
                                rules="image">
                                <v-file-input
                                    v-model="file"
                                    :dense="dense"
                                    color="deep-purple accent-4"
                                    :error-messages="errors"
                                    counter
                                    label="File input"
                                    placeholder="Select your files"
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
                                rules="required">
                                <v-textarea
                                    v-model="description"
                                    :counter="1000"
                                    :error-messages="errors"
                                    label="description"
                                    outlined
                                    placeholder="Category description hear"
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
    axios,
    vErrors
} from '@/plugins/axios';
import {
    apiCategory
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
            title: 'eva',
            parent: '',
            description: 'descrpyn',
            brand: 1,
            file: null,
            overlay: false

        }
    },
    computed: {
        categories() {
            return Category.query().where('parent_id', null).get();
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

        async onSubmit() {
  
            
            var formData = {
                title: this.title,
                image: this.file,
                description: this.description

            }

            this.overlay = true;

            try {
                await apiCategory.create(formData);

            } catch (e) {

                if (e.response.status == 422) {
                    alert(252)
                    console.log(e.response)

                    vErrors.apply(this, [e.response.data, 'addForm']);
                }
            }
            this.overlay = false;

        }
    }

}
</script>
