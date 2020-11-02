<template>
<v-dialog
    v-model="dialog"
    width="500">
    <template v-slot:activator="{ on, attrs }">
        <slot
            name="activator"
            v-bind:on="on"
            v-bind:attrs="attrs">

        </slot>

    </template>

    <v-card>
        <v-card-title class="headline grey lighten-2">
            Crop Image
        </v-card-title>

        <!-- @change="change" -->
        <cropper
            ref="cropper"
            class="cropper"
            :src="image.dataUrl"
            :stencil-props="{aspectRatio}"></cropper>

        <v-divider></v-divider>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                @click="cropData"
                color="primary"
                dark>
                crop
            </v-btn>
        </v-card-actions>
    </v-card>
</v-dialog>
</template>

<script>
import {
    Cropper
} from 'vue-advanced-cropper'
export default {
    name: 'vueCrop',
    components: {
        Cropper
    },
    props: {
        aspectRatio: {
            type: Number,
            default: 1.3

        },
        image: {
            // type: String,

            required: true,
        }
    },
    data() {
        return {
            dialog: true,
            copedImg: '',
            coordinates: {
                width: 0,
                height: 0,
                left: 0,
                top: 0,
            },

        }
    },
    methods: {
        // change({
        //     coordinates,
        //     canvas
        // }) {

        //     console.log(coordinates, canvas)
        // },
        cropData() {

            const {
                coordinates,
                canvas,
            } = this.$refs.cropper.getResult();
            this.coordinates = coordinates;
            // You able to do different manipulations at a canvas
            // but there we just get a cropped image
            let d = this.image;
            d.dataUrl = canvas.toDataURL()

            this.$emit('done', d);
            this.dialog = false;

            // console.log(canvas.toDataURL())
        }
    },

}
</script>

<style lang="scss" scoped>
.cropper {

    background: #DDD;
}
</style>
