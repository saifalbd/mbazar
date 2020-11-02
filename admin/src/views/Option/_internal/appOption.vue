<template>
<v-form>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-text-field v-model="appName" @click:clear="appName=''" 
                label="App Name"
                 prepend-inner-icon="mdi-web-box"
                  outlined clear-icon="mdi-close-circle" 
                  clearable  type="text"  :disabled="readOnly" 
                  :error-messages="errors"
                  :append-icon="readOnly?'mdi-pencil-off':'mdi-pencil-outline'"></v-text-field>
            </v-col>
            <v-col cols="12">
                <vp v-slot="{ errors }" name="Name" rules="required">
                <v-text-field v-model="appTitle" 
                @click:clear="appTitle=''"  
                label="App Title" 
                prepend-inner-icon="mdi-format-title" 
                outlined 
                clear-icon="mdi-close-circle" clearable  
                type="text"  
                :disabled="readOnly" 
                :error-messages="errors"
                :append-icon="readOnly?'mdi-pencil-off':'mdi-pencil-outline'" ></v-text-field>
                </vp>
            </v-col>
             <v-col cols="12">
                <vp v-slot="{ errors }" name="Currency" rules="required">
                <v-select v-model="appCurrency" 
                @click:clear="appCurrency=''"  
                label="App Currency" 
                :items="['Taka','Usd']"
                prepend-inner-icon="mdi-currency-bdt" 
                outlined 
                clear-icon="mdi-close-circle" clearable  
                :disabled="readOnly" 
                :error-messages="errors"
                :append-icon="readOnly?'mdi-pencil-off':'mdi-pencil-outline'" ></v-select>
                </vp>
            </v-col>
             <v-spacer></v-spacer>
                    <v-col class="d-flex ml-auto" cols="12" sm="3" xs="12">
                        <v-btn block color="success" type="submit">add</v-btn>
                    </v-col>

        </v-row>
    </v-container>
</v-form>
</template>

<script>
export default {

    data: () => ({
        appName: '',
        appTitle:'',
        appCurrency:'',
        icons: {
            appName: false
        },
        password: 'Password',
        show: false,
        message: 'Hey!',
        marker: true,
        iconIndex: 0,
        readOnly: false,

    }),

    computed: {

    },

    methods: {
        toggleMarker() {
            this.icons.appName = !this.icons.appName
        },
        sendMessage() {
            this.resetIcon()
            this.clearMessage()
        },
        clearMessage() {
            this.message = ''
        },
        resetIcon() {
            this.iconIndex = 0
        },
        changeIcon() {
            this.iconIndex === this.icons.length - 1 ?
                this.iconIndex = 0 :
                this.iconIndex++
        },
    },

}
</script>

<style lang="scss" scoped>

</style>
