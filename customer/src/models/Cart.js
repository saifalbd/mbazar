
import { Model } from '@vuex-orm/core'
import {Product} from './index';

export default class Cart extends Model {
    static entity = 'carts'
  
    static fields () {
      return {
        id: this.attr(null),
        qty:this.attr(null),
        product_id: this.attr(null),
      
        image: this.attr(''),
        title: this.attr(''),
      
        category_id:this.attr(null),

      
        price:this.attr(null),
        configuration:this.attr(null),
        
      }
    }
  }