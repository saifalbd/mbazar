<template>
<div>
    <vo v-slot="{ handleSubmit }">
                <v-form @submit.prevent="handleSubmit(register)">
    <v-card class="mb-12" color="lighten-1">

        <v-card-text>
            
                    <v-row>
                       
                        <v-col cols="12" >
                            <vp v-slot="{ errors }" vid="name" name="name" rules="required|max:50">
                                <v-text-field v-model="name" :error-messages="errors" label="Full Name" maxlength="20" required></v-text-field>
                            </vp>
                        </v-col>
                        <v-col cols="12">
                            <vp v-slot="{ errors }" vid="email" name="E-mail" rules="required|email">
                                <v-text-field v-model="email" :error-messages="errors" label="E-mail" required></v-text-field>
                            </vp>
                        </v-col>
                        <v-col cols="12">
                            <vp v-slot="{ errors }" vid="password" name="password" rules="required">
                                <v-text-field v-model="password" :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'" :error-messages="errors" :type="show1 ? 'text' : 'password'" name="input-10-1" label="Password" hint="At least 8 characters" counter @click:append="show1 = !show1"></v-text-field>
                            </vp>
                        </v-col>
                        <v-col cols="12">
                            <vp v-slot="{ errors }" vid="password_confirmation" name="password_confirmation" rules="required">
                                <v-text-field block v-model="password_confirmation" :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'" :error-messages="errors" :type="show1 ? 'text' : 'password'" name="input-10-1" label="Confirm Password" counter @click:append="show1 = !show1"></v-text-field>
                            </vp>
                        </v-col>
                       
                    </v-row>
               
        </v-card-text>

    </v-card>

    <v-btn color="primary" type="submit">
        Continue
    </v-btn>

    <!-- <v-btn text>
        Cancel
    </v-btn> -->
     </v-form>
            </vo>
</div>
</template>

<script>
import {
    axiosWithoutToken,
    vErrors
} from '@/plugins/axios';
export default {
    data(){
        return {
            
        name: "saiful",
        
        email: "sami@gmail.com",
        password: "12345678",
        verify: "",
        password_confirmation: '12345678',
        loginPassword: "12345679",
        loginEmail: "sami1@gmail.com",
        overlay: false,
        show1: true,
        }
    },
    computed:{
        user(){
            return this.$store.state.user;
        }
    },
    methods: {
        async register() {
            const d = {
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                name: this.name,
                
            }

            this.$emit('click',d)
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
