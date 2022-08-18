<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('category.category');
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
        $check = Category::where('slug',str()->slug($request->name))->count();
        if($check < 1)
        {
            $request->request->add(['slug' => str()->slug($request->name)]);
        }

        $this->validateFormData($request,'create');
        $fileName = time().str()->random(10).'.'.$request->thumbnail->extension();
        $request->thumbnail->storeAs('public/product_category',$fileName);
        $data = $request->only('name','thumbnail','slug');
        $data['thumbnail'] = $fileName;
        $category = Category::create($data);
        if(empty($category->slug))
        {
            $category->slug = str()->slug($category->name).'-'.$category->id;
        }
        $category->save();
        return redirect()->back()->with('success','Category Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validateFormData($request,'create');
        if($request->hasFile('thumbnail'))
        {
            $fileName = time().str()->random(10).'.'.$request->thumbnail->extension();
            $request->thumbnail->storeAs('public/product_category',$fileName);
            $data['thumbnail'] = $fileName;
        }
        $category->update($data);
        return redirect()->route('category.index')->with('success','Category Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function validateFormData($request,$type)
    {
        $request->validate([
            'name' => ['required'],
            'slug' => ['nullable','unique:categories,slug'],
            'thumbnail' => [$type == 'create' ? 'required' : 'nullable','mimes:jpg,png']
        ]);
    }
}
