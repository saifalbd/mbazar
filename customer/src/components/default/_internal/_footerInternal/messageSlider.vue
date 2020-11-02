<template>
  <v-sheet
    class="mx-auto"
   
  >
    <v-slide-group
      multiple
      show-arrows
    >
      <v-slide-item
        v-for="(m,i) in items" :key="i"
        v-slot:default="{ active, toggle }"
      >
     
         <div class="e-reputation-item" :class="active ? 'active' : ''">
             <v-icon size="50">{{m.icon}}</v-icon>
           
            <div class="e-center">
                <div class="e-title">{{m.title}}</div>
                <div class="e-r-t">{{m.text}}</div>
            </div>
        </div>
      </v-slide-item>
    </v-slide-group>
  </v-sheet>
</template>

<script>
  export default {
      props:{
items:{
    type:Array,
    required:true
}
},
    data: () => ({
      model: null,
    }),
  }
</script>

<style lang="scss" scoped>

.e-reputation-item {
padding: 10px;
height: 150px;
flex-direction: column;;
display: flex;
justify-content: center;
align-content: space-around;
  -webkit-box-shadow: 0px 0px 0px 5px #A0A0A0, inset 0px 10px 27px -8px #141414, inset -50px -50px 0px -30px rgba(0,0,0,0);
box-shadow: 0px 0px 0px 5px #A0A0A0, inset 0px 10px 27px -8px #141414, inset -50px -50px 0px -30px rgba(0,0,0,0);

           
.e-center{
    flex-direction: column;;
display: flex;
justify-content: center;
flex: 1;
padding: 10px 0;
.e-title{
   text-align: center;
   padding: 10px 0;
   font-weight: bold;
}
.e-r-t{
   text-align: center; 
}
}
}
</style>