
import { Model } from '@vuex-orm/core';
import Product from './Product';
export default class Category extends Model {
    static entity = 'categories'
  
    static fields () {
      return {
        id: this.attr(null),
        image: this.attr(''),
        title: this.attr(''),
        slug:this.attr(''),
        isActive:this.attr(''),
        createOn:this.attr(''),
        updateOn:this.attr(''),
        parent_id:this.attr(''),
        product: this.hasMany(Product, 'category_id'),
        description:this.attr('')
      
      }
    }
  }