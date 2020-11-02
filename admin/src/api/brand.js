import {
    axios,
    vErrors
} from '@/plugins/axios';
import { Brand } from '../models';
import {create,update,destroy,index} from './base';


export default{
    basePath:'/brands',
    slug(slug=""){
        return this.basePath+slug;
    },
    orm(){
        return Brand;
    },
    index,
    create,
    update,
    destroy,

}