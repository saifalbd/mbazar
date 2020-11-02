/**
 * this js file write funstion work has auth or not auth funtionality
 */
import {  categories,carts, addAuth } from "@/plugins/api";
 export const authGuestBeforeEnter  = async function(to, from, next){
    await addAuth();
    carts();
categories();
     next()
 }