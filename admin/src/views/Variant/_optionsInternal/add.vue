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
                <v-toolbar-title>
                    Add Variant Option
                </v-toolbar-title>
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
import Category from '@/models/Category';


import {
    apiVariantOption
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
        toggle() {
            this.dialog = !this.dialog;
        },
        async onSubmit() {
            var formData = {
                title: this.title
            };

            this.overlay = true;
            try {
                await apiVariantOption.create(formData);
                this.dialog = false

            } catch (e) {

                if (e.response.status == 422) {
                    vErrors.apply(this, [e.response.data, 'addForm']);
                }
            }
            this.overlay = false;

        }
    }

}
</script>
