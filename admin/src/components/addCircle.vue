<template>
<v-btn icon x-large class="create-btn" @click="$emit('click',true)">
    <v-avatar color="brown" size="56">
        <span class="white--text headline">
            <v-icon dark>
                {{icon}}
            </v-icon>
        </span>
    </v-avatar>
</v-btn>
</template>

<script>
import {
    mdiPlusBoxMultiple
} from '@mdi/js';
export default {
    data() {
        return {
            icon: mdiPlusBoxMultiple
        }
    }
}
</script>

<style lang="scss" scoped>
.create-btn {
    position: fixed;
    bottom: 0px;
    right: 0px;
    z-index: 10;
    transform: translate(-100%, -100%);
    opacity: 0.5;

    &:hover {
        opacity: 1;
    }
}
</style>
