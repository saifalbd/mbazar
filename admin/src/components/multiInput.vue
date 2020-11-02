<template>
<div>
    <vp
        v-slot="{ errors }"
        :name="label"
        v-for="(s,i) in  models"
        :vid="vid"
        :key="i"
        :rules="ruleIs(i)">
        <v-text-field
            class="file-input"
            :dense="true"
            v-model="models[i]"
            :label="modifyLabel(i)"
            placeholder="Select your files"
            prepend-inner-icon="mdi-import"
            outlined
            clear-icon="mdi-close-circle"
            append-icon="mdi-plus-box"
            @click:append="removeEmpty"
            :clearable="true"
            type="text"
            @mousedown="inputChange($event)"
            :error-messages="errors">

        </v-text-field>
    </vp>
</div>
</template>

<script>
export default {
    name: 'multiInput',
    props: {
        value: {
            type: Array,
            required: true,
        },
        label: {
            type: String,
            default: 'label'
        },
        minItem: {
            default: 1,
            type: Number
        },
        vid: {
            type: String,
            default: 'input'
        },
        rules: {
            type: Object,

            default: () => ({
                required: true,
                image: false
            }),
        },
        minItem: {
            default: 1,
            type: Number
        }
    },

    data() {
        return {
            modelsdd: [null],
            addNew: true,

        }
    },
    computed: {
        models: {
            set(val) {
                this.$emit('input', val);
            },
            get() {

                let vals = this.value;

                return vals.length ? vals : [''];
            }

        },
        filesShowed() {
            var collection = [{
                index: 0,
                show: true
            }];
            if (this.files.length > 1) {
                collection = this.files.map((item, index) => {
                    let show = Boolean(item.model);
                    return {
                        index,
                        show
                    }
                })
            }

            if (collection.find(i => !i.show)) {
                collection[collection.length - 1].show = true;
            }

            return collection;

        }
    },

    methods: {
        modifyLabel(index) {
            let l = index ? `${this.label} (${index})` : this.label;
            return this.ruleIs(index) ? l : `${l} Optional`
        },
        ruleIs(index) {
            let itemNumber = index + 1;
            return this.minItem >= itemNumber ? this.rules : {};
        },
        hasLastNotEmpty() {
            return this.models[this.models.length - 1];
        },
        removeEmpty() {

            let models = this.models;
            if (this.hasLastNotEmpty()) {
                models.push('');
            }

            this.models = models;

        },

        inputChange(file) {

            //  this.$emit('input', this.files.filter(i => i.model).map(f => f.model));

        }
    },
    created() {
        // this.files.push(this.setFileModel())
    }

}
</script>

<style lang="scss" scoped>

</style>
