<?php

namespace Database\Seeders;

use App\Models\Variant;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{


    public function data(){
        return [
            [
                'title'=>'size',
            'options'=>[
                'x','xx','xxx','xl','m','l'
            ],
        ],
        [
            'title'=>'color',
            'options'=>[
                'red','blue','lime','green','black','white'
            ],
        ],
            [
                'title'=>'weight',
            'options'=>[
                '10 grams',
                '100 grams',
                '200 grams',
                '200 grams',
                '300 grams',
                '300 grams',
                '1 kg',
                '2 kg',
                '3 kg',
            ],
        ],
        [
            'title'=>'liquid',
        'options'=>[
            '1 litter',
            '10 litter',
            '100 ml',
        ],
    ],
        ];
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->data())->each(function($item){
            $variant =  $variant =   Variant::create(['title'=>$item['title']]);
            $optipons = array_map(function($i){ return ['title'=>$i];},$item['options']);
        $variant->options()->createMany($optipons);
        });
    }
}
