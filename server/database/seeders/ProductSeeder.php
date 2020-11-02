<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Database\DataCollection\ProductCollection;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use \Illuminate\Support\Arr;

class ProductSeeder extends Seeder
{

    public static function rules(){
        return [
            "isFeatured"=>Arr::random([true,false]),"isFavorite"=>Arr::random([true,false]),"isBest"=>Arr::random([true,false]),"isTopSale"=>Arr::random([true,false])
        ];
        
    }
    
    public static function price(){
        $special = rand(10,500);
        $regular =$special+rand(2,50);
        $sku = rand(1000000,10000000);
        return compact('special','regular','sku');
    }

    public static function image($model, string $url){
        $model->fakeImage()->create(['url'=>$url]);
    }

    public static function model($model,$cat_id,$b_id )
    {
        $title = $model['title'];
        $description =  $model['description'];
        $category_id = $cat_id;
        $brand_id = $b_id;
        $slug = Str::slug($title);
        $is_active = true;
        $rules = static::rules();
        return compact('title','description','category_id','brand_id','slug','is_active','rules');
    }

    public function collection()
    {
        $categories =Category::query()->select('id')->get()->pluck('id')->toArray();
        $brands =Brand::query()->select('id')->get()->pluck('id')->toArray();

        return collect(ProductCollection::collection())->map(function($item) use($categories, $brands){
            $image = $item['image'];
            $cat_id =  Arr::random($categories);
            $b_id =  Arr::random($brands);

            $product = Product::create(static::model($item,$cat_id,$b_id));
            $product->price()->create(static::price());
            static::image( $product,$item['image']);
            return $product;

        });
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->collection();
        
    }
}
