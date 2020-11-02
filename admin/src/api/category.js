import {
    axios,
    vErrors
} from '@/plugins/axios';
import { Category } from '../models';
import {create,update,destroy,index} from './base';


export default{
    basePath:'/categories',
    slug(slug=""){
        return this.basePath+slug;
    },
    orm(){
        return Category;
    },
    index,
    create,
    update,
    destroy,

}