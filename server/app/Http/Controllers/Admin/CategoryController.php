<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CategoryCollection;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $categories = Category::query()->paginate();
        return new CategoryCollection($categories);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>['required','string','max:100','unique:categories'],
            'image'=>['required','image'],
            'description'=>['required','string','max:1000'],
        ]);

        $title = $request->title;
        $slug = Str::slug($title);
        $description = $request->description;
        $image = $request->file('image');
        $category = Category::create(compact('title','slug','description'));

        $category->addThumb($image);

        return response()->json(new CategoryResource($category),200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title'=>['required','string','max:100',Rule::unique('categories')
            ->whereNot('id', $category->id)->where('title', $request->title)],
            'parent_id'=>['sometimes','required','integer'],
            'active'=>['required','in:0,1'],
            'description'=>['sometimes','string','max:1000'],
            'image'=>['sometimes','required','image'],
        ]);


        $category->title = $request->title;
        $category->parent_id = $request->parent_id;
        $category->is_active = $request->active;
        $category->description = $request->description;
        $category->save();

        $image = $request->file('image');

        if ($image) {
            $category->replaceThumb($image);
        }

        return response()->json(new CategoryResource($category),200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response('',204);
    }
}
