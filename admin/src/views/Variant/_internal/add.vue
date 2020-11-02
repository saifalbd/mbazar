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
                    Add Variant
                </v-toolbar-title>
                <v-spacer></v-spacer>

            </v-toolbar>
            <v-divider></v-divider>
            <template>
                <vo
                    ref="variantAdd"
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
                            <multiInput
                                label="variant Options"
                                v-model="options"></multiInput>
                            <!-- <vp
                                v-slot="{ errors }"
                                vid="options"
                                name="Options"
                                rules="required">
                                <v-combobox
                                    v-model="options"
                                    :items="variantOptions"
                                    label="Combobox"
                                    :error-messages="errors"
                                    multiple
                                    outlined
                                    item-text="title"
                                    item-value="id"
                                    dense></v-combobox>
                            </vp> -->
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
import multiInput from '@/components/multiInput'
import {
    axios,
    vErrors
} from '@/plugins/axios';
import {
    VariantOption
} from '@/models';
import {
    apiVariant,
    apiVariantOption
} from '@/api';
export default {
    props: ['value'],
    components: {
        multiInput
    },
    data() {
        return {

            notifications: false,
            sound: true,
            widgets: false,
            dense: true,
            //model
            title: 'eva',
            overlay: false,
            options: []

        }
    },
    computed: {
        variantOptions() {
            return VariantOption.all();
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
            if (!this.options.length) {
                // this.refs.variantOptionAdd.serErrors({
                //     'options': 'options not valid'
                // })
                // return false
            }
            var formData = {
                title: this.title,

            };
            for (const key in this.options) {
                if (this.options[key]) {
                    formData[`options[${key}]`] = this.options[key];

                }
            }

            this.overlay = true;
            try {
                await apiVariant.create(formData);
                // this.dialog = false

            } catch (e) {

                if (e.response.status == 422) {
                    vErrors.apply(this, [e.response.data, 'variantAdd']);
                }

            }
            this.overlay = false;

        }
    }

}
</script>
