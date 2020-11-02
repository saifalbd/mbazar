<template>
<v-row justify="center">
    <v-dialog
        v-model="dialog"
        hide-overlay
        width="500"
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
                <v-toolbar-title>{{ cardTitle}} warehouse</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>

            <v-divider></v-divider>
            <template>
                <vo
                    ref="addwarehouse"
                    v-slot="{ handleSubmit }">
                    <v-card
                        class="mx-auto mt-2"
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
                                rules="required">
                                <v-text-field
                                    v-model="title"
                                    :counter="10"
                                    :error-messages="errors"
                                    label="Title"
                                    outlined
                                    placeholder="wahrehouse title hear"
                                    :dense="dense"
                                    required></v-text-field>
                            </vp>
                            <vp
                                v-slot="{ errors }"
                                vid="place"
                                name="place"
                                rules="required">
                                <v-text-field
                                    v-model="place"
                                    :counter="10"
                                    :error-messages="errors"
                                    label="place"
                                    outlined
                                    placeholder="warehouse place hear"
                                    :dense="dense"
                                    required></v-text-field>
                            </vp>

                            <vp
                                v-slot="{ errors }"
                                vid="description"
                                name="description"
                                rules="">
                                <v-textarea
                                    v-model="description"
                                    :counter="1000"
                                    :error-messages="errors"
                                    label="description"
                                    outlined
                                    placeholder="Category description hear"
                                    :dense="dense"
                                    ></v-textarea>
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
    apiWarehouse
} from '@/api';

export default {
    props: {
        item: {
            type: Object,
        },

        value: {
            type: Boolean,
            default: false
        },
    },

    data() {
        return {

            notifications: false,
            sound: true,
            widgets: false,
            dense: true,
            //model
            title: '',
            description: '',
            place: null,
            
            overlay: false

        }
    },
    computed: {

        dialog: {
            get() {

                return this.value
            },
            set(val) {

                this.$emit('input', val)
            }
        },
        cardTitle(){
            return this.item?'edit':'add';
        }
    },
    methods: {
        async onSubmit() {
            var formData = {
                title: this.title,
                place: this.place,
                description: this.description
            }
            this.overlay = true;

            try {
                if (this.item) {
                    await apiWarehouse.update(this.item.id, formData);
                } else {
                    await apiWarehouse.create(formData);
                }

                this.dialog = false

            } catch (e) {

                if (e.response.status == 422) {

                    vErrors.apply(this, [e.response.data, 'editForm']);
                }
            }

            this.overlay = false;

        },
        setVal() {
            this.title = this.item.title;
            this.place = this.item.place;
            this.description = this.item.description;

        }
    },
    watch: {
        item(val) {
            if (val) {
                this.setVal()
            }
        },
        value(val) {
            if (val) {
                if (this.item) {
                    this.setVal()
                }
            }
        }
    },

    created() {
        if (this.item) {
            this.setVal()
        }

    },
    mounted() {

    }

}
</script>
