<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\ProductTransformer;
use App\Product;
use App\Category;
use App\City;
use Cache;

class ProductController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('products.index');
    }

    public function create(){
        $cities = City::where('active', 1)->get();
        return view('products.create', ['cities' => $cities]);
    }

    public function store(Request $request){
        $product = new Product;
        $product->name          = $request->name;
        $product->price         = $request->price;
        $product->sale          = $request->sale;
        $product->image         = $request->image;
        $product->address       = $request->address;
        $product->unit          = $request->unit;
        $product->category_id   = $request->category_id;
        $product->active        = $request->active;
        $product->save();
        return redirect('/products');
    }

    public function edit($id){
        $cities = City::where('active', 1)->get();
        $product = Product::find($id);
        return view('products.edit', ['cities' => $cities, 'product' => $product]);
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        $product->name          = $request->name;
        $product->price         = $request->price;
        $product->sale          = $request->sale;
        $product->image         = $request->image;
        $product->address       = $request->address;
        $product->unit          = $request->unit;
        $product->category_id   = $request->category_id;
        $product->active        = $request->active;
        $product->save();
        return redirect('/products');
    }

    public function destroy($id){
        $product = Product::find($id);
        if(isset($product)){
            $product->delete();
        }
        return back();
    }
}
