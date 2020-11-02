<template>
        <v-row class="search-row" :style="`height:${rowHeight}px`">
                          <v-menu offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
         text
         :height="height"
          v-bind="attrs"
          v-on="on"
        >
        <v-icon left>mdi-menu</v-icon>
          <span class="d-none d-sm-flex">
              All Categories
          </span>
          <v-icon right>mdi-menu-down</v-icon>
        </v-btn>
      </template>
      <v-list>
        <v-list-item
          v-for="(item, index) in items"
          :key="index"
        >
          <v-list-item-title>{{ item }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
                        <v-text-field
                        background-color="white"
                         v-model="message" dense filled hide-details
                         placeholder="search products"
                         clear-icon="mdi-close-circle" clearable type="text" 
                         @click:clear="clearMessage"></v-text-field>
                        <v-btn :height="height">
                            <v-icon>mdi-magnify</v-icon>
                        </v-btn>

                    </v-row>
                   
</template>

<script>
export default {
    data() {
        return {
            height:40,
            rowHeight:44,
            items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
            message: '',
            
       }
    },
    computed: {
        
    },
    methods: {
        
        sendMessage() {
            this.resetIcon()
            this.clearMessage()
        },
        clearMessage() {
            this.message = ''
        },
        
       
    },

}
</script>

<style lang="scss" scoped>
.search-row{
    border: 2px solid black;
    
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
