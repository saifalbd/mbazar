import {
    axios,
    vErrors
} from '@/plugins/axios';
import { Variant } from '../models';
import {create,update,destroy,index} from './base';


export default{
    basePath:'/variants',
    slug(slug=""){
        return this.basePath+slug;
    },
    orm(){
        return Variant;
    },
    index,
    create,
    update,
    destroy,

}