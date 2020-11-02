<template>
<vo
    ref="imageCreateInfo"
    v-slot="{ handleSubmit }">
    <v-row>
        <imagesDialog @images="inputImages">
            <template v-slot:activator="{ on}">
                <vp
                    class="col-12"
                    v-slot="{ errors }"
                    vid="images"
                    name="images"
                    rules="required">
                    <v-combobox
                        v-model="selectedImages"
                        :items="selectedImages"
                        hide-selected
                        :clearable="false"
                        v-on="on"
                        label="add images"
                        multiple
                        outlined
                        :error-messages="errors"
                        prepend-inner-icon="mdi-camera"
                        small-chips>

                        <template v-slot:selection="data">
                            <v-chip
                                :key="JSON.stringify(data.item)"
                                v-bind="data.attrs"
                                :input-value="data.selected"
                                :disabled="data.disabled">
                                <v-avatar
                                    class="accent white--text"
                                    left>
                                    <v-icon small>
                                        mdi-camera
                                    </v-icon>
                                </v-avatar>
                                {{ data.item }}
                            </v-chip>
                        </template>
                    </v-combobox>

                    <!-- <v-text-field
                        prepend-inner-icon="mdi-camera"
                        label="add images"
                        multiple
                        outlined
                        small-chips
                        item-text="title"
                        v-on="on"
                        :error-messages="errors"
                        dense></v-text-field> -->
                </vp>
            </template>
        </imagesDialog>

        <v-col cols="12">
            <v-btn
                color="primary"
                @click="complete">
                Continue
            </v-btn>

            <v-btn
                text
                @click="back">
                Back
            </v-btn>
        </v-col>
    </v-row>
</vo>
</template>

<script>
import imagesDialog from '@/components/imagesCreateDialog.vue'
import {
    apiProduct,
    apiCategory,
    apiBrand,
    apiVariant
} from '@/api';
import {
    Category,
    Brand,
    Variant
} from '@/models';
export default {
    name: 'imageCreate',
    components: {
        imagesDialog
    },
    props: {
        // value: {
        //     type: Array,
        //     required: true,
        // }
    },
    data() {
        return {
            images: [],
            dialog: true,
            selectedImages: []

        }
    },
    computed: {
        variantsCollection() {
            //.where('isActive', true)
            return Variant.query().get();
        },
        variantOptions() {
            return this.variants.map(item => {
                return this.variantsCollection.find(i => i.id == item.id).options;
            })
        }

    },
    methods: {
        complete() {

            if (this.images.length) {
                this.$emit('images', this.images);
                this.$emit('complete', 4);
            } else {
                this.$refs.imageCreateInfo.setErrors({
                    images: 'image are required'
                })

            }

        },
        back() {
            this.$emit('back', 2);
        },

        async fetheDropdowns() {
            const variants = apiVariant.index();

            await variants;
            // let brandCollection = await brands;

        },
        getFields() {
            return this.images;
        },
        // setFields() {
        //     this.images = this.value

        // },
        inputImages($event) {

            this.images = $event;
            this.selectedImages = this.images.map(i => i.name);

        }
    },
    watch: {
        images(arr) {

        }
    },
    created() {
        // this.setFields();
        // this.fetheDropdowns()
    }

}
</script>

<style lang="scss" scoped>

</style>
