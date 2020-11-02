<template>
<div class="stock-item">

    <app>
        <!-- <img alt="Vue logo" src="../assets/logo.png"> -->
        <ETable @item="editItem" />
        <add v-model="add" />
        <edit
            v-model="edit"
            :item="editedItem" />
        <addCircle @click="add=$event" />
    </app>

</div>
</template>

<script>
// @ is an alias to /src

// @ is an alias to /src
import ETable from './_internal/table.vue';
import add from './_internal/add.vue';
import edit from './_internal/edit.vue';
import addCircle from '@/components/addCircle.vue';
import app from '@/components/app.vue';
import {
    mdiShape
} from '@mdi/js';
export default {
    name: 'stock',
    components: {
        ETable,
        add,
        addCircle,
        edit,
        app
    },
    data() {
        return {
             add: true,
            edit: false,
            editedItem: {},
           
        }
    },
    methods: {
        editItem(item) {
            this.edit = true;
            this.editedItem = item;
        }
    },
    created() {
        /*start default config*/
        this.$store.commit("bread", [{
            text: 'stockitem',
            disabled: false,
            href: '/stock-item',
        }]);
        this.$store.commit('pageTitle', 'stock Item Page');
        this.$store.commit('pageIcon', mdiShape);
        /*end default config*/
    }
}
</script>
