
export class fakeCategory {

   async fetch(){
     return await fetch('https://fakestoreapi.com/products')
     .then(res=>res.json())
    }
    mix(model){
        
    }




}