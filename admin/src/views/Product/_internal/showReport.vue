<template>
<v-simple-table class="mt-2 mb-2">
    <template v-slot:default>
        <thead>
            <tr>
                <th class="text-left">
                    Stocks Quantites
                </th>
                <th class="text-left">
                    sale Quantites
                </th>
                <th class="text-left">
                    sale Amount
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>5522</td>
                <td>5522</td>
                <td>5522</td>
            </tr>

        </tbody>
    </template>
</v-simple-table>
</template>

<script>
import editPrice from './_tableInternal/editPrice.vue'
export default {
    components: {
        editPrice
    },
    props: {
        item: {
            type: [Object, null],
            required: true
        }
    },
    data() {
        return {

        }
    },
}
</script>
