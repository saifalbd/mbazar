<template>
  <div class="product">
     <app>
    <!-- <img alt="Vue logo" src="../assets/logo.png"> -->
    <ETable @item="editItem" @show="showItem"/>
    <add v-model="add" />
    <edit v-model="edit" :item="editedItem"/>
    <addCircle @click="add=$event"/>
    <show v-model="show" :item="showedItem"></show>
     </app>
  </div>
</template>

<script>
// @ is an alias to /src
import ETable from './_internal/table.vue';
import add from './_internal/add.vue';
import edit from './_internal/edit.vue';
import addCircle from '@/components/addCircle.vue';
import show from './Show.vue';
import app from '@/components/app.vue';
import { mdiSitemap } from '@mdi/js';
export default {
  name: 'Product',
  components: {
   ETable,add,addCircle,edit,show,app
  },
  data(){
      return {
          add:false,
          edit:false,
          show:false,
          editedItem:{},
          showedItem:{},

      }
  },
  methods:{
    showItem(item){
      this.showedItem = item;
      this.show = true;
    },
    editItem(item){
      this.edit = true;
      this.editedItem = item;
    }
  },
  created(){
    /*start default config*/
          this.$store.commit("bread", [ {
          text: 'Product',
          disabled: false,
          href: '/products',
        }
        ]);
        this.$store.commit('pageTitle','Product Page');
        this.$store.commit('pageIcon',mdiSitemap);
        /*end default config*/
  }
}
</script>
