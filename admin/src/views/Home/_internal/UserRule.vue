<template>
<div>
    <vo v-slot="{ handleSubmit }">
        <v-form @submit.prevent="handleSubmit(addRule)">
            <v-card class="mb-12" color="lighten-1">
                <v-card-title v-if="user">{{user.name}}</v-card-title>

                <v-card-text>

                    <v-row>

                        <v-col cols="12">
                            <vp v-slot="{ errors }" vid="rule" name="Rule" rules="required">
                                <v-select :items="rules" v-model="rule" :error-messages="errors" label="User Rule"></v-select>
                            </vp>
                        </v-col>

                    </v-row>

                </v-card-text>

            </v-card>

            <v-btn color="primary" type="submit">
                Continue
            </v-btn>

            <v-btn text @click="$emit('back',true)">
                Back
            </v-btn>
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
    props: {
        user: {
            required: true,

        }

    },
    data() {
        return {

            rules: [
                'Super Admin',
"Admin",
"Standard User",
"Normal User",
"Sales",
"Delivery",
'Auditor',
            ],
            rule: 'Standard User'
        }
    },
    computed: {

    },
    methods: {
        addRule() {
            this.$emit('click', this.rule);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
