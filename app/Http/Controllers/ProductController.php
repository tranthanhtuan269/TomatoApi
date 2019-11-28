<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\ProductTransformer;
use App\Product;
use App\Partner;
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
        $cities         = City::where('active', 1)->get();
        $partners       = Partner::get();
        return view('products.create', ['cities' => $cities, 'partners' => $partners]);
    }

    public function store(Request $request){

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:15',
            'image' => 'required|string|max:255'
        ], [
            'name.required' => 'Tên sản phẩm không được bỏ trống',
            'name.max' => 'Tên sản phẩm không dài quá 255 ký tự',
            'price.required' => 'Giá không được bỏ trống',
            'price.max' => 'Giá không dài hơn 15 ký tự',
            'image.required' => 'Sản phẩm phải có ảnh'
        ]);

        if ($validator->fails()) {
            return redirect('products/create')
                        ->withErrors($validator)
                        ->withInput();
        }

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
        $cities         = City::where('active', 1)->get();
        $partners       = Partner::get();
        $product        = Product::find($id);
        return view('products.edit', ['cities' => $cities, 'partners' => $partners, 'product' => $product]);
    }

    public function update(Request $request, $id){
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:15',
            'image' => 'required|string|max:255'
        ], [
            'name.required' => 'Tên sản phẩm không được bỏ trống',
            'name.max' => 'Tên sản phẩm không dài quá 255 ký tự',
            'price.required' => 'Giá không được bỏ trống',
            'price.max' => 'Giá không dài hơn 15 ký tự',
            'image.required' => 'Sản phẩm phải có ảnh'
        ]);

        if ($validator->fails()) {
            return redirect('products/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

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
