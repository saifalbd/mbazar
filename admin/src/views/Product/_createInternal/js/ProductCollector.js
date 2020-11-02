import { VariantsCollector } from "./VariantsCollector";

export class ProductCollector {

    constructor(obj){
        this.product = obj.product;
        this.imagesArray = obj.images;
        this.inventory = obj.inventory;
        this.variants = obj.variants;

    }

    get title(){
        return this.product.title;
    }
    get brand_id(){
        return this.product.brand_id;
    }
    get categories(){
        return this.product.categories.map(i=>i.id);
    }

    get images(){
        return this.imagesArray;
    }

    get price(){
        return this.product.price;
    }

    get comparePrice(){
        return this.product.comparePrice;
    }
    get sku(){
        var d = new Date();
        return d.getTime()
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
       return {
            title,
            brand_id,
            categories,
            images,
            price,
            comparePrice,
            sku,
            slug,
            inventory_quantity,
            inventory_store,
            isUnlimite
    } = this;

    }

    //https://www.npmjs.com/package/dot-object

    collection() {
        $product = this.data();
        $collector = new VariantsCollector( $product ,this.variants);
        $product['variants'] = $collector.data();
        return $product;
    }


    

   



}