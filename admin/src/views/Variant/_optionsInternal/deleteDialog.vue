<template>

    <v-dialog
        v-model="dialog"
        persistent
        max-width="290">
        <template v-slot:activator="{ on, attrs }">

            <v-btn
                v-bind="attrs"
                v-on="on"
                fab
                color="pink"
                small
                @click="deleteItem(item)">
                <v-icon>
                    mdi-delete
                </v-icon>
            </v-btn>
        </template>
        <v-card>
            <v-card-title class="headline">
                Use Google's location service?
            </v-card-title>
            <v-card-text>Let Google help apps determine location. This means sending anonymous location data to Google, even when no apps are running.</v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="green darken-1"
                    text
                    @click="dialog = false">
                    Disagree
                </v-btn>
                <v-btn
                    color="green darken-1"
                    text
                    @click="dialog = false">
                    Agree
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

</template>

<script>
export default {
    data() {
        return {
            dialog: false,
        }
    },
}
</script>
