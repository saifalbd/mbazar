<template>
 
 <!-- :permanent="primaryDrawer.type === 'permanent'" -->
  <v-app id="inspire">
    <v-app id="sandbox">
      <side-nav v-model="menuOpen"/>
      
  
      <v-app-bar
        :clipped-left="false"
        app
        dense
      >
        <v-app-bar-nav-icon
        @click.stop="menuOpen =!menuOpen"
        ></v-app-bar-nav-icon>
        <v-toolbar-title>Vuetify</v-toolbar-title>
         <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-heart</v-icon>
      </v-btn>
      <v-btn icon>
        <v-icon>mdi-lock</v-icon>
      </v-btn>
      
      </v-app-bar>
  
      <v-main>
        <v-breadcrumbs
        v-if="$store.state.bread.length"
      :items="$store.state.bread"
      divider="-"
    ></v-breadcrumbs>
        <v-container fluid>
          <v-row
            align="center"
            justify="center"
          >
            <v-col cols="12">
              <v-card>
                 <v-card-title>
      <v-icon v-if="$store.state.pageIcon" large left>{{$store.state.pageIcon}}</v-icon>
      <span class="title font-weight-light" v-text="$store.state.pageTitle"></span>
    </v-card-title>
      <v-card-text>
     <router-view/>
    </v-card-text>
              
              </v-card>
            </v-col>
          </v-row>
          
        </v-container>
      </v-main>
  
      <v-footer
        :inset="footer.inset"
        app
      >
        <span class="px-4">&copy; {{ new Date().getFullYear() }}</span>
      </v-footer>
    </v-app>
  </v-app>

</template>

<script>
import sideNav from './components/sideNav.vue';

  export default {
    components:{sideNav},
    data: () => ({
menuOpen:false,
     
  
    footer: {
      inset: true,
    },
     
    }),
   
 
   }
</script>