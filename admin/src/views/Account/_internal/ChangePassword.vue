<template>
<v-card elevation="2">
    <!-- start overly -->
    <v-overlay :absolute="true" :value="overlay">
        <v-progress-circular indeterminate size="100" color="primary"></v-progress-circular>
    </v-overlay>
    <!-- end overly -->
    <v-card-text>
        <vo ref="changePasswordFrom" v-slot="{ handleSubmit }">
            <v-form @submit.prevent="handleSubmit(changePassword)">
                <v-row>
                    <v-col cols="12">
                        <vp v-slot="{ errors }" vid="oldPassword" name="old password" rules="required">
                            <v-text-field v-model="oldPassword" 
                            :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'" 
                            :error-messages="errors" :type="show1 ? 'text' : 'password'" name="input-10-1" label="Old Password" hint="At least 8 characters" counter @click:append="show1 = !show1"></v-text-field>
                        </vp>
                    </v-col>
                    <v-col cols="12">
                        <vp v-slot="{ errors }" vid="password" name="password" rules="required">
                            <v-text-field v-model="password" 
                            :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'" 
                            :error-messages="errors" 
                            name="input-10-1" label="New Password" hint="At least 8 characters" 
                            :type="show1 ? 'text' : 'password'" 
                            counter @click:append="show1 = !show1"></v-text-field>
                        </vp>
                    </v-col>
                    <v-col cols="12">
                        <vp v-slot="{ errors }" vid="password_confirmation" name="password_confirmation" rules="required">
                            <v-text-field block v-model="password_confirmation" :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'" :error-messages="errors" :type="show1 ? 'text' : 'password'" name="input-10-1" label="Confirm New Password" counter @click:append="show1 = !show1"></v-text-field>
                        </vp>
                    </v-col>
                    <v-spacer></v-spacer>
                    <v-col class="d-flex ml-auto" cols="12" sm="3" xsm="12">
                        <v-btn block color="success" type="submit">Change</v-btn>
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

        password: "12345678",
        password_confirmation: '12345678',
        oldPassword: '12345678',

        overlay: false,

        show1: true,

    }),
    methods: {
       async changePassword() {
            let d = {
                password: this.password,
                password_confirmation: this.password_confirmation,
                oldPassword: this.oldPassword
            }

             this.overlay = true;

            try {
                const {
                    data
                } = await axios.put('/update-password', d);

                
                 this.$store.commit('setUser', data.data);
                

                 this.$store.commit('clearUserData');

                

            } catch (e) {
                if (e.response.status == 422) {
                    vErrors.apply(this, [e.response.data, 'changePasswordFrom']);
                }
            }
            this.overlay = false;
            

        }
    },
}
</script>

<style lang="scss" scoped>

</style>
