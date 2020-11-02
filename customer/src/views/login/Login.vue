<template>
<v-app id="inspire">
    <v-dialog
        v-model="dialog"
        persistent
        max-width="600px"
        min-width="360px">
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
        <div>
            <v-tabs
                v-model="tab"
                show-arrows
                background-color="deep-purple accent-4"
                icons-and-text
                dark
                grow>
                <v-tabs-slider color="purple darken-4"></v-tabs-slider>
                <v-tab
                    v-for="(i,index) in tabs"
                    :key="index">
                    <v-icon large>{{ i.icon }}</v-icon>
                    <div class="caption py-1">{{ i.name }}</div>
                </v-tab>
                <v-tab-item>
                    <v-card class="px-4">
                        <v-card-text>
                            <vo
                                ref="loginForm"
                                v-slot="{ handleSubmit }">
                                <v-form @submit.prevent="handleSubmit(onLogin)">
                                    <v-row>
                                        <v-col cols="12">
                                            <vp
                                                v-slot="{ errors }"
                                                vid="loginEmail"
                                                name="E-mail"
                                                rules="required|email">
                                                <v-text-field
                                                    v-model="loginEmail"
                                                    :error-messages="errors"
                                                    label="E-mail"
                                                    required></v-text-field>
                                            </vp>
                                        </v-col>
                                        <v-col cols="12">
                                            <vp
                                                v-slot="{ errors }"
                                                vid="loginPassword"
                                                name="password"
                                                rules="required">

                                                <v-text-field
                                                    v-model="loginPassword"
                                                    :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                                    :error-messages="errors"
                                                    :type="show1 ? 'text' : 'password'"
                                                    name="input-10-1"
                                                    label="Password"
                                                    hint="At least 8 characters"
                                                    counter
                                                    @click:append="show1 = !show1"></v-text-field>

                                            </vp>
                                        </v-col>
                                        <v-col
                                            class="d-flex"
                                            cols="12"
                                            sm="6"
                                            xsm="12">
                                        </v-col>
                                        <v-spacer></v-spacer>
                                        <v-col
                                            class="d-flex"
                                            cols="12"
                                            sm="3"
                                            xsm="12"
                                            align-end>
                                            <v-btn
                                                x-large
                                                block
                                                color="success"
                                                type="submit"> Login </v-btn>
                                        </v-col>
                                    </v-row>
                                </v-form>
                            </vo>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card class="px-4">
                        <v-card-text>
                            <vo
                                ref="registerForm"
                                v-slot="{ handleSubmit }">
                                <v-form @submit.prevent="handleSubmit(register)">
                                    <v-row>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                            md="6">
                                            <vp
                                                v-slot="{ errors }"
                                                vid="firstName"
                                                name="firstName"
                                                rules="required|max:50">
                                                <v-text-field
                                                    v-model="firstName"
                                                    :error-messages="errors"
                                                    label="First Name"
                                                    maxlength="20"
                                                    required></v-text-field>
                                            </vp>
                                        </v-col>
                                        <v-col
                                            cols="12"
                                            sm="6"
                                            md="6">
                                            <vp
                                                v-slot="{ errors }"
                                                vid="lastName"
                                                name="lastName"
                                                rules="required|max:50">
                                                <v-text-field
                                                    v-model="lastName"
                                                    :error-messages="errors"
                                                    label="Last Name"
                                                    maxlength="20"
                                                    required></v-text-field>
                                            </vp>
                                        </v-col>
                                        <v-col cols="12">
                                            <vp
                                                v-slot="{ errors }"
                                                vid="email"
                                                name="E-mail"
                                                rules="required|email">
                                                <v-text-field
                                                    v-model="email"
                                                    :error-messages="errors"
                                                    label="E-mail"
                                                    required></v-text-field>
                                            </vp>
                                        </v-col>
                                        <v-col cols="12">
                                            <vp
                                                v-slot="{ errors }"
                                                vid="password"
                                                name="password"
                                                rules="required">
                                                <v-text-field
                                                    v-model="password"
                                                    :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                                    :error-messages="errors"
                                                    :type="show1 ? 'text' : 'password'"
                                                    name="input-10-1"
                                                    label="Password"
                                                    hint="At least 8 characters"
                                                    counter
                                                    @click:append="show1 = !show1"></v-text-field>

                                            </vp>
                                        </v-col>
                                        <v-col cols="12">
                                            <vp
                                                v-slot="{ errors }"
                                                vid="password_confirmation"
                                                name="password_confirmation"
                                                rules="required">
                                                <v-text-field
                                                    block
                                                    v-model="password_confirmation"
                                                    :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                                    :error-messages="errors"
                                                    :type="show1 ? 'text' : 'password'"
                                                    name="input-10-1"
                                                    label="Confirm Password"
                                                    counter
                                                    @click:append="show1 = !show1"></v-text-field>
                                            </vp>
                                        </v-col>
                                        <v-spacer></v-spacer>
                                        <v-col
                                            class="d-flex ml-auto"
                                            cols="12"
                                            sm="3"
                                            xsm="12">
                                            <v-btn
                                                x-large
                                                block
                                                color="success"
                                                type="submit">Register</v-btn>
                                        </v-col>
                                    </v-row>
                                </v-form>
                            </vo>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
            </v-tabs>
        </div>
    </v-dialog>
</v-app>
</template>

<script>
import {
    axiosWithoutToken,
    vErrors
} from '@/plugins/axios';
export default {

    computed: {
        passwordMatch() {
            return () => this.password === this.verify || "Password must match";
        }
    },
    data: () => ({
        dialog: true,
        tab: 0,
        tabs: [{
                name: "Login",
                icon: "mdi-account"
            },
            {
                name: "Register",
                icon: "mdi-account-outline"
            }
        ],
        valid: true,

        firstName: "saiful",
        lastName: "islam",
        email: "sami@gmail.com",
        password: "12345678",
        verify: "",
        password_confirmation: '12345678',
        loginPassword: "12345679",
        loginEmail: "sami1@gmail.com",
        overlay: false,

        show1: false,

    }),
    methods: {
        async onLogin() {

            this.overlay = true;
            const credentials = {
                loginPassword: this.loginPassword,
                loginEmail: this.loginEmail
            };

            try {
                const {
                    data
                } = await axiosWithoutToken.post('/login', credentials)
                this.$store
                    .dispatch('login', data.data);

                this.$router.push({
                    name: 'Home'
                })

            } catch (e) {
                if (e.response.status == 422) {
                    vErrors.apply(this, [e.response.data, 'loginForm']);

                }

            }
            this.overlay = false;

        },
        async register() {
            const d = {
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                firstName: this.firstName,
                lastName: this.lastName
            }

            this.overlay = true;

            try {
                const {
                    data
                } = await axiosWithoutToken.post('/register', d);
                this.tab = 0;

            } catch (e) {
                if (e.response.status == 422) {
                    vErrors.apply(this, [e.response.data, 'registerForm']);
                }
            }
            this.overlay = false;

        },
        validate() {
            if (this.$refs.loginForm.validate()) {
                // submit form to server/API here...
            }
        },
        reset() {
            this.$refs.form.reset();
        },
        resetValidation() {
            this.$refs.form.resetValidation();
        }
    },
    created() {
       if ( this.$store.getters.isLogin) {
           alert('login')
       }
      

    }

}
</script>

<style>

</style>
