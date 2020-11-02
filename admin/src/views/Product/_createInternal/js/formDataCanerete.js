import {
    axios,
    vErrors
} from '@/plugins/axios';




 export class formVals {

 }

 export class collection {

    constructor(collection,mainKey="data") {
        this.collection =collection
        this. data=[]
        this.mainKey=mainKey
      }

    
     isBoolean(val){
         return typeof val =='boolean' ?val?1:0:val;
     }
     make(nameis,valis){
       let name =  `${this.mainKey}${nameis}`
       let val = this.isBoolean(valis);
       //console.log({key,val})
        this.data.push({name,val});

     }
     makeOnArray(obj,w=''){
         for (const key in obj) {
            let name = w?`${w}[${key}]`:key;
            let val = obj[key];
           
            if (this.hasChild(val)) {
               
                this.makeOnArray(obj[key],`${w}[${key}]`)
            }else{
                
                this.make(name,val)
            }
            
           
         }

     }
     hasChild(property){
       
         if (property instanceof Object) {
            
             return true;
         }else if (Array.isArray(property)) {
            return true;
         }else{
             return false;
         }
     }
     makeObj(el,index=null){
        for (const key in el) {

            var name = index!=null ?`[${index}][${key}]` : `[${key}]`;
          
            // if (key!='images') {
              
        
                
                 if (this.hasChild(el[key])) {
                     
            
           this.makeOnArray(el[key],name )
            
        }else{
            this.make(name ,el[key])
        }

    // }
                
           
        }
     }
     makeCollection(isObj){
         const items =this.collection

         if (isObj) {
             this.makeObj(items)
         }else{
            items.forEach((el,index) => {
           
                this.makeObj(el,index)
            });
         }

         
     }
     getData(isObj = false){
         this.makeCollection(isObj)
         return this.data;
     }
     getFromDataObject(){
        let formData = new FormData();
        this.getData().forEach(item => {
            formData.append(item.name,item.val);
        });

        return formData;
        
     }
 }


export const  addItemsCollection =async function (data){
    let variantsObj = new collection(data.variants,'variants');
   
    const variants = variantsObj.getData();
    
  

    let productObj = new collection(data.product,'product');
    

    const product = productObj.getData(true);

    product.push(...variants)

    const formData = new FormData();
    product.forEach(item => {
        formData.append(item.name,item.val);
    });
 
   
console.log(product);


    
   




try {
    
  const {data} = await axios.post('/test',formData);

  return Promise.resolve(data);
} catch (error) {

    console.error(error)
  return  Promise.reject(error)
}

 }





