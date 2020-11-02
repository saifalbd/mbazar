import axiosWithoutToken from 'axios';
import vErrors from '@/plugins/validationErrors.js';
import {devServer} from '../../vue.config'

axiosWithoutToken.defaults.baseURL = devServer.proxy
axiosWithoutToken.defaults.withCredentials = true;
axiosWithoutToken.defaults.headers.common['Access-Control-Allow-Origin'] ='*';

const hasToken = ()=>{
  return localStorage.getItem('token');
}


const axios = axiosWithoutToken.create();
  axios.interceptors.request.use(function (config) {
    // Do something before request is sent
    let token = hasToken();
    if(token){
      config.headers.Authorization =token;
    }else {
        window.location.replace('/sign');
    }
    
   
    return config;
  }, function (error) {
    // Do something with request error
    return Promise.reject(error);
  });
  axios.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data
    return response;
  }, function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error
    if (error.response.status == 401) {
        window.location.replace('/sign');
    }
    return Promise.reject(error);
  });






export {axios,axiosWithoutToken,vErrors};