<template>
<v-stepper v-model="e1">

    <div class="text-center">
        <v-dialog v-model="dialog" width="500">

            <v-card>
                <v-card-title class="headline" color="error">
                    Validation Errors
                </v-card-title>

                <v-card-text class="pt-5">
                    <v-alert type="error" v-for="e in errors" :key="e">
                        {{e}}
                    </v-alert>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="dialog = false">
                       Close
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>

    <v-stepper-header>
        <v-stepper-step :complete="e1 > 1" step="1">
            Create User
        </v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :complete="e1 > 2" step="2">
            Add Rules
        </v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step step="3">
            Review User
        </v-stepper-step>
    </v-stepper-header>

    <v-stepper-items>
        <v-stepper-content step="1">
            <createUser @click="userClick"></createUser>
        </v-stepper-content>
        <v-stepper-content step="2">

            <user-rule :user="userData" @click="ruleClick" @back="backRule"></user-rule>
        </v-stepper-content>
        <v-stepper-content step="3">
            <user-review :overlay="overlay" :user="userData" :rule="userRule" @click="reviewSubmit" @back="backReview"></user-review>

        </v-stepper-content>
    </v-stepper-items>
</v-stepper>
</template>

<script>
import createUser from './CreateUser.vue';
import userRule from './UserRule.vue';
import userReview from './UserReview.vue';
import {
    axios,
    vErrors
} from '@/plugins/axios';
export default {
    components: {
        createUser,
        userRule,
        userReview
    },
    data() {
        return {
            e1: 1,
            userData: null,
            userRule: '',
            overlay: false,
            dialog: false,
            errors: []
        }
    },
    methods: {
        userClick(data) {
            this.e1 = 2;
            this.userData = data;

        },
        ruleClick(rule) {
            this.e1 = 3;
            this.userRule = rule;
        },
        backRule() {
            this.userData = null;

            this.e1 = 1;
        },
        backReview() {

            this.userRule = null;
            this.e1 = 2;

        },
        async reviewSubmit() {
            const d = this.userData;
            d.has = this.userRule;

            this.overlay = true;

            try {
                const {
                    data
                } = await axios.post('/register', d);

                this.e1 = 1;

            } catch (e) {
                if (e.response.status == 422) {
                    this.errors = Object.values(e.response.data.errors).map(i => i[0]);
                    this.dialog = true;

                    // vErrors.apply(this, [e.response.data, 'registerForm']);
                }
            }
            this.overlay = false;
        }
    }
}
</script>
