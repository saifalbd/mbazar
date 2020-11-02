
import { Model } from '@vuex-orm/core'
import {Product} from './Product';

export default class Media extends Model {
    static entity = 'medias'
  
    static fields () {
      return {
        id: this.attr(null),
        model_id: this.attr(null),
        model_type: this.attr(null),
        image:this.attr(''),
        responsive_images:this.attr(''),
        // product: this.belongsTo(Product, 'product_id'),
        
      }
    }
  }