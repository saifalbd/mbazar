<template>
<div class="text-center">

    <v-bottom-sheet v-model="sheet">

        <v-sheet
            class="mx-auto"
            elevation="1"
            >
            <v-row class="d-flex justify-center align-center flex-nowrap">
               
                    <v-card v-for="(item ,index) in items"
                    :key="index"  max-width="150px" style="flex:1">
                        <v-img style="width:100%" :src="item"></v-img>
                    </v-card>

               
            </v-row>

        </v-sheet>

    </v-bottom-sheet>
</div>
</template>

<script>
export default {
    props: ['value', 'files'],
    data: () => ({

        items: [],
        model: 0,

    }),
    methods: {
        readFile(file) {

            var reader = new FileReader();

            const self = this;

            reader.onload = function () {
                self.items.push(reader.result)

            };
            reader.readAsDataURL(file);

        },
        getFiles(files) {

            for (const key in files) {
                this.readFile(files[key])
            }

        }
    },
    computed: {
        sheet: {
            set(val) {
                this.$emit('input', val)
            },
            get() {
                return this.value && this.items.length;
            }
        },

    },
    watch: {
        files(files) {
             this.items = [];
            if (this.value && Array.isArray(files)) {

                this.getFiles(files);
            }
        },
        value(val) {

        }
    },
    created() {

    }
}
</script>
