<template>
<v-card
    class="ml-2 mr-2 e-product-card d-flex flex-column justify-space-around"
    
    
    @click="activeToggle">

    <v-img
        contain
        :src="item.image"
        :alt="title"
        :aspect-ratio=" aspectRatioImage">

    </v-img>

    <span class="e-product-badge">
        {{ badgeLabel }}
    </span>

    <v-btn
        icon
        color="pink"
        :aria-label="`${ariaLabel} ${title}`"
        :class="wishlistIconClasses"
        @click="toggleIsOnWishlist">
        <v-icon>{{currentWishlistIcon}}</v-icon>
    </v-btn>
 <v-divider class="mx-1"></v-divider>
    <v-card-title >
    <router-link
  :to="{ name: 'Product', params: { slug: item.id }}"
  v-slot="{ href, route, navigate, isActive, isExactActive }"
>
  <a class="link" :href="href">{{titleLimit(item.title)}}</a>
  
</router-link>
    
  
         </v-card-title>
          <v-divider class="mx-1"></v-divider>
        <v-card-text>
          
              <!-- <div class="title-box">
                <span class="title blue--text link">
               </span>
              </div> -->
            
            <!-- <a href="/" class="title blue--text link">{{item.title}}</a> -->
             <v-row
        align="center"
        class="mx-0"
      >
        <v-rating
                readonly
                small
                dense
                background-color="orange"
                color="orange"
                :value="scoreRating"></v-rating>

        <div class="grey--text ml-4">
          4.5 (413)
        </div>
      </v-row>
            
            <span class="title">

                {{item.price.special}}
            </span> &nbsp <del class=""> {{item.price.regular}}</del>
        </v-card-text>

 <v-divider class="mx-1"></v-divider>
    <v-card-actions>

        <v-row class="d-flex justify-center">
            <addToCart
                :loading="false"
                :is-added-on-cart="item.isOnCartlist"
                @click="onAddToCart"></addToCart>
        </v-row>

    </v-card-actions>

    <!-- <slot
        name="active"
        v-bind:active="active"
        v-bind:toggle="activeToggle">
        <v-scroll-y-transition>
            <div
                v-if="active"
                class="isActive">
                Active
            </div>
        </v-scroll-y-transition>
    </slot> -->

</v-card>
</template>

<script>
import addToCart from './_internal/addToCartBtn'
import {
    axiosWithoutToken,
    axios
} from '../../plugins/axios';
import {
    Cart,
    Product
} from "../../models/index.js";

export default {

    components: {
        addToCart
    },
    props: {
        item: {
            type: Object,
            required: true,
        },
        /**
         * Product image
         * It should be an url of the product
         */
        image: {
            type: [Array, Object, String],
            default: "",
        },
        aspectRatioImage: {
            type: Number,
            default: 1,
        },
        /**
         * Product image width, without unit
         */
        imageWidth: {
            type: [String, Number],
            default: 216,
        },
        /**
         * Product image height, without unit
         */
        imageHeight: {
            type: [String, Number],
            default: 326,
        },
        /**
         * Badge label
         */
        badgeLabel: {
            type: String,
            default: "off",
        },
        /**
         * Badge color
         * It can be according to our standard colors, or legitimate CSS color such as `#fff`, `rgb(255,255,255)`), and `lightgray` or nothing.
         * Standard colors: `primary`, `secondary`, `white`, `black`, `accent`, `green-primary`, `green-secondary`, `gray-primary`, `gray-secondary`, `light-primary`, `light-secondary`, `pink-primary`, `pink-secondary`, `yellow-primary`, `yellow-secondary`, `blue-primary`, `blue-secondary`.
         */
        badgeColor: {
            type: String,
            default: "",
        },
        /**
         * Product title
         */
        title: {
            type: String,
            default: "",
        },
        /**
         * Link to product page
         */
        link: {
            type: [String, Object],
            default: "",
        },
        /**
         * Link element tag
         * @deprecated will be removed in 1.0.0 use slot to replace content
         */
        linkTag: {
            type: String,
            default: undefined,
        },
        /**
         * Product rating
         */
        scoreRating: {
            type: Number,
            default: 1,
        },
        /**
         * Product reviews count
         */
        reviewsCount: {
            type: [Number, Boolean],
            default: false,
        },
        /**
         * Maximum product rating
         */
        maxRating: {
            type: [Number, String],
            default: 5,
        },
        /**
         * Product regular price
         */
        regularPrice: {
            type: [Number, String],
            default: null,
        },
        /**
         * Product special price
         */
        specialPrice: {
            type: [Number, String],
            default: null,
        },
        /**
         * Wish list icon
         * This is the default icon for product not yet added to wish list.
         * It can be a icon name from our icons list, or array or string as SVG path(s).
         */
        wishlistIcon: {
            type: [String, Array, Boolean],
            default: "mdi-heart-broken",
        },
        /**
         * Wish list icon for product which has been added to wish list
         * This is the icon for product added to wish list. Default visible on mobile. Visible only on hover on desktop.
         * It can be a icon name from our icons list, or array or string as SVG path(s).
         */
        isOnWishlistIcon: {
            type: [String, Array],
            default: "mdi-heart",
        },
        /**
         * Status of whether product is on wish list or not
         */
        isOnWishlist: {
            type: Boolean,
            default: false,
        },
        /**
         * Status of showing add to cart button
         */
        showAddToCartButton: {
            type: Boolean,
            default: false,
        },
        /**
         * isAddedToCart status of whether button is showed, product is added or not
         */
        isAddedToCart: {
            type: Boolean,
            deafult: false,
        },
        /**
         * addToCartDisabled status of whether button is disabled when out of stock
         */
        addToCartDisabled: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            active: false,
            hasOnCart: 1,
            color: "indigo",
            isAddingToCart: false,

        }
    },

    computed: {
        isSFColors() {
            return SF_COLORS.includes(this.badgeColor.trim());
        },

        currentWishlistIcon() {
            return this.item.isOnWishlist ? this.isOnWishlistIcon : this.wishlistIcon;
        },
        showAddedToCartBadge() {
            return !this.isAddingToCart && this.isAddedToCart;
        },
        ariaLabel() {
            return this.item.isOnWishlist ? "Remove from wishlist" : "Add to wishlist";
        },
        wishlistIconClasses() {
            const defaultClass = "e-product-card__wishlist-icon";
            return `${defaultClass} ${this.item.isOnWishlist ? "on-wishlist" : ""}`;
        },
    },
    methods: {
        titleLimit(title){
            let limit = 40;
            if(title.length>limit){
var res = title.slice(0,limit)
return res;
            }
            return title;

        },
        activeToggle() {
            this.active = !this.active;
        },
        toggleIsOnWishlist() {
            this.$emit("click:wishlist", !this.item.isOnWishlist);
        },
        async onAddToCart(event) {

            if (!this.item.cart) {

                let d = {
                    product_id: this.item.id,
                    qty: 1,
                }
                let {
                    data
                } = await axios.post('./carts', d)

                Cart.insert({
                    data
                })

            }
            this.$store.commit('cartOn', true);

        },
    },

}
</script>

<style lang="scss" scoped>
.link {
    text-decoration: none;
}
.title-box{
    min-height:100px;
    background-color:#e0e0e0a3;
}
.isActive {
    position: absolute;
    right: 0;
    left: 0;
    bottom: 0;
    top: 0;
    background-color: blueviolet;
}

.e-product-badge {
    position: absolute;
    left: 0;
    top: 0;

    background-color: #cc1ed2;

    padding: 3px 10px;
    color: #ffffff;
    opacity: 0.7;

}
.e-product-card{
    
  width:270px;
}
.e-product-card:hover {
    .e-product-badge {
        opacity: 1;
    }
}

.e-product-card__wishlist-icon {
    position: absolute;
    right: 0;
    top: 0;
}
</style>
