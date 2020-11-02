<template>
<div class="home">
    <!-- <img alt="Vue logo" src="../assets/logo.png"> -->
    <app>

        <UserStep></UserStep>

    </app>

</div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue';
import UserStep from './_internal/UserStep.vue';
import {
    mdiHomeCircle
} from '@mdi/js';
import app from '@/components/app.vue';

export default {
    name: 'Home',
    components: {
        app,
        UserStep
    },
    data() {
        return {
            userData: null
        }
    },
    created() {
        /*start default config*/
        this.$store.commit("bread", [{
            text: 'Link 1',
            disabled: false,
            href: 'breadcrumbs_link_1',
        }]);
        this.$store.commit('pageTitle', 'home page');
        this.$store.commit('pageIcon', mdiHomeCircle);
        /*end default config*/
    }
}
</script>
