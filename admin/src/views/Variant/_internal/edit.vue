<template>
<v-dialog
    v-model="dialog"
    persistent
    max-width="600px"
    transition="dialog-bottom-transition">
    <template v-slot:activator="{ on, attrs }">
        <slot
            name="activator"
            v-bind:on="toggle"></slot>
    </template>
    <vo
        :ref="`editFormvariant${item.id}`"
        v-slot="{ handleSubmit }">
        <v-container
            tag="form"
            @submit.prevent="handleSubmit(onSubmit)">

            <v-card>
                <v-card-title>
                    <span class="headline">Edit Variant {{item.title}}</span>
                </v-card-title>
                <v-card-text>

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
        </v-container>
    </vo>
</v-dialog>
</template>

<script>
import {
    axios,
    vErrors
} from '@/plugins/axios';
import Category from '@/models/Category';
import {
    apiVariant
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
            dialog: false,
            notifications: false,
            sound: true,
            widgets: false,
            dense: true,
            //model
            title: '',

            overlay: false

        }
    },
    computed: {
        categories() {
            return Category.query().where('parent_id', null).where('isActive', true).get();
        },

    },
    methods: {
        toggle() {
            this.dialog = !this.dialog;
        },
        async onSubmit() {

            var formData = {
                title: this.title,

            }

            this.overlay = true;

            try {

                await apiVariant.update(this.item.id,formData);
                this.dialog = false

            } catch (e) {

                if (e.response.status == 422) {
                

                    vErrors.apply(this, [e.response.data,
                        `editFormvariant${this.item.id}`
                    ]);
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
