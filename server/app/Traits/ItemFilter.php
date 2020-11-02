<?php

namespace App\Traits;

use App\Item;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

trait ItemFilter
{


    protected function sortKeyExist($val){
       return  count(array_filter(['price_low_to_high',
        'price_high_to_low',
        'alphabetical',
        'saving_high_to_low',
        'saving_low_to_high',
        'offer_high_to_low'],function($item)use ($val){
            return $item===$val;
        }));
    }

    protected function price_low_to_high ($builder){
        return $builder->orderBy('purchase_unitPrice');
    }
    protected function price_high_to_low ($builder){
        return $builder->orderBy('purchase_unitPrice','desc');
    }
    protected function alphabetical ($builder){
        return $builder->orderBy('title');
    }
    protected function saving_high_to_low ($builder){
        return $builder->orderBy('discount_percent');
    }
    protected function saving_low_to_high ($builder){
        return $builder->orderBy('discount_percent','desc');
    }
    protected function offer_high_to_low ($builder){
        return $builder->orderBy('discount_percent');
    }

    public function getSort(Request $request,$builder){

       $sorter = $request->get('item_sorter');
        if($request->has('item_sorter') && $sorter && $this->sortKeyExist($sorter)){
            return call_user_func(array($this, $request->get('item_sorter')),$builder);
        }else {
            return $builder;
        }
    }

}
