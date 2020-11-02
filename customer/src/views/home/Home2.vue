<template>
<div id="home">
    <layout>

        <!-- <topCarousel></topCarousel>
        <discountSlider></discountSlider> -->
        <!-- start -->
        <!-- <v-row>
            <v-col cols="12">
                <v-row>
                    <v-container class="d-flex justify-space-between align-center">
                        <v-btn
                            x-large
                            text>
                            <v-icon
                                left
                                dark>
                                mdi-format-list-numbered-rtl
                            </v-icon>

                            tOP SELLERS

                        </v-btn>
                        <v-btn
                            outlined
                            color="indigo"
                            rounded>
                            SHOW ALL
                            <v-icon
                                right
                                dark>
                                mdi-all-inclusive
                            </v-icon>
                        </v-btn>
                    </v-container>

                </v-row>
                <topSellerCollection></topSellerCollection>

            </v-col>
        </v-row> -->
        <!-- end -->
        <!-- start -->
        <!-- <v-row>
            <v-col cols="12">
                <v-row>
                    <v-container class="d-flex justify-space-between align-center">
                        <v-btn
                            x-large
                            text>
                            <v-icon
                                left
                                dark>
                                mdi-format-list-numbered-rtl
                            </v-icon>

                            Favorit Items

                        </v-btn>
                        <v-btn
                            outlined
                            color="indigo"
                            rounded>
                            SHOW ALL
                            <v-icon
                                right
                                dark>
                                mdi-all-inclusive
                            </v-icon>
                        </v-btn>
                    </v-container>

                </v-row>
                <topSellerCollection></topSellerCollection>

            </v-col>
        </v-row> -->
        <!-- end -->
        <!-- start -->
        <!-- <v-row>
            <v-col cols="12">
                <v-row>
                    <v-container class="d-flex justify-space-between align-center">
                        <v-btn
                            x-large
                            text>
                            <v-icon
                                left
                                dark>
                                mdi-format-list-numbered-rtl
                            </v-icon>

                            Best Items

                        </v-btn>
                        <v-btn
                            outlined
                            color="indigo"
                            rounded>
                            SHOW ALL
                            <v-icon
                                right
                                dark>
                                mdi-all-inclusive
                            </v-icon>
                        </v-btn>
                    </v-container>

                </v-row>
                <topSellerCollection></topSellerCollection>

            </v-col>
        </v-row> -->
        <!-- end -->
        <!-- start -->
        <!-- <v-row>
            <v-col cols="12">
                <v-row>
                    <v-container class="d-flex justify-space-between align-center">
                        <v-btn
                            x-large
                            text>
                            <v-icon
                                left
                                dark>
                                mdi-format-list-numbered-rtl
                            </v-icon>

                            new Items

                        </v-btn>
                        <v-btn
                            outlined
                            color="indigo"
                            rounded>
                            SHOW ALL
                            <v-icon
                                right
                                dark>
                                mdi-all-inclusive
                            </v-icon>
                        </v-btn>
                    </v-container>

                </v-row>
                <topSellerCollection></topSellerCollection>

            </v-col>
        </v-row> -->
        <!-- end -->
        <!-- start -->
        <v-row>
            <v-col cols="12">
                <v-row>
                    <v-container class="d-flex justify-space-between align-center">
                        <v-btn
                            x-large
                            text>
                            <v-icon
                                left
                                dark>
                                mdi-format-list-numbered-rtl
                            </v-icon>

                          Best  Offers

                        </v-btn>
                        <v-btn
                            outlined
                            color="indigo"
                            rounded>
                            SHOW ALL
                            <v-icon
                                right
                                dark>
                                mdi-all-inclusive
                            </v-icon>
                        </v-btn>
                    </v-container>

                </v-row>
                <topSellerCollection></topSellerCollection>

            </v-col>
        </v-row>
        <!-- end -->
        <!-- start -->
        <v-row>
            <v-col cols="12">
                <v-row>
                    <v-container class="d-flex justify-space-between align-center">
                        <v-btn
                            x-large
                            text>
                            <v-icon
                                left
                                dark>
                                mdi-format-list-numbered-rtl
                            </v-icon>

                            tOP SELLERS

                        </v-btn>
                        <v-btn
                            outlined
                            color="indigo"
                            rounded>
                            SHOW ALL
                            <v-icon
                                right
                                dark>
                                mdi-all-inclusive
                            </v-icon>
                        </v-btn>
                    </v-container>

                </v-row>
                <topSellerCollection></topSellerCollection>

            </v-col>
        </v-row>
        <!-- end -->
    </layout>

</div>
</template>

<script>
import layout from '@/components/default/app.vue';
import topCarousel from './_internal/topCarousel';
import discountSlider from './_internal/discountSlider';
import topSellerCollection from './_internal/topSellerCollection'

export default {
    name: "Home",
    components: {

        layout,
        topCarousel,
        discountSlider,
        topSellerCollection

    },

}
</script>

<style lang="scss" scoped>

</style>
