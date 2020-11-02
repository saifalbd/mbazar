import { axiosWithoutToken,axios,axiosHasAuth,hasToken ,hasSessionUser} from "./axios";
import { Category,Cart } from '@/models/index.js';
import store from '@/store'
export async function categories(){
const {data} = await axiosWithoutToken.get('/categories');
Category.insert({data:data.data})
return Promise.resolve(data);
}

export async function addAuth(){
  let has = hasToken();
  let hasUser = hasSessionUser();

  if (has) {
    if (hasUser) {
      store.commit('setUser',   JSON.parse(hasUser));
       return Promise.resolve(  JSON.parse(hasUser));
    }
    let {data}  =  await axiosHasAuth(has).get('/user');
      store.commit('setUser', data.data);
    return Promise.resolve(data.data);
  }
 return Promise.resolve(null)
  }
export  async function  canHasAuth(){
  return await addAuth();
}

export async function carts(){
    let has = hasToken()
    if (has) {
      let {data}  =  await axiosHasAuth(has).get('/carts');
      Cart.insert({data:data.data})
      return Promise.resolve(data.data);

    }
   return Promise.resolve([])
  
    }

