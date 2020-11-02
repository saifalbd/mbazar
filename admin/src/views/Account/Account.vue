<template>
<div class="home">
    <app>
        <template>
            <v-card>
                <!-- <v-toolbar
      flat
      color="primary"
      dark
    >
      <v-toolbar-title>User Profile</v-toolbar-title>
    </v-toolbar> -->
                <v-tabs dark vertical>
                    <v-tab>
                        <v-icon left>
                            mdi-account
                        </v-icon>
                        My Profile
                    </v-tab>
                    <v-tab>
                        <v-icon left>
                            mdi-lock
                        </v-icon>
                        Change Password
                    </v-tab>
                    <v-tab>
                        <v-icon left>
                             mdi-image
                        </v-icon>
                        Thumb Change
                    </v-tab>

                    <v-tab-item>
                        <v-card flat>
                            <v-card-text>
                                <change-profile></change-profile>
                            </v-card-text>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card flat>
                            <v-card-text>
                                <change-password></change-password>
                            </v-card-text>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card flat>
                            <v-card-text>
                               <change-thumb></change-thumb>
                            </v-card-text>
                        </v-card>
                    </v-tab-item>
                </v-tabs>
            </v-card>
        </template>

    </app>
</div>
</template>

<script>
// @ is an alias to /src

import app from '@/components/app.vue';
import {
   mdiAccount
} from '@mdi/js';
import ChangeProfile from './_internal/ChangeProfile.vue';
import ChangePassword from './_internal/ChangePassword.vue';
import ChangeThumb from './_internal/ChangeThumb.vue';
export default {
    name: 'account',
    components: {
        app,
        ChangeProfile,ChangePassword,ChangeThumb
    },
    data() {
        return {
            add: false,
            edit: false,
            editedItem: {}
        }
    },
    methods: {
        editItem(item) {
            this.edit = true;
            this.editedItem = item;
        }
    },
    created() {
        /*start default config*/
        this.$store.commit("bread", [{
            text: 'Account',
            disabled: false,
            href: '/accounts',
        }]);
        this.$store.commit('pageTitle', 'Account Page');
        this.$store.commit('pageIcon',mdiAccount);
        /*end default config*/
    }
}
</script>
