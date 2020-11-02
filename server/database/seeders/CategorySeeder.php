<?php

namespace Database\Seeders;

use Database\DataCollection\ProductCollection;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public static function image($model, string $url){
        $model->fakeImage()->create(['url'=>$url]);
    }
    public static function model($model)
    {
        $title = $model['category'];
        $description =  $model['description'];
        $is_active = true;
       
        $slug = Str::slug($model['category']);
        return compact('title','description','slug','is_active');
    }

    public function collection()
    {
        return collect(ProductCollection::collection())->map(function($item){
           $category =  Category::create(static::model($item));
           static::image($category,$item['image']);
           return $category;
           
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
