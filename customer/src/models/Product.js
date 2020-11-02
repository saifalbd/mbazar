
import { Model } from '@vuex-orm/core'
import {Category,Price,Media, Cart} from './index'


export default class Product extends Model {
    static entity = 'products'
  
    static fields () {
      return {
        id: this.attr(null),
        local_id: this.attr(null),
        image: this.attr(''),
        title: this.attr(''),
        slug:this.attr(''),
        isActive:this.attr(''),
        createOn:this.attr(''),
        updateOn:this.attr(''),
        category_id:this.attr(null),
        category: this.belongsTo(Category, 'category_id'),
        hasPrice:this.attr(''),
        price:this.hasOne(Price,'product_id'),
        badgeLabel:this.attr(''),
        media: this.morphMany(Media, 'model_id', 'model_type'), // model_type ===   static entity
        brand_id:this.attr(''),
        cart: this.hasOne(Cart, 'product_id', 'local_id'),
        isOnWishlist:this.attr(''),
        isOnCartlist:this.attr(''),
        rules:this.attr(''),
        description:this.attr(''),
        ratingScore:this.attr(''),
            isOnWishlist: this.attr(''),
            reviewsCount:this.attr(''),

      
      }
    }
  }