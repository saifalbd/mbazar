
import { Model } from '@vuex-orm/core'
import {Product} from './Product';

export default class Price extends Model {
    static entity = 'prices'
  
    static fields () {
      return {
        id: this.attr(null),
        product_id: this.attr(null),
        regular: this.attr(''),
        special:this.attr(''),
        sku:this.attr(''),
        // product: this.belongsTo(Product, 'product_id'),
        
      }
    }
  }