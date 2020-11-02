<template>
<v-card elevation="2">
    <!-- start overly -->
    <v-overlay :absolute="true" :value="overlay">
        <v-progress-circular indeterminate size="100" color="primary"></v-progress-circular>
    </v-overlay>
    <!-- end overly -->
    <v-card-text>
        <vo ref="editProfile" v-slot="{ handleSubmit }">
            <v-form @submit.prevent="handleSubmit(editProfile)">
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <vp v-slot="{ errors }" vid="firstName" name="firstName" rules="required|max:50">
                            <v-text-field v-model="firstName" :error-messages="errors" label="First Name" maxlength="20" required></v-text-field>
                        </vp>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <vp v-slot="{ errors }" vid="lastName" name="lastName" rules="required|max:50">
                            <v-text-field v-model="lastName" :error-messages="errors" label="Last Name" maxlength="20" required></v-text-field>
                        </vp>
                    </v-col>
                    <v-col cols="12">
                        <vp v-slot="{ errors }" vid="email" name="E-mail" rules="required|email">
                            <v-text-field v-model="email" :error-messages="errors" label="E-mail" required></v-text-field>
                        </vp>
                    </v-col>

                    <v-spacer></v-spacer>
                    <v-col class="d-flex ml-auto" cols="12" sm="3" xsm="12">
                        <v-btn block color="success" type="submit">Edit</v-btn>
                    </v-col>
                </v-row>
            </v-form>
        </vo>
    </v-card-text>
</v-card>
</template>

<script>
import {
    axios,
    vErrors
} from '@/plugins/axios'
export default {
    data: () => ({

        firstName: "",
        lastName: "islam",
        email: "",
        password: "12345678",

        overlay: false,

        show1: false,

    }),
    methods: {
        async editProfile() {

            let d = {
                firstName: this.firstName,
                lastName: this.lastName,
                email: this.email
            }

            this.overlay = true;

            try {
                const {
                    data
                } = await axios.put('/update-profile', d);

                this.addData(data.data);
                 this.$store.commit('setUser', data.data);

                this.dialog = false

            } catch (e) {
                if (e.response.status == 422) {
                    vErrors.apply(this, [e.response.data, 'editProfile']);
                }
            }
            this.overlay = false;

        },
        addData(user) {
            let {
                first_name,
                last_name,
                email
            } = user;
            this.firstName = first_name;
            this.lastName = last_name;
            this.email = email;
        }
    },
    created() {
        this.addData(this.$store.state.user);

    }
}
</script>

<style lang="scss" scoped>

</style>
