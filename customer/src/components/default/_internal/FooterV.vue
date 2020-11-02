<template>
<v-row no-gutter class="d-flex justify-space-around">
    <v-col
        cols="12"
        class="e-reputation-col">
        <messageSlider :items="messages"></messageSlider>

    </v-col>
    <!-- start -->
    <v-col
        cols="12"
        md="4"
        lg="3">

        <v-card
            class="mx-auto"
            flat>
            <v-img :src="contact.logo">
            </v-img>
            <v-list dense>
                <v-list-item-group>
                    <!-- start -->
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-map-marker</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="contact.address"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <!-- end -->
                    <!-- start -->
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-map-marker</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="contact.country"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <!-- end -->
                    <!-- start -->
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-email</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="contact.email"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <!-- end -->
                    <!-- start -->
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-phone</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="contact.phone"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <!-- end -->
                </v-list-item-group>
            </v-list>
        </v-card>
    </v-col>
    <!-- end -->
    <!-- start -->
    <v-col
        cols="12"
        lg="3" class="d-none d-sm-flex">
        <v-card
            class="mx-auto"
            flat>
            <v-card-title primary-title>
                {{resource.footerLinks.firstColumn.title}}
            </v-card-title>

            <v-list dense>
                <v-list-item-group>
                    <!-- start -->
                    <v-list-item
                        v-for="(item,index) in resource.footerLinks.firstColumn.fields"
                        :key="index"
                        :href="item.link.path">

                        <v-list-item-content>
                            <v-list-item-title v-text="item.link.title"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <!-- end -->

                </v-list-item-group>
            </v-list>
        </v-card>
    </v-col>
    <!-- end -->
    <!-- start -->
    <!-- start -->
    <v-col
        cols="12"
        lg="3" class="d-none d-sm-flex">
        <v-card
            class="mx-auto"
            flat>
            <v-card-title primary-title>
                {{resource.footerLinks.secondColumn.title}}
            </v-card-title>

            <v-list dense>
                <v-list-item-group>
                    <!-- start -->
                    <v-list-item
                        v-for="(item,index) in resource.footerLinks.secondColumn.fields"
                        :key="index"
                        :href="item.link.path">

                        <v-list-item-content>
                            <v-list-item-title v-text="item.link.title"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <!-- end -->

                </v-list-item-group>
            </v-list>
        </v-card>
    </v-col>
    <!-- end -->
    <!-- start -->
    <!-- start -->
    <v-col
        cols="12"
        lg="3" class="d-none d-sm-flex">
        <v-card
            class="mx-auto"
            flat>
            <v-card-title primary-title>
                {{resource.footerLinks.thirdColumn.title}}
            </v-card-title>

            <v-list dense>
                <v-list-item-group>
                    <!-- start -->
                    <v-list-item
                        v-for="(item,index) in resource.footerLinks.thirdColumn.fields"
                        :key="index"
                        :href="item.link.path">

                        <v-list-item-content>
                            <v-list-item-title v-text="item.link.title"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <!-- end -->

                </v-list-item-group>
            </v-list>
        </v-card>
    </v-col>
    <!-- end -->

    <!-- start -->
    <v-col
        cols="12"
        lg="3">
        <v-card
            class="mx-auto"
            flat>
            <v-card-title primary-title>
                Available Payment Options
            </v-card-title>

            <v-list dense>
                <v-list-item-group>
                    <!-- start -->
                    <v-list-item
                        v-for="(item,index) in resource.payments.paymentMethods"
                        :key="index"
                        :href="item.link.path">

                        <v-list-item-icon>
                            <img max-height="40" :src="item.image" />

                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title v-text="item.link.title"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <!-- end -->

                </v-list-item-group>
            </v-list>
        </v-card>
    </v-col>
    <!-- end -->
    <!-- start -->
    <v-col
        cols="12"
        lg="3">
        <v-card
            class="mx-auto"
            flat>
            <v-card-title primary-title>
                Follow us
            </v-card-title>

            <v-list dense>
                <v-list-item-group>
                    <!-- start -->
                    <v-list-item
                        v-for="(item,index) in resource.footerSocialLinks"
                        :key="index"
                        :href="item.link.path">

                        <v-list-item-icon>
                            <v-icon>
                                {{ item.icon}}
                            </v-icon>

                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title v-text="item.link.title"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <!-- end -->

                </v-list-item-group>
            </v-list>
        </v-card>
    </v-col>
    <!-- end -->
    <!-- start -->
    <v-col cols="12"></v-col>
    <!-- end -->
    <!-- start -->
    <v-col cols="12" class="text-center">
        {{resource.bottomFooter.secondLine}}
        {{resource.bottomFooter.copyright1}}
    </v-col>
    <!-- end -->

</v-row>
</template>

<script>
import footer from './js/footer';
import messageSlider from './_footerInternal/messageSlider.vue';
export default {
    components: {
        messageSlider
    },

    props: {

    },
    data() {
        return {
            resource: {},
            messages: [{
                    "title": "FREE SHIPPING",
                    "text": "Free shipping on all US order or order above $100",
                    "icon": "mdi-cart-plus"
                },
                {
                    "title": "SUPPORT 24/7",
                    "text": "Contact us 24 hours a day, 7 days a week",
                    "icon": "mdi-face-agent"
                },
                {
                    "title": "30 DAYS RETURN",
                    "text": "Simply return it within 30 days for an exchange.",
                    "icon": "mdi-clipboard-arrow-left"
                },
                {
                    "title": "100% PAYMENT SECURE",
                    "text": "We ensure secure payment with PEV",
                    "icon": "mdi-shield-account"
                }
            ],
            contact: {
                "logo": './assets/logo.png',
                "address": "184 Main Rd E, St Albans VIC 3021",
                "country": "Australia",
                "email": "saif@mbazar.com",
                "phone": "018838839595",
                "socials": {

                }
            },
        }
    },
    created() {
        this.resource = footer;
    }
}
</script>

<style lang="scss" scoped>
.e-reputation-col {
    background-color: #e0e0e0;

    .v-item-group {
        box-sizing: border-box;
        background-color: #e0e0e0;

        -webkit-box-shadow: 0px 0px 0px 7px #000000;
        box-shadow: 0px 0px 0px 7px #000000;
    }

}
</style>
