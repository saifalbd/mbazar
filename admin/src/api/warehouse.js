
import {
    axios,
    vErrors
} from '@/plugins/axios';
import { Warehouse } from '../models';
import {create,update,destroy,index} from './base';


export default{
    basePath:'/warehouses',
    slug(slug=""){
        return this.basePath+slug;
    },
    orm(){
        return Warehouse;
    },
    index,
    create,
    update,
    destroy,

}