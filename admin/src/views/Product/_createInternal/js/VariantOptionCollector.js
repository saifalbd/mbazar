
export class VariantOptionCollector {

    constructor(product,variant ,option){ 
        //product is ProductCollector>data and  variants is selecte single object and option single option Object
        this.product = product;
        this.variant = variant;
        this.option = option;
       
       
    }

    get title(){
        return `${this.product.title} ${this.variant.title} ${this.option.title}`;
    }
   

    get images(){ // becouse add on input
        return [];
    }

    get price(){
        return this.product.price;
    }

    get comparePrice(){
        return this.product.comparePrice;
    }
    get sku(){
        var d = this.product.sku;
        return `${d}${this.option.id}`
    }
    get slug(){
        return this.title.replace("  ", "-")
        .replace(",", "-")
        .replace(" ", "-")
        .replace("+", "")
        .replace("-", "")
    }
    get inventory_quantity(){
        return this.inventory.inventory_quantity;
    }
    get inventory_store(){ //storeID
        return this.inventory.inventory_store;
    }
    get isUnlimite(){
        return this.inventory.isUnlimite;
    }

    data(){
        return {title,images,price,comparePrice,inventory_quantity,inventory_store,isUnlimite}= this;
    }
}