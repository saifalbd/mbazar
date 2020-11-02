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
                                vid="parent_id"
                                name="Parent"
                                rules="">
                                <v-select
                                    v-model="parent_id"
                                    :error-messages="errors"
                                    label="Parent optional"
                                    outlined
                                    :dense="dense"
                                    :items="categories.filter(i=>i.title != title)"
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
                                vid="image"
                                name="image"
                                rules="image">
                                <v-file-input
                                    v-model="file"
                                    :dense="dense"
                                    color="deep-purple accent-4"
                                    :error-messages="errors"
                                    counter
                                    label="File input"
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
import Category from '@/models/Category';
import {
    apiCategory
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
            description: '',
            parent_id: null,
            brand: 1,
            active: false,
            file: null,
            overlay: false

        }
    },
    computed: {
        categories() {
            return Category.query().where('parent_id', null).where('isActive', true).get();
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
                active: Number(this.active),
                description: this.description
            }

            if (this.parent) {
                formData['parent_id'] = this.parent;
            }
            if (this.file) {
                formData['image'] = this.file;
            }
            this.overlay = true;

            try {
                await apiCategory.update(this.item.slug,formData);
                this.dialog = false
                this.save = true;
            } catch (e) {

                if (e.response.status == 422) {
                  
                    vErrors.apply(this, [e.response.data, 'editForm']);
                }
            }

            this.overlay = false;

        },
        setVal() {
            this.title = this.item.title;
            this.parent = this.item.parent_id;
            this.description = this.item.description;

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
    },
    mounted() {

    }

}
</script>
