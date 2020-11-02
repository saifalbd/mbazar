<template>
<div
    class=""
    :class="[staticClass, className]">

    <v-overlay
        :value="visibleOverlay"
        :dark="false">
        <transition :name="transitionName">
            <aside
                v-if="visible"
                v-click-outside="checkPersistence"
                class="cart-side-bar">
                <!--@slot Use this slot to place content inside the modal bar.-->
                <slot name="bar">

                    <!-- <SfBar
                        :title="title"
                        class="smartphone-only"
                        :back="true"
                        @click:back="close" /> -->
                </slot>
                <!--@slot Use this slot to replace close icon.-->
                <slot
                    name="circle-icon"
                    v-bind="{ close, button }">

                    <v-btn
                        v-if="button"
                        class="mx-2 cart-closeBtn"
                        fab
                        dark
                        small
                        @click="close"
                        color="pink">
                        <v-icon dark>
                            mdi-close
                        </v-icon>
                    </v-btn>
                </slot>
                <div
                    v-if="title || hasTop"
                    class="sf-sidebar__top">
                    <!--@slot Use this slot to replace SfHeading component.-->
                    <slot
                        name="title"
                        v-bind="{ title, subtitle, headingLevel }">
                        <heading
                            v-if="title"
                            :title="title"
                            :description="subtitle"
                            :level="headingLevel" />
                    </slot>
                    <!--@slot Use this slot to add sticky top content.-->
                    <slot name="content-top" />
                </div>
                <div
                    ref="content"
                    class="sf-sidebar__content">
                    <!--@slot Use this slot to add SfSidebar content.-->
                    <slot />
                </div>
                <!--@slot Use this slot to place content to sticky bottom.-->
                <div
                    v-if="hasBottom"
                    class="sf-sidebar__bottom">
                    <slot name="content-bottom" />
                </div>
            </aside>
        </transition>
    </v-overlay>
</div>
</template>

<script>
import {
    disableBodyScroll,
    clearAllBodyScrollLocks
} from "body-scroll-lock";
import {
    isClient
} from "@/utilities/helpers";

import heading from './heading.vue';
export default {
    name: "SfSidebar",
    directives: {

    },
    components: {

        heading
    },
    props: {
        title: {
            type: String,
            default: "",
        },
        subtitle: {
            type: String,
            default: "",
        },
        headingLevel: {
            type: Number,
            default: 1,
        },
        button: {
            type: Boolean,
            default: true,
        },
        visible: {
            type: Boolean,
            default: false,
        },
        overlay: {
            type: Boolean,
            default: true,
        },
        /**
         * If true clicking outside will not dismiss the sidebar
         */
        persistent: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            position: "left",
            staticClass: null,
            className: null,
        };
    },
    computed: {
        visibleOverlay() {
            return this.visible && this.overlay;
        },
        transitionName() {
            return "sf-slide-" + this.position;
        },
        hasTop() {
            return this.$slots.hasOwnProperty("content-top");
        },
        hasBottom() {
            return this.$slots.hasOwnProperty("content-bottom");
        },
    },
    watch: {

    },
    mounted() {
        this.classHandler();
    },
    updated() {
        this.classHandler();
    },
    methods: {
        close() {
            this.$emit("close");
        },
        checkPersistence() {
            if (!this.persistent) this.close();
        },
        keydownHandler(e) {
            if (e.key === "Escape" || e.key === "Esc" || e.keyCode === 27) {
                this.close();
            }
        },
        classHandler() {
            let update = false;
            if (this.staticClass !== this.$vnode.data.staticClass) {
                this.staticClass = this.$vnode.data.staticClass;
                update = true;
            }
            if (this.className !== this.$vnode.data.class) {
                this.className = this.$vnode.data.class;
                update = true;
            }
            if (update) {
                this.position = [this.staticClass, this.className].toString().search("--right") > -1 ?
                    "right" :
                    "left";
            }
        },
    },
};
</script>

<style lang="scss">
.cart-side-bar {
    position: fixed;
    top: 0;

    right: 0;
    bottom: 0;
    z-index: 6;
    display: flex;
    flex-direction: column;
    box-sizing: border-box;
    width: var(--sidebar-width);
    height: 100%;
    background-color: var(--sidebar-background, var(--c-white));
    box-shadow: var(--sidebar-box-shadow, 0px 4px 11px rgba(29, 31, 34, 0.1));
}

.sf-sidebar__aside {
    z-index: 6;
}

// @import "~@storefront-ui/shared/styles/components/organisms/SfSidebar.scss";
</style>
