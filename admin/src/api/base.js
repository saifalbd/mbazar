import {
    axios,
    vErrors
} from '@/plugins/axios';

export const index = async function(){
    try {
        const {data} = await axios.get(this.slug());
   this.orm().create({data:data.data});
   return Promise.resolve(data);
    } catch (error) {
        return Promise.reject(error);
    }
}

export const create = async function(cradencial){
const formData = new FormData();
    for (const key in cradencial) {
        formData.append(key,cradencial[key]);
    }

    try {
      const {data} = await axios.post(this.slug(),formData);
      this.orm().insert({data});
      return Promise.resolve(data);
    } catch (error) {
      
        return Promise.reject(error);
    }
}

export const show = async function(slug){
   
  try {
    const res = await axios.get(this.slug(`/${slug}`));
    let data = res.data;
    this.orm().create({data});
    return Promise.resolve(res.data);
  } catch (error) {
    return Promise.reject(error);
  }
 }


export const update = async function(id,cradencial){
cradencial['_method'] = 'PUT';
 
    try {
        const formData = new FormData();
    for (const key in cradencial) {
        formData.append(key,cradencial[key]);
    }
    const {data} = await axios.post(this.slug(`/${id}`),formData);
    this.orm().update({where:id,data});
    return Promise.resolve(data);
    } catch (error) {
        return Promise.reject(error);
    }
 }

 export const destroy = async function(id){

   try {
    const {data} = await axios.delete(this.slug(`/${id}`));
    const variant =this.orm().find(id);
    variant.$delete();
    return Promise.resolve(data);
   } catch (error) {
    return Promise.reject(error);
   }
 }