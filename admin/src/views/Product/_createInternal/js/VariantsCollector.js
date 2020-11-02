import { VariantOptionCollector } from "./VariantOptionCollector";
var cloneDeep = require('lodash.clonedeep');

export class VariantsCollector {

    constructor(product,variants){ //product is ProductCollector>data and variants 
        this.product = product;
        this.variants = variants;
    }


    data(){
        const options = [];
         this.variants.forEach(variant=>{
            variant.selects.forEach(option => {
                let collector = new VariantOptionCollector(this.product,variant,option);
                options.push(collector.data());
            });

        })
        return cloneDeep(options);
    }



}