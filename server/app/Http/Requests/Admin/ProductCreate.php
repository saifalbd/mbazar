<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\dataImage;

class ProductCreate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //start product validation
            'product'=>['required','array'],
            'product.title'=>['required','string'],
            'product.price'=>['required','string'],
            'product.comparePrice'=>['required','string'],
            'product.brand_id'=>['nullable','integer'],
            'product.categories'=>['required','array'],
            'product.categories.*'=>['required','integer'],
             //images
             'product.images'=>['required','array'],
             'product.images.*'=>['required','array'],
             'product.images.*.type'=>['required','string'],
             'product.images.*.name'=>['required','string'],
             'product.images.*.size'=>['required','integer'],
             'product.images.*.lastModified'=>['required','integer'],
             'product.images.*.dataUrl'=>['required',new dataImage],
            //start variants validation
            'variants'=>['required','array'],
            'variants.*'=>['required','array'],
             'variants.*.optionTitle'=>['required','string'],
            'variants.*.productTitle'=>['required','string'],
            'variants.*.slug'=>['required','string'],
            'variants.*.variantTitle'=>['required','string'],
            'variants.*.price'=>['required','integer'],
            'variants.*.comparePrice'=>['required','integer'],
            'variants.*.sku'=>['required','integer'],
            'variants.*.variantId'=>['required','integer'],
            'variants.*.inventory_quantity'=>['required_if:isUnlimited,0','integer'],
            'variants.*.inventory_store'=>['required','integer'],
            'variants.*.isUnlimited'=>['required','in:0,1'],
            'variants.*.isDefault'=>['required','in:0,1'],
            'variants.*.categories'=>['required','array'],
            'variants.*.categories.*'=>['required','integer'],
            'variants.*.brandId'=>['nullable','integer'],
            //images
            'variants.*.images'=>['nullable','array'],
            'variants.*.images.*'=>['required','array'],
            'variants.*.images.*.type'=>['required','string'],
            'variants.*.images.*.name'=>['required','string'],
            'variants.*.images.*.size'=>['required','integer'],
            'variants.*.images.*.lastModified'=>['required','integer'],
            'variants.*.images.*.dataUrl'=>['required',new dataImage],
        ];
    }
}
