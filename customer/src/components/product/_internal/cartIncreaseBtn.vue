<template>
<div class="e-cartAdd-all">
    <v-btn-toggle
        dense
        rounded>
        <v-btn
            color="lime accent-3"
            @click="val--">
            <v-icon color="purple">mdi-minus-box</v-icon>
        </v-btn>

        <input class="e-cartAdd-input text-center" v-model="val">

        <v-btn
            color="lime accent-3"
            @click="val++">
            <v-icon color="purple">mdi-plus-box</v-icon>
        </v-btn>

    </v-btn-toggle>
    <span class="e-loader" v-show="loading">
        <span class="v-btn__loader">
            <div
                role="progressbar"
                aria-valuemin="0"
                aria-valuemax="100"
                class="v-progress-circular v-progress-circular--indeterminate"
                style="height: 23px; width: 23px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="21.904761904761905 21.904761904761905 43.80952380952381 43.80952380952381" style="transform: rotate(0deg);">
                    <circle
                        fill="transparent"
                        cx="43.80952380952381"
                        cy="43.80952380952381"
                        r="20"
                        stroke-width="3.8095238095238093"
                        stroke-dasharray="125.664"
                        stroke-dashoffset="125.66370614359172px"
                        class="v-progress-circular__overlay"></circle>
                </svg>
                <div class="v-progress-circular__info"></div>
            </div>
        </span>
        <!-- <v-progress-circular :value="20"></v-progress-circular> -->
    </span>
</div>
</template>

<script>
export default {
    props: {
        value: {
            type: Number,
            required: true
        },
        loading: {
            type: Boolean,
            default: false
        }
    },

    computed: {
        val: {
            set(v) {
                if (v > 0) {
                    this.$emit('input', v)
                }

            },
            get() {
                return this.value;
            }
        }
    }

}
</script>

<style lang="scss">
.e-cartAdd-all {
    position: relative;

    .e-cartAdd-input {
        border: 1px solid #C6FF00;
        width: 50px;

        &:focus {
            outline: none;

        }

    }

    .e-loader {

        position: absolute;
        height: 100%;
        width: 100%;
        left: 0;
        top: 0;
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;

    }
}
</style>
