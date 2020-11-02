<template>
  <div class="home">
    <!-- <img alt="Vue logo" src="../assets/logo.png"> -->
    <app>
    <ETable @item="editItem"/>
    <add v-model="add" />
    <edit v-model="edit" :item="editedItem"/>
    <addCircle @click="add=$event"/>
    </app>
  </div>
</template>

<script>
// @ is an alias to /src
import ETable from './_internal/table.vue';
import add from './_internal/add.vue';
import edit from './_internal/edit.vue';
import addCircle from '@/components/addCircle.vue';
import app from '@/components/app.vue';
import { mdiWatermark } from '@mdi/js';
export default {
  name: 'category',
  components: {
   ETable,add,addCircle,edit,app
  },
  data(){
      return {
          add:false,
          edit:false,
          editedItem:{}
      }
  },
  methods:{
    editItem(item){
      this.edit = true;
      this.editedItem = item;
    }
  },
  created(){
    /*start default config*/
          this.$store.commit("bread", [ {
          text: 'Brand',
          disabled: false,
          href: '/brands',
        }
        ]);
        this.$store.commit('pageTitle','Brand Page');
        this.$store.commit('pageIcon',mdiWatermark);
        /*end default config*/
  }
}
</script>
