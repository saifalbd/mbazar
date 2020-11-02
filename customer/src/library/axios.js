import axios from 'axios';
import {devServer} from '../../vue.config'

axios.defaults.baseURL = devServer.proxy
// axios.defaults.withCredentials = true;
axios.defaults.headers.common['Access-Control-Allow-Origin'] ='*';

export {axios};