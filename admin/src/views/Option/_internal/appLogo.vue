<template>

        <vo ref="editProfile" v-slot="{ handleSubmit }">
            <!-- start overly -->
    <v-overlay :absolute="true" :value="overlay">
        <v-progress-circular indeterminate size="100" color="primary"></v-progress-circular>
    </v-overlay>
    <!-- end overly -->
            <v-form @submit.prevent="handleSubmit(editProfile)">
                <v-row>
                    <v-col cols="12">

                        <div class="d-flex flex-column justify-space-between align-center">

                            

                            <v-img :aspect-ratio="16/9" :width="200" v-if="$store.state.user.image" :src="$store.state.user.image"></v-img>
                            <v-icon size="200" color="green darken-2" v-else>
                                mdi-image
                            </v-icon>
                        </div>

                    </v-col>

                    <v-col cols="12">
                        <vp v-slot="{ errors }" vid="image" name="app Logo" rules="required|image">
                            <v-file-input v-model="file" :error-messages="errors" 
                            color="deep-purple accent-4" counter label="App Logo input" placeholder="Select your files" prepend-icon="mdi-paperclip" outlined :show-size="1000">
                                <template v-slot:selection="{ index, text }">
                                    <v-chip v-if="index < 2" color="deep-purple accent-4" dark label small>
                                        {{ text }}
                                    </v-chip>

                                    <span v-else-if="index === 2" class="overline grey--text text--darken-3 mx-2">
                                        +{{ file.length - 2 }} File(s)
                                    </span>
                                </template>
                            </v-file-input>
                        </vp>
                    </v-col>

                    <v-spacer></v-spacer>
                    <v-col class="d-flex ml-auto" cols="12" sm="3" xsm="12">
                        <v-btn block color="success" type="submit">Change</v-btn>
                    </v-col>
                </v-row>
            </v-form>
        </vo>
   
</template>

<script>
import {
    axios,
    vErrors
} from '@/plugins/axios'

export default {
    data: () => ({

        file: null,

        overlay: false,

        show1: false,

    }),
    methods: {
        async editProfile() {

            const d = new FormData();
            d.append('image', this.file);
            d.append('_method', 'PUT');

            this.overlay = true;

            try {
                const {
                    data
                } = await axios.post('/update-thumb', d);

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
