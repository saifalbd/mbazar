<template>
<v-icon small>{{ value?up:down }}</v-icon>
    
</template>
<script>
import { mdiMenuUp,mdiMenuDown  } from '@mdi/js';
  export default {
      props:['value'],
      data(){
          
          return{
              up:mdiMenuUp,
              down:mdiMenuDown
          }
      }
    
}
</script>