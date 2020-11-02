<template>
<div>
    <vp
        v-slot="{ errors }"
        :name="label"
        
        v-for="(s,i) in filesShowed.filter(f=>f.show)"
        :key="i"
        :rules="ruleIs(i)">
        <v-file-input
            class="file-input"
            :dense="true"
            v-model="files[s.index].model"
            :label="label(i)"
            placeholder="Select your files"
            prepend-inner-icon="mdi-camera"
            outlined
            accept="image/*"
            clear-icon="mdi-close-circle"
            :clearable="true"
            type="file"
            @change="inputChange($event)"
            :error-messages="errors">
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
                    +{{ files[s.index].model.length - 2 }} File(s)
                </span>
            </template>
        </v-file-input>
    </vp>
</div>
</template>

<script>
export default {
    props: {
        rules: {
            type: Object,
            
            default: () => ({
      required: true,
                image: true
    }),
        },
        minItem: {
            default: 1,
            type: Number
        }
    },

    data() {
        return {
            files: [{
                model: null,

            }],

        }
    },
    computed: {
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
        label(index) {
            let l = index ? `add Image (${index})` : 'add Image';
            return this.ruleIs(index) ? l : `${l} Optional`
        },
        ruleIs(index) {
            let itemNumber = index + 1;
            return this.minItem >= itemNumber ? this.rules : {};
        },

        inputChange(file) {

            this.$emit('input', this.files.filter(i => i.model).map(f => f.model));
            this.files.push({
                model: null
            });

        }
    },
    created() {
        // this.files.push(this.setFileModel())
    }

}
</script>

<style lang="scss" scoped>

</style>
