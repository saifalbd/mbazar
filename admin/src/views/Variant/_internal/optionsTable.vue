<template>
<v-simple-table class="mt-2 mb-2">
    <deleteConfim
            v-model="dialogDelete"
            @confirm="deleteConfim"></deleteConfim>
    <template v-slot:default>
        <thead>
            <tr>
                <th class="text-left">
                    serial
                </th>

                <th class="text-left">
                    title
                </th>
                <th class="text-left">
                    action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="(item,index) in items"
                :key="index">
                <td>{{ item.id }}</td>
                <td>{{ item.title }}</td>
                <td>


                     <edit :item="item">
                    <template v-slot:activator="{ on }">
                        <v-btn
                            icon
                            color="indigo"
                            small
                            @click="on">
                            <v-icon>
                                mdi-pencil
                            </v-icon>
                        </v-btn>
                    </template>
                </edit>

                <v-btn
                    icon
                    color="pink"
                    small
                    @click="deleteItem(item)">
                    <v-icon>
                        mdi-delete
                    </v-icon>
                </v-btn>
                </td>

            </tr>

        </tbody>
    </template>
</v-simple-table>
</template>

<script>
import deleteConfim from '@/components/deleteConfirm.vue';

export default {
    components: {
        deleteConfim
    },
    props: {
        items: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            dialogDelete: false,
            
            
        }

    },

    computed: {

    },
    methods: {
deleteConfim(){

}
    }
}
</script>
