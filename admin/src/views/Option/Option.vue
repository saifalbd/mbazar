<template>
<app>
    <template>
        <v-card>
            <v-toolbar flat>
                <!-- <v-toolbar-title>User Profile</v-toolbar-title> -->
            </v-toolbar>
            <v-tabs :vertical="tabsVertical">
                <v-tab>
                    <v-icon left>
                        mdi-account
                    </v-icon>
                    app option
                </v-tab>
                <v-tab>
                    <v-icon left>
                        mdi-image
                    </v-icon>
                    app Logo
                </v-tab>
                <v-tab>
                    <v-icon left>
                        mdi-email-edit
                    </v-icon>
                    app Email
                </v-tab>
                <v-tab>
                    <v-icon left>
                        mdi-cash
                    </v-icon>
                    app Payment
                </v-tab>

                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <app-option></app-option>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <app-logo></app-logo>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <app-mail></app-mail>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <app-mail></app-mail>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
            </v-tabs>
        </v-card>
    </template>
</app>
</template>

<script>
import app from '@/components/app.vue';
import appOption from './_internal/appOption';
import appLogo from './_internal/appLogo';
import appMail from './_internal/appMail'
import {
    mdiAccount
} from '@mdi/js';

export default {
    name: 'account',
    components: {
        app,
        appOption,
        appLogo,
        appMail
    },
    data() {
        return {
            tabsVertical:false,
           
           
        }
    },
    created() {
        /*start default config*/
        this.$store.commit("bread", [{
            text: 'Option',
            disabled: false,
            href: '/options',
        }]);
        this.$store.commit('pageTitle', 'Option Page');
        this.$store.commit('pageIcon', mdiAccount);
        /*end default config*/
    }
}
</script>

<style lang="scss" scoped>

</style>
