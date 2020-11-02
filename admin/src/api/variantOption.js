

import {
    axios,
    vErrors
} from '@/plugins/axios';
import { VariantOption } from '../models';
import {create,update,destroy,index} from './base';


export default{
    basePath:'/variant-options',
    slug(slug=""){
        return this.basePath+slug;
    },
    orm(){
        return VariantOption;
    },
    index,
    create,
    update,
    destroy,

}