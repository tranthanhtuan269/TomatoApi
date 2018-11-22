<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\ServiceTransformer;
use App\Service;
use App\Package;
use Cache;

class ServiceController extends Controller
{
    private $services;
    private $parentServices;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->parentServices = Cache::remember('parentServices', 1440, function() {
            return Service::where('parent_id', 0)->where('active', 1)->get();
        });

        $this->services = Cache::remember('services', 1440, function() {
            $arr = [];
            foreach($this->parentServices as $obj){
                $obj2 = Service::where('parent_id', '=', $obj->id)->where('active', 1)->get();
                $arr[$obj->id] = fractal()
                    ->collection($obj2)
                    ->parseIncludes(['packages', 'services'])
                    ->transformWith(new ServiceTransformer)
                    ->toArray();
            }
            return $arr;
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexWeb()
    {
        return view('service.index3');
    }

    public function createWeb(){
        $parentList = Service::where('parent_id', 0)->get();
        return view('service.create', ['parentList' => $parentList]);
    }

    public function storeWeb(Request $request){
        Cache::forget('services');
        Cache::forget('parentServices');
        $service = new Service;
        $service->name = $request->name;
        $service->name_en = $request->name_en;
        $service->name_ja = $request->name_ja;
        $service->name_ko = $request->name_ko;
        $service->parent_id = $request->parent_id;
        $service->icon = $request->icon;
        $service->save();
        return redirect('/services');
    }

    public function activeWeb(Request $request){
        Cache::forget('services');
        Cache::forget('parentServices');
        $service = Service::find($request->id);
        $service->active = !$request->type;
        if($service->save()){
            return response()->json([
                    'status_code' => 200,
                    'message' => 'Active this service successfully.'
                ], 200);
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this service.',
            ], 200);    
        }
    }

    public function sortWeb(Request $request){
        Cache::forget('services');
        Cache::forget('parentServices');
        $dataList = json_decode($request->content);
        $count = 0;
        $parent1 = 0;
        $parent2 = 0;
        foreach($dataList as $obj){
            if($parent1 != $obj->parent1){
                $count = 0;
                $parent1 = $obj->parent1;
            }
            $service = Service::find($obj->id);
            $service->index = $count;
            $service->save();
            $count++;
        }
        return response()->json([
                    'status_code' => 200,
                    'message' => 'Sort services successfully.'
                ], 200);
    }

    public function editWeb($id){
        $service = Service::find($id);
        $parentList = Service::where('parent_id', 0)->get();
        return view('service.edit', ['service' => $service, 'parentList' => $parentList]);
    }

    public function updateWeb(Request $request, $id){
        Cache::forget('services');
        Cache::forget('parentServices');
        $service = Service::find($id);
        $service->name = $request->name;
        $service->name_en = $request->name_en;
        $service->name_ja = $request->name_ja;
        $service->name_ko = $request->name_ko;
        $service->parent_id = $request->parent_id;
        $service->icon = $request->icon;
        $service->save();
        return redirect('/services');
    }

    public function viewWeb($id){
        $packages = Package::where("service_id", $id)->get();
        return view('service.show', ['id' => $id, 'packages' => $packages]);
    }

    public function destroyWeb($id){
        Cache::forget('services');
        Cache::forget('parentServices');
        $service = Service::find($id);
        if(isset($service)){
            $service->delete();
        }
        return back();
    }
}
