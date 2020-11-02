<template>
<app>
    <v-card class="mx-auto">
        <v-container class="pa-1">
            <v-item-group v-model="selected" multiple>
                <v-row>
                    <v-col v-for="(item, i) in categories" :key="i" cols="12" md="3">
                        <v-card>
                            <div class="d-flex flex-no-wrap justify-space-between">
                                <div style="height:100%">
                                    <v-card-title class="headline">{{item.title}}</v-card-title>

                                    <!-- <v-card-subtitle>title</v-card-subtitle> -->

                                    <v-spacer></v-spacer>
                                    <v-card-actions>

                                        <v-btn color="primary" 
                                        :to="{ name: 'Category', 
                                        params: { slug: item.slug }}" rounded small >
                                            show
                                        </v-btn>
                                    </v-card-actions>
                                </div>

                                <v-avatar class="ma-1" size="125" tile>
                                    <v-img :src="item.img"></v-img>
                                </v-avatar>
                            </div>
                        </v-card>

                    </v-col>
                </v-row>
            </v-item-group>
        </v-container>
    </v-card>
</app>
</template>

<script>
import app from '@/components/default/app.vue';
import {
    Category
} from '@/models/index.js';
export default {
    components: {
        app
    },
    data: () => ({
        items: [{
                src: 'backgrounds/bg.jpg',
            },
            {
                src: 'backgrounds/md.jpg',
            },
            {
                src: 'backgrounds/bg-2.jpg',
            },
            {
                src: 'backgrounds/md2.jpg',
            },
            {
                src: 'backgrounds/md2.jpg',
            },
            {
                src: 'backgrounds/md2.jpg',
            },
            {
                src: 'backgrounds/md2.jpg',
            },
        ],
        selected: [],
    }),
    computed: {
        categories() {
            return Category.all()
        }
    }
}
</script>
