<template>
  
    <v-menu
      top
      :offset-x="offset"
    >
      <template v-slot:activator="{ on }">
          
          <slot name="activator" v-bind:on="on">

          </slot>
        
      </template>

      <v-list>
        <v-list-item
          v-for="(item, index) in items"
          :key="index"
        >
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  
</template>
<script>
  export default {
    data: () => ({
      items: [
        { title: 'Click Me' },
        { title: 'Click Me' },
        { title: 'Click Me' },
        { title: 'Click Me 2' },
      ],
      offset: true,
    }),
  }
</script>