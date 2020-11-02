<template>
  <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="headline">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="confirm(false)">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="confirm(true)">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
</template>

<script>
export default {
    props:['value'],
    computed:{
        dialogDelete:{
            get(){ return this.value},
            set(val){ this.$emit('input',val)}
        }
    },
    methods:{
        confirm(rule){
            this.dialogDelete = false;
            this.$emit('confirm',rule);
        }
    }

}
</script>

<style>

</style>