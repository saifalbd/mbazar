<template>
<v-row justify="center">
    <v-dialog
        v-model="dialog"
       
        persistent
        transition="dialog-bottom-transition">

        <v-card>
            <v-toolbar
                dark
                dense
                color="primary">
                <v-btn
                    icon
                    dark
                    @click="dialog = false">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
                <v-toolbar-title>Add item</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn
                        dark
                        text
                        @click="dialog = false">
                        Save
                    </v-btn>
                </v-toolbar-items>
            </v-toolbar>

            <v-divider></v-divider>
            <template>
                <vo
                    ref="addForm"
                    v-slot="{ handleSubmit }">
                    <v-card
                        class="mx-auto"
                        max-width="700"
                        outlined
                        tag="form"
                        @submit.prevent="handleSubmit(onSubmit)">
                        <!-- start overly -->
                        <v-overlay
                            :absolute="true"
                            :value="overlay">
                            <v-progress-circular
                                indeterminate
                                size="100"
                                color="primary"></v-progress-circular>
                        </v-overlay>
                        <!-- end overly -->
                        <v-card-text>
                            <vp
                                v-slot="{ errors }"
                                vid="name"
                                name="Name"
                                rules="required|max:10">
                                <v-text-field
                                    v-model="name"
                                    :counter="10"
                                    :error-messages="errors"
                                    label="Name"
                                    outlined
                                    placeholder="product Name hear"
                                    :dense="dense"
                                    required></v-text-field>
                            </vp>
                            <vp
                                v-slot="{ errors }"
                                name="groupName"
                                vid="groupName"
                                rules="required">
                                <v-select
                                    v-model="groupName"
                                    :error-messages="errors"
                                    label="groupName hear"
                                    outlined
                                    :dense="dense"
                                    :items="groupNames"
                                    item-text="stk_group_name"
                                    item-value="id"
                                    required>

                                </v-select>
                            </vp>

                            <vp
                                v-slot="{ errors }"
                                name="supplierName"
                                vid="supplierName"
                                rules="required">
                                <v-select
                                    v-model="supplierName"
                                    :error-messages="errors"
                                    label="supplierName hear"
                                    outlined
                                    :dense="dense"
                                    :items="supplierNames"
                                    item-text="ledger_name"
                                    item-value="id"
                                    required>

                                </v-select>
                            </vp>

                            <vp
                                v-slot="{ errors }"
                                name="baseUnit"
                                vid="baseUnit"
                                rules="required">
                                <v-select
                                    v-model="baseUnit"
                                    :error-messages="errors"
                                    label="baseUnit hear"
                                    outlined
                                    :dense="dense"
                                    :items="baseUnits"
                                    item-text="stock_unit_name"
                                    item-value="id"
                                    required>

                                </v-select>
                            </vp>

                            <!-- <vp
                                v-slot="{ errors }"
                                name="image"
                                vid="image"
                                rules="image">
                                <v-file-input
                                class="file-input"
                                    v-model="file"
                                    :dense="dense"
                                    color="deep-purple accent-4"
                                    :error-messages="errors"
                                    counter
                                    label="File input"
                                    placeholder="Select your files"
                                    outlined
                                    :show-size="1000">
                                    <template v-slot:selection="{ index, text }">
                                        <v-chip
                                            v-if="index < 2"
                                            color="deep-purple accent-4"
                                            dark
                                            label
                                            small>
                                            {{ text }}
                                        </v-chip>

                                        <span v-else-if="index === 2" class="overline grey--text text--darken-3 mx-2">
                                            +{{ files.length - 2 }} File(s)
                                        </span>
                                    </template>
                                </v-file-input>
                            </vp> -->

                           
<!-- 
                            <vp
                              v-slot="{ errors }"
                                name="image"
                                vid="image"
                                rules="image">
                                <v-file-input
                                 class="file-input"
                                    v-model="file"
                                    :dense="dense"
                                    @click:clear="files=''"
                                    label="File input"
                                    placeholder="Select your files"
                                    prepend-inner-icon="mdi-camera"
                                    outlined
                                    clear-icon="mdi-close-circle"
                                    clearable
                                    type="file"
                                    :disabled="readOnly"
                                    :error-messages="errors"
                                    :append-icon="readOnly?'mdi-plus-box':'mdi-minus'">
                                    <template v-slot:selection="{ index, text }">
                                        <v-chip
                                            v-if="index < 2"
                                            color="deep-purple accent-4"
                                            dark
                                            label
                                            small>
                                            {{ text }}
                                        </v-chip>

                                        <span v-else-if="index === 2" class="overline grey--text text--darken-3 mx-2">
                                            +{{ files.length - 2 }} File(s)
                                        </span>
                                    </template>
                                </v-file-input>
                            </vp> -->
                            <multiFile @input="files =$event"></multiFile>

                        </v-card-text>

                        <v-divider></v-divider>
                        <v-card-actions class="text-right">
                            <v-container>
                                <v-btn
                                    type="submit"
                                    dark
                                    color="indigo">
                                    save
                                </v-btn>
                            </v-container>

                        </v-card-actions>
                    </v-card>
                </vo>
            </template>

        </v-card>
    </v-dialog>
   <bottomSeet v-model="sheet" :files="files"></bottomSeet>
</v-row>
</template>

<script>
import {
    axios,
    vErrors
} from '@/plugins/axios';
import Category from '@/models/Category';
import multiFile from './multiFile';
import bottomSeet from './bottomSeet';
export default {
    components:{multiFile,bottomSeet},
    props: ['value'],
    data() {
        return {
        appTitle:'',
        files:[],
            readOnly: false,
            notifications: false,
            sound: true,
            widgets: false,
            dense: true,
            //model
            name: 'eva',
            groupName: '',
            supplierName: '',
            baseUnit: '',

            file: null,
            overlay: false,
            sheet:true,

            groupNames: [{
                "id": "879",
                "admin_id": "2",
                "company_id": "27",
                "stk_group_name": "mobile",
                "stk_group_code": "201",
                "parent_code": "200",
                "root_code": "0",
                "created_at": "2020-10-13 00:49:10",
                "updated_at": "2020-10-13 00:49:10"
            }, {
                "id": "881",
                "admin_id": "2",
                "company_id": "27",
                "stk_group_name": "nokia",
                "stk_group_code": "203",
                "parent_code": "201",
                "root_code": "0",
                "created_at": "2020-10-13 00:50:15",
                "updated_at": "2020-10-13 00:50:15"
            }, {
                "id": "39",
                "admin_id": "2",
                "company_id": "27",
                "stk_group_name": "Primary",
                "stk_group_code": "200",
                "parent_code": "0",
                "root_code": "0",
                "created_at": null,
                "updated_at": null
            }, {
                "id": "880",
                "admin_id": "2",
                "company_id": "27",
                "stk_group_name": "samsung",
                "stk_group_code": "202",
                "parent_code": "200",
                "root_code": "0",
                "created_at": "2020-10-13 00:49:29",
                "updated_at": "2020-10-13 00:49:29"
            }],
            supplierNames: [{
                "id": "2744",
                "company_id": "27",
                "admin_id": "2",
                "group_code": "124",
                "ledger_name": "Allowance for Doubtful Debt",
                "alternative_name": "",
                "ledger_code": "",
                "rsl_code": null,
                "opening_balance": "0.00000000",
                "debit_or_credit": "1",
                "email": "",
                "address": "",
                "mobile": "",
                "website": "",
                "is_active": "1",
                "created_at": "2019-10-31 13:09:29",
                "updated_at": "2019-10-31 13:09:29"
            }],
            baseUnits: [{
                "id": "146",
                "admin_id": "2",
                "company_id": "27",
                "stock_unit_name": "kgs",
                "unit_decimal_places": "2",
                "created_at": "2020-10-13 00:47:16",
                "updated_at": "2020-10-13 00:47:16"
            }, {
                "id": "147",
                "admin_id": "2",
                "company_id": "27",
                "stock_unit_name": "pices",
                "unit_decimal_places": "2",
                "created_at": "2020-10-13 00:47:35",
                "updated_at": "2020-10-13 00:47:35"
            }],
            godowns: [{
                "id": "230",
                "product_id": "4809",
                "godown_id": "230",
                "quantity": "10",
                "rate": "10000",
                "amount": "100000",
                "token": "item-QkpeOBGyKZJ1602528841UFyfy8KLTyu",
                "admin_id": "2",
                "company_id": "27",
                "created_at": "2020-10-13 00:48:11",
                "updated_at": "2020-10-13 00:48:11",
                "stk_godown_name": "store a",
                "stk_godown_code": "301",
                "parent_code": "300"
            }, {
                "id": "231",
                "product_id": "4809",
                "godown_id": "231",
                "quantity": "20",
                "rate": "10000",
                "amount": "200000",
                "token": "item-QkpeOBGyKZJ1602528841UFyfy8KLTyu",
                "admin_id": "2",
                "company_id": "27",
                "created_at": "2020-10-13 00:48:25",
                "updated_at": "2020-10-13 00:48:25",
                "stk_godown_name": "store b",
                "stk_godown_code": "302",
                "parent_code": "300"
            }],

        }
    },
    computed: {
        categories() {
            return Category.query().where('parent_id', null).get();
        },
        dialog: {
            get() {
                return this.value
            },
            set(val) {
                this.$emit('input', val)
            }
        }
    },
    watch:{
        files(){
            this.sheet = true;
        }
    },
    methods: {

        async onSubmit() {
            var formData = new FormData();
            formData.append('image', this.file);
            formData.append('title', this.title);
            formData.append('description', this.description);

            this.overlay = true;

            try {
                const {
                    data
                } = await axios.post('/categories', formData);
                Category.insert({
                    data
                })
                this.dialog = false

            } catch (e) {

                if (e.response.status == 422) {
                    alert(252)
                    console.log(e.response)

                    vErrors.apply(this, [e.response.data, 'addForm']);
                }
            }
            this.overlay = false;

        }
    }

}
</script>

<style lang="scss">
.file-input{
.v-input__icon.v-input__icon--append{
    cursor: pointer;
}
}

</style>
