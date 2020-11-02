<template>
  <v-sheet
    class="mx-auto"
    elevation="8"
   
  >
    <v-slide-group
      v-model="model"
      class="pa-4"
      active-class="success"
      show-arrows
    >
    
      <v-slide-item
        v-for="(n,i) in items"
        :key="i"
        v-slot:default="{ active, toggle }"
      >
        <v-card
          :color="active ? undefined : 'grey lighten-1'"
          class="ma-1"
          height="200"
          width="250"
          @click="toggle"
        >
        <v-img height="100%" :src="n.src">

          </v-img>
          
        </v-card>
      </v-slide-item>
    </v-slide-group>
  </v-sheet>
</template>

<script>
  export default {
    data: () => ({
      model: null,
       items: [
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          },
           {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          },
           {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          },
           {
                src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
          },
           {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          },
           {
                src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
          },
           {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          },
           {
               src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
          },
           {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          },

        ],
    }),
  }
</script>