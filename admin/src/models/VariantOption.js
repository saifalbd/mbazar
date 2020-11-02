
import { Model } from '@vuex-orm/core'
import { apiVariantOption } from '../api';


export default class VariantOption extends Model {
    static entity = 'variant-options'
  
    static fields () {
      return {
        id: this.attr(null),
        title: this.attr(null),
       
        
      }
    }

    static api(){
      return apiVariantOption;
    }
  }