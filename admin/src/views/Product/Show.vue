<template>
<v-row justify="center">
    <v-dialog v-model="dialog" fullscreen
        hide-overlay
        transition="dialog-bottom-transition"

        scrollable>

        <v-card>
            <v-toolbar dark color="primary" dense>
                <v-btn icon dark @click="dialog = false">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
                <v-toolbar-title>{{item.title}}</v-toolbar-title>
                <v-spacer></v-spacer>
                
            </v-toolbar>

            <v-divider></v-divider>
            <template>
                <v-container>
                    <v-row>
                        <v-col cols="12" md="6">
                            <!-- start carosole -->
                            <template>
                                <v-carousel v-model="model">
                                    <v-carousel-item v-for="(item,i) in item.media" :key="i" :src="item.src" reverse-transition="fade-transition" transition="fade-transition">
                                        <img :src="item.image" alt="" srcset="">
                                    </v-carousel-item>
                                </v-carousel>
                            </template>
                            <!-- end carosole -->
                        </v-col>
                        
                        <v-col cols="12" md="6">
                          
  <v-card
   
    class="mx-auto my-12"
   
  >
  

    <v-card-title>{{item.title}}</v-card-title>
    <v-card-text>
      <v-row
        align="center"
        class="mx-0"
      >
      
         <v-rating
      :value="3"
      background-color="purple lighten-3"
      color="purple"
      large
    ></v-rating>

        <div class="grey--text ml-4">
          4.5 (413)
        </div>
      </v-row>

      <div class="my-4 subtitle-1">
        Product description
      </div>

      <div>{{item.description}}</div>
    </v-card-text>

    <v-divider class="mx-4"></v-divider>

    <v-card-title v-if="item.price">Price</v-card-title>

    <v-card-text v-if="item.price">
      <price :item="item.price"></price>
    </v-card-text>

     <v-divider class="mx-4"></v-divider>

    <v-card-title>Report</v-card-title>

    <v-card-text>
      <showReport v-if="item.price" :item="item.price"></showReport>
    </v-card-text>

    <v-card-actions>
      
    </v-card-actions>
  </v-card>

                        </v-col>
                    </v-row>
                </v-container>

            </template>

        </v-card>
    </v-dialog>
</v-row>
</template>

<script>
import showReport from './_internal/showReport.vue';
import price from './_internal/_tableInternal/prices.vue';
export default {
    components: {
        price,showReport
    },
    props: {
        item: {
            type: Object,
            default: {"$id":"1","id":1,
            "img":"http://127.0.0.1:8000/media/1/big-1---Copy-(3).jpg",
            "title":"food","slug":"food","isActive":false,
            "createOn":"16 minutes ago","updateOn":"16 minutes ago",
            "category_id":6,
            "category":{"$id":"6","id":6,"img":"","title":"toy","slug":"toy",
            "isActive":false,"createOn":"3 days ago","updateOn":"3 days ago","parent_id":8,"product":[]},
            "price":{"$id":"1","id":1,"product_id":1,"price":50,"special_price":45,"sku":5855455},
            "media":[{"$id":"1","id":1,"model_id":1,"model_type":"product","image":"http://127.0.0.1:8000/media/1/big-1---Copy-(3).jpg","responsive_images":["http://127.0.0.1:8000/media/1/responsive-images/big-1---Copy-%283%29___media_library_original_500_500.jpg","http://127.0.0.1:8000/media/1/responsive-images/big-1---Copy-%283%29___media_library_original_418_418.jpg","http://127.0.0.1:8000/media/1/responsive-images/big-1---Copy-%283%29___media_library_original_350_350.jpg","http://127.0.0.1:8000/media/1/responsive-images/big-1---Copy-%283%29___media_library_original_292_292.jpg","http://127.0.0.1:8000/media/1/responsive-images/big-1---Copy-%283%29___media_library_original_245_245.jpg"]},{"$id":"2","id":2,"model_id":1,"model_type":"product","image":"http://127.0.0.1:8000/media/2/big-1---Copy-(7).jpg","responsive_images":["http://127.0.0.1:8000/media/2/responsive-images/big-1---Copy-%287%29___media_library_original_500_500.jpg","http://127.0.0.1:8000/media/2/responsive-images/big-1---Copy-%287%29___media_library_original_418_418.jpg","http://127.0.0.1:8000/media/2/responsive-images/big-1---Copy-%287%29___media_library_original_350_350.jpg","http://127.0.0.1:8000/media/2/responsive-images/big-1---Copy-%287%29___media_library_original_292_292.jpg","http://127.0.0.1:8000/media/2/responsive-images/big-1---Copy-%287%29___media_library_original_245_245.jpg"]},{"$id":"3","id":3,"model_id":1,"model_type":"product","image":"http://127.0.0.1:8000/media/3/big-1---Copy-(11).jpg","responsive_images":["http://127.0.0.1:8000/media/3/responsive-images/big-1---Copy-%2811%29___media_library_original_500_500.jpg","http://127.0.0.1:8000/media/3/responsive-images/big-1---Copy-%2811%29___media_library_original_418_418.jpg","http://127.0.0.1:8000/media/3/responsive-images/big-1---Copy-%2811%29___media_library_original_350_350.jpg","http://127.0.0.1:8000/media/3/responsive-images/big-1---Copy-%2811%29___media_library_original_292_292.jpg","http://127.0.0.1:8000/media/3/responsive-images/big-1---Copy-%2811%29___media_library_original_245_245.jpg"]}],"brand_id":"","description":""}
        },
        value: {}
    },
    data() {
        return {
            model: 0,
             items: [
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          },
        ],

        }
    },
    computed: {

        dialog: {
            get() {
                return this.value
            },
            set(val) {
                this.$emit('input', val)
            }
        }
    },

}
</script>

<style>

</style>
