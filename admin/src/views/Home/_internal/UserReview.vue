<template>
<div>
    <!-- start overly -->
    <v-overlay :absolute="true" :value="overlay">
        <v-progress-circular indeterminate size="100" color="primary"></v-progress-circular>
    </v-overlay>
    <!-- end overly -->
    <v-card class="mb-12" color="lighten-1">

        <v-card-text v-if="user">
            <v-container fluid>
                <v-data-iterator :items="[user]" :items-per-page.sync="itemsPerPage" hide-default-footer>
                    <template v-slot:header>
                        <v-toolbar class="mb-2" dark flat>
                            <v-toolbar-title>Review User</v-toolbar-title>
                        </v-toolbar>
                    </template>

                    <template v-slot:default="props">
                        <v-row>
                            <v-col v-for="item in props.items" :key="item.name" cols="12">
                                <v-card>
                                    <v-card-title class="subheading font-weight-bold">
                                        {{ item.name }}
                                    </v-card-title>

                                    <v-divider></v-divider>

                                    <v-list dense>
                                        <v-list-item>
                                            <v-list-item-content>Email:</v-list-item-content>
                                            <v-list-item-content class="align-end">
                                                {{ item.email }}
                                            </v-list-item-content>
                                        </v-list-item>

                                        <v-list-item>
                                            <v-list-item-content>rule:</v-list-item-content>
                                            <v-list-item-content class="align-end">
                                                {{ rule }}
                                            </v-list-item-content>
                                        </v-list-item>

                                        <v-list-item>
                                            <v-list-item-content>password:</v-list-item-content>
                                            <v-list-item-content class="align-end">
                                                {{ item.password }}
                                            </v-list-item-content>
                                        </v-list-item>

                                        <v-list-item>
                                            <v-list-item-content>Password Confirm:</v-list-item-content>
                                            <v-list-item-content class="align-end">
                                                {{ item.password_confirmation}}
                                            </v-list-item-content>
                                        </v-list-item>

                                    </v-list>
                                </v-card>
                            </v-col>
                        </v-row>
                    </template>

                </v-data-iterator>
            </v-container>
        </v-card-text>

    </v-card>
    <v-btn color="primary" @click="$emit('click')">
        ADD User
    </v-btn>

    <v-btn text @click="$emit('back',true)">
        Back
    </v-btn>
</div>
</template>

<script>
export default {
    props: {
        user: {
            required: true,

        },
        rule: {
            required: true,
            type: String
        },
        overlay: {
            required: true,
            type: Boolean
        }
    },
    data: () => ({
        itemsPerPage: 1,

    }),
}
</script>
