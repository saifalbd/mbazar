<template>
    <div>
        <input type="hidden" name="_token" :value="token">
    </div>
</template>

<script>
    export default {
        data(){
           return {
                token:''
           }
        },
        created(){
         this.token =    document.querySelector(`meta[name="csrf-token"]`).getAttribute('content');
        }
    }
</script>
