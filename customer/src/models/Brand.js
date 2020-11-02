
import { Model } from '@vuex-orm/core';
import Product from './Product';
export default class Brand extends Model {
    static entity = 'brands'
  
    static fields () {
      return {
        id: this.attr(null),
        image: this.attr(''),
        title: this.attr(''),
        slug:this.attr(''),
        isActive:this.attr(''),
        createOn:this.attr(''),
        updateOn:this.attr(''),
        product: this.hasMany(Product, 'brand_id')
      }
    }
  }