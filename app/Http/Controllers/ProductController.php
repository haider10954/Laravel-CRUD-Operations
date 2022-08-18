<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('getCategory')->get();
        return view('product', ["products" => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        return view('products.add_product', ["categories" => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $fileName = time() . str()->random(10) . '.' . $request->thumbnail->extension();
        // $request->image->storeAs('public/product',$fileName);
        $request->thumbnail->storeAs('public/product_thumbnail', $fileName);
        $data = $request->except('_token');
        $images = [];
        foreach ($request->image as $image) {
            $imageName = time() . str()->random(10) . '.' . $image->extension();
            $image->storeAs('public/product_images', $imageName);
            $images[] = $imageName;
        }

        $data['image'] = $images;

        $data['thumbnail'] = $fileName;
        $product = Product::create($data);
        $product->save();
        return redirect()->route('product.index')->with('success', 'Product Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        $categories = Category::all();
        return view('products.edit_product')->with('product', $product)->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        if($request->hasFile('$request'))
        {
            $fileName = time() . str()->random(10) . '.' . $request->thumbnail->extension();
            $request->thumbnail->storeAs('public/product_thumbnail', $fileName);
            $data['thumbnail'] = $fileName;
        }
        if($request->hasFile('$request'))
        {
            $images = [];
            foreach ($request->image as $image) {
                $imageName = time() . str()->random(10) . '.' . $image->extension();
                $image->storeAs('public/product_images', $imageName);
                $images[] = $imageName;
            }
            $data['image'] = $images;
        }
        $product->update($data);
        return redirect()->route('product.index')->with('success', 'Product Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
