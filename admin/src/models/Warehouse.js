
import { Model } from '@vuex-orm/core'
import { apiWarehouse} from '../api';

export default class Warehouse extends Model {
    static entity = 'warehouses'
  
    static fields () {
      return {
        id: this.attr(null),
        title: this.attr(null),
        place: this.attr(null),
        createOn:this.attr(''),
        updateOn:this.attr(''),
      }
    }

    static api(){
      return apiWarehouse;
    }
  }