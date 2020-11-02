import {
    axios,
    vErrors
} from '@/plugins/axios';
import { Product } from '../models';
import {create,update,destroy,index} from './base';


export default{
    basePath:'/products',
    slug(slug=""){
        return this.basePath+slug;
    },
    orm(){
        return  Product;
    },
    index,
    create,
    update,
    destroy,

}