<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\City;
use Cache;

class CityController extends Controller
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
        return view('cities.index');
    }

    public function view($id){
        $city = City::find($id);
        return view('cities.index', ['city' => $city]);
    }

    public function create(){
        return view('cities.create');
    }

    public function store(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|string|max:255'
        ], [
            'name.required' => 'Tên vùng không được bỏ trống',
            'name.max' => 'Tên vùng không dài quá 255 ký tự',
            'image.required' => 'Vùng phải có ảnh'
        ]);

        if ($validator->fails()) {
            return redirect('cities/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $city               = new City;
        $city->name         = $request->name;
        $city->image        = $request->image;
        $city->save();
        return redirect('/cities');
    }

    public function edit($id){
        $city = City::find($id);
        return view('cities.edit', ['city' => $city]);
    }

    public function update(Request $request, $id){

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|string|max:255'
        ], [
            'name.required' => 'Tên vùng không được bỏ trống',
            'name.max' => 'Tên vùng không dài quá 255 ký tự',
            'image.required' => 'Vùng phải có ảnh'
        ]);

        if ($validator->fails()) {
            return redirect('cities/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $city               = City::find($id);
        $city->name         = $request->name;
        $city->image        = $request->image;
        $city->save();
        return redirect('/cities');
    }

    public function destroy($id){
        $city = City::find($id);
        if(isset($city)){
            $city->delete();
        }
        return back();
    }
}
