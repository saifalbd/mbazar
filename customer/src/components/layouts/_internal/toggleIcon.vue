<template>
   <svg class="e-arrow-toggle" viewBox="0 0 24 24" :class="toggle?'toggle':false">
                <path fill="currentColor"
                d="M11,4H13V16L18.5,10.5L19.92,11.92L12,19.84L4.08,11.92L5.5,10.5L11,16V4Z" />
            </svg>
</template>

<script>
export default {
    props:{
        toggle:{

        }
    }

}
</script>

<style>

</style>
