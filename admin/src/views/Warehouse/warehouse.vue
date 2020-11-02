<template>
  <div class="home">
    <!-- <img alt="Vue logo" src="../assets/logo.png"> -->
    <app>
    <ETable @item="editItem"/>
   
    <addEdit  v-model="add" />
    <addEdit  v-model="edit" :item="editedItem"/>
    <addCircle @click="add=$event"/>
    </app>
  </div>
</template>

<script>
// @ is an alias to /src
import ETable from './_internal/table.vue';
import addEdit from './_internal/addEdit.vue';

import addCircle from '@/components/addCircle.vue';
import app from '@/components/app.vue';
import { mdiWatermark } from '@mdi/js';
export default {
  name: 'category',
  components: {
   ETable,addCircle,addEdit ,app
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
          text: 'Warehouse',
          disabled: false,
          href: '/warehouse',
        }
        ]);
        this.$store.commit('pageTitle','Warehouse Page');
        this.$store.commit('pageIcon',mdiWatermark);
        /*end default config*/
  }
}
</script>
