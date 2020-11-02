
import json from './json';

var cloneDeep = require('lodash.clonedeep');

const  uniqueSku =(index='') =>{
    var d = new Date();
    var n = `${d.getTime()}${index}`;
    return n;
}


const  slugCase = (str) =>{
    return str.replace("  ", "-").replace(",", "-").replace(" ", "-")
}
const  slug = (productTitle, variantTitle, optionTitle) =>{

    return `${slugCase(productTitle)}-${slugCase(variantTitle)}-${slugCase(optionTitle)}`
}


const  mixVariants = (variants ,mixObj)=> {
    const collection = [];
    

    variants.forEach(item => {

        let options = item.selects.map((op ,index)=> {
            let data =  {
                optionId: op.id,
                optionTitle: op.title,
                variantId: item.id,
                variantTitle: item.title,
                
            }

            
            let obj = Object.assign(mixObj,data);
            obj['sku']= uniqueSku(index);
            obj['slug'] = slug(obj.productTitle, obj.variantTitle, obj.optionTitle)


            return cloneDeep(obj);

        });

        return collection.push(...options);

    });


    //add default product how in home page
   let finalCollection =  collection.map((item,index)=>{
        item.isDefault = index?false:true;
        return item;
    });

    

    return  cloneDeep(finalCollection);
}

export const properties =(collection)=>{
    // want only id;
    const product = cloneDeep(collection.product);
    product.categories = product.categories.map(i=>i.id);
   
    let {price,comparePrice,title,categories,brand_id} = product;
    let images = cloneDeep(collection.images);
    let {inventory_quantity,inventory_store,isUnlimited} = cloneDeep(collection.inventory);
    let variants =  mixVariants(collection.variants,{
    productTitle:title,
        price:parseInt(price),
        comparePrice:parseInt(comparePrice),
        inventory_quantity:parseInt(inventory_quantity),
        inventory_store,
        isUnlimited,
         images:[],
        categories,
        brandId:brand_id
});

product['images'] = images;


return  {product,variants};

}