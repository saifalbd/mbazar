
import { Model } from '@vuex-orm/core'
import { apiVariant } from '../api';


export default class Variant extends Model {
    static entity = 'variants'
  
    static fields () {
      return {
        id: this.attr(null),
        title: this.attr(null),
        options: this.attr(null),
       
        
      }
    }

    static api(){
      return apiVariant;
    }
  }