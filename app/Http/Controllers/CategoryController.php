<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\City;
use Cache;

class CategoryController extends Controller
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
        return view('categories.index');
    }

    public function view($id){
        $category = Category::find($id);
        return view('categories.index', ['category' => $category]);
    }

    public function create(){
        $cities = City::get();
        return view('categories.create', ['cities' => $cities]);
    }

    public function store(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Tên danh mục không được bỏ trống',
            'name.max' => 'Tên danh mục không dài quá 255 ký tự',
        ]);

        if ($validator->fails()) {
            return redirect('categories/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $category               = new Category;
        $category->name         = $request->name;
        $category->city_id       = $request->city_id;
        $category->save();
        return redirect('/categories');
    }

    public function edit($id){
        $cities = City::get();
        $category = Category::find($id);
        return view('categories.edit', ['cities' => $cities, 'category' => $category]);
    }

    public function update(Request $request, $id){
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Tên danh mục không được bỏ trống',
            'name.max' => 'Tên danh mục không dài quá 255 ký tự',
        ]);

        if ($validator->fails()) {
            return redirect('categories/'. $id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $category               = Category::find($id);
        $category->name         = $request->name;
        $category->city_id      = $request->city_id;
        $category->save();
        return redirect('/categories');
    }

    public function destroy($id){
        $category = Category::find($id);
        if(isset($category)){
            $category->delete();
        }
        return back();
    }
}
