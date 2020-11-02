<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductCreateRepository implements ProductCreateInterface
{

    public int $brandID;
    public array $categories; //[categoryID,categoryID]
    public array $images; //[imageID,imageID]

    public Product $product;



    /**
     * addImage
     *
     * @param  mixed $images
     * @return array
     */
    private function addImage(Array $images) :array //[imageID,imageID]
    { // $images == $request->images
        $ImageRepository = new ImageRepository();
        $models =  $ImageRepository->addManny($images);
      $this->images =  collect( $models)->pluck('id');
      return $this->images;

    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Model $model)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $model)
    {
        //
    }
}
