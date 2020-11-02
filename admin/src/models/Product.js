
import { Model } from '@vuex-orm/core'
import Category from './Category'
import Price from './Price'
import media from './Media'
import { apiProduct} from '../api';

export default class Product extends Model {
    static entity = 'product'
  
    static fields () {
      return {
        id: this.attr(null),
        image: this.attr(''),
        title: this.attr(''),
        slug:this.attr(''),
        isActive:this.attr(''),
        createOn:this.attr(''),
        updateOn:this.attr(''),
        category_id:this.attr(null),
        category: this.belongsTo(Category, 'category_id'),
        hasPrice:this.attr(''),
        rules:this.attr(''),
        price:this.hasOne(Price,'product_id'),
        media: this.morphMany(media, 'model_id', 'model_type'), // model_type ===   static entity
        brand_id:this.attr(''),
        description:this.attr('')
      
      }
    }

    static api(){
      return apiProduct;
    }
  }