<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\ServiceTransformer;
use App\Transformers\ServiceTransformerWeb;
use App\Service;
use App\Package;
use App\Partner;
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
            return Service::where('parent_id', 0)->where('active', 1)->orderBy('index', 'asc')->get();
        });

        $this->services = Cache::remember('services', 1440, function() {
            $arr = [];
            foreach($this->parentServices as $obj){
                $obj2 = Service::where('parent_id', '=', $obj->id)->where('active', 1)->orderBy('index', 'asc')->get();
                $arr[$obj->id] = fractal()
                    ->collection($obj2)
                    ->parseIncludes(['packages', 'services'])
                    ->transformWith(new ServiceTransformer)
                    ->toArray();
            }
            return $arr;
        });

        Cache::forget('servicesWeb');
        $this->servicesWeb = Cache::remember('servicesWeb', 1440, function() {
            $arr = [];
            foreach($this->parentServices as $key=>$obj){
                $obj2 = Service::where('parent_id', '=', $obj->id)->where('active', 1)->orderBy('index', 'asc')->get();
                $arr[$key] = fractal()
                    ->collection($obj2)
                    ->parseIncludes(['packages', 'services'])
                    ->transformWith(new ServiceTransformerWeb)
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
        // dd($this->servicesWeb);
        return view('service.index');
    }

    public function createWeb(){
        $parentList = Service::where('parent_id', 0)->get();
        $partnerList = Partner::where('active', 1)->pluck('name', 'id');
        return view('service.create', ['parentList' => $parentList, 'partnerList' => $partnerList]);
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
        $service->partner_id = $request->partner_id;
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
        $service = Service::find($request->id);
        $service->parent_id = $request->parent_id;
        $service->save();

        // sort parent_id
        $list = explode(",",rtrim($request->order_list, ','));
        foreach($list as $k=>$id){
            $service = Service::find($id);
            $service->index = $k;
            $service->save();
        }
        return response()->json([
                    'status_code' => 200,
                    'message' => 'Sort services successfully.'
                ], 200);
    }

    public function editWeb($id){
        $service = Service::find($id);
        $parentList = Service::where('parent_id', 0)->get();
        $partnerList = Partner::where('active', 1)->pluck('name', 'id');
        return view('service.edit', ['service' => $service, 'parentList' => $parentList, 'partnerList' => $partnerList]);
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
        $service->partner_id = $request->partner_id;
        $service->icon = $request->icon;
        $service->save();
        return redirect('/services');
    }

    public function save(Request $request){
        Cache::forget('services');
        Cache::forget('parentServices');
        // Service::update(['active' => 0]);
        \DB::table('services')->update(['active' => 0]);
        $content = json_decode(json_decode($request->content, true), true);
        foreach($content as $key=>$object){
            if(isset($object["id"])){
                $service = Service::find($object["id"]);
                if($service){
                    $service->name      = $object["text"];
                    $service->name_en   = $object["name_en"];
                    $service->name_ja   = $object["name_ja"];
                    $service->name_ko   = $object["name_ko"];
                    $service->icon      = $object["icon"];
                    $service->parent_id = 0;
                    $service->index     = $key;
                    $service->active    = 1;
                    $service->save();

                    if(isset($service["children"])){
                        // foreach proccess children
                        foreach($service["children"] as $key2=>$object2){
                            if(isset($object2["id"])){
                                $service2 = Service::find($object2["id"]);
                                if($service2){
                                    $service2->name         = $object2["text"];
                                    $service2->name_en      = $object2["name_en"];
                                    $service2->name_ja      = $object2["name_ja"];
                                    $service2->name_ko      = $object2["name_ko"];
                                    $service2->icon         = $object2["icon"];
                                    $service2->parent_id    = $object->id;
                                    $service2->index        = $key2;
                                    $service2->active       = 1;
                                    $service2->save();

                                    if(isset($service2["children"])){
                                        // foreach proccess children
                                        foreach($service2["children"] as $key3=>$object3){
                                            if(isset($object3["id"])){
                                                $service3 = Service::find($object3["id"]);
                                                if($service3){
                                                    $service3->name         = $object3["text"];
                                                    $service3->name_en      = $object3["name_en"];
                                                    $service3->name_ja      = $object3["name_ja"];
                                                    $service3->name_ko      = $object3["name_ko"];
                                                    $service3->icon         = $object3["icon"];
                                                    $service3->parent_id    = $object2->id;
                                                    $service3->index        = $key3;
                                                    $service3->active       = 1;
                                                    $service3->save();
                                                }else{
                                                    $service3               = new Service;
                                                    $service3->name         = $object3["text"];
                                                    $service3->name_en      = $object3["name_en"];
                                                    $service3->name_ja      = $object3["name_ja"];
                                                    $service3->name_ko      = $object3["name_ko"];
                                                    $service3->icon         = $object3["icon"];
                                                    $service3->parent_id    = $object2->id;
                                                    $service3->index        = $key3;
                                                    $service3->active       = 1;
                                                    $service3->save();
                                                }
                                            }else{
                                                $service3               = new Service;
                                                $service3->name         = $object3["text"];
                                                $service3->name_en      = $object3["name_en"];
                                                $service3->name_ja      = $object3["name_ja"];
                                                $service3->name_ko      = $object3["name_ko"];
                                                $service3->icon         = $object3["icon"];
                                                $service3->parent_id    = $object2->id;
                                                $service3->index        = $key3;
                                                $service3->active       = 1;
                                                $service3->save();
                                            }
                                        }
                                    }
                                }else{
                                    $service2               = new Service;
                                    $service2->name         = $object2["text"];
                                    $service2->name_en      = $object2["name_en"];
                                    $service2->name_ja      = $object2["name_ja"];
                                    $service2->name_ko      = $object2["name_ko"];
                                    $service2->icon         = $object2["icon"];
                                    $service2->parent_id    = $object->id;
                                    $service2->index        = $key2;
                                    $service2->active       = 1;
                                    $service2->save();
                                }
                            }else{
                                $service2               = new Service;
                                $service2->name         = $object2["text"];
                                $service2->name_en      = $object2["name_en"];
                                $service2->name_ja      = $object2["name_ja"];
                                $service2->name_ko      = $object2["name_ko"];
                                $service2->icon         = $object2["icon"];
                                $service2->parent_id    = $object->id;
                                $service2->index        = $key2;
                                $service2->active       = 1;
                                $service2->save();
                            }
                        }
                    }
                }else{
                    $service            = new Service;
                    $service->name      = $object["text"];
                    $service->name_en   = $object["name_en"];
                    $service->name_ja   = $object["name_ja"];
                    $service->name_ko   = $object["name_ko"];
                    $service->icon      = $object["icon"];
                    $service->parent_id = 0;
                    $service->index     = $key;
                    $service->active    = 1;
                    $service->save();
                }
            }else{
                $service            = new Service;
                $service->name      = $object["text"];
                $service->name_en   = $object["name_en"];
                $service->name_ja   = $object["name_ja"];
                $service->name_ko   = $object["name_ko"];
                $service->icon      = $object["icon"];
                $service->parent_id = 0;
                $service->index     = $key;
                $service->active    = 1;
                $service->save();
            }
        }
        return response()->json([
                    'status_code' => 200,
                    'message' => 'Save services successfully.'
                ], 200);
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
