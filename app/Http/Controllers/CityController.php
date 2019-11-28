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
