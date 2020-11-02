<template>
<div class="home">
    <app>

       <e-table :collection="variants" />

        <!-- <img alt="Vue logo" src="../assets/logo.png"> -->

    </app>
</div>
</template>

<script>
// @ is an alias to /src
import ETable from './_internal/table.vue';
import optionsTable from './_internal/optionsTable.vue';

import addCircle from '@/components/addCircle.vue';
import app from '@/components/app.vue';
import {
    apiVariant,apiVariantOption
} from '@/api';
import {
    Variant,VariantOption
} from '@/models';
import {
    mdiShape
} from '@mdi/js';
export default {
    name: 'category',
    components: {
        ETable,
        optionsTable,
        addCircle,
        app
    },
    data() {
        return {

            tab: 2,
        }
    },
    computed: {
        variants() {
            // Fetch all post records.
            return Variant.all()
        }
        
    },
    methods: {
        editItem(item) {
            this.edit = true;
            this.editedItem = item;
        }
    },
  async  created() {

       await  apiVariant.index()
         
        /*start default config*/
        this.$store.commit("bread", [{
            text: 'Category',
            disabled: false,
            href: '/categories',
        }]);
        this.$store.commit('pageTitle', 'Category Page');
        this.$store.commit('pageIcon', mdiShape);
        /*end default config*/
    }
}
</script>
