<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\ServiceTransformer;
use App\Service;
use App\Package;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $service = fractal()
                ->collection(Service::get())
                ->transformWith(new ServiceTransformer)
                ->toArray();

        return response()->json([
            'status_code' => 200,
            'message' => 'List service',
            'service' => $service
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to create the service.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $service = new Service([
            'icon' => $request->icon,
            'name' => $request->name,
            'parent_id' => isset($request->parent_id) ? $request->parent_id : 0,
        ]);

        if($service->save()){
            $item = fractal()
                ->item($service)
                ->transformWith(new ServiceTransformer)
                ->toArray();

            return response()->json([
                'status_code' => 201,
                'message' => 'The service has been created',
                'service' => $item
            ], 201);    
        }else{
            return response()->json([
                'status_code' => 204,
                'message' => 'Failed to create a new service.',
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        if($service){
            $finder = fractal()
                ->item($service)
                ->transformWith(new ServiceTransformer)
                ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'OK',
                'service' => $finder
            ], 200);
        }else{
            return response()->json([
                'status_code' => 204,
                'message' => 'Not found this service.'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subservice($id)
    {
        $services = Service::where('parent_id', '=', $id)->get();

        $finder = fractal()
            ->collection($services)
            ->parseIncludes(['packages', 'services'])
            ->transformWith(new ServiceTransformer)
            ->toArray();

        return response()->json([
            'status_code' => 200,
            'message' => 'OK',
            'service' => $finder
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to update the service.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $service = Service::find($id);

        if($service){
            $service->icon = $request->icon;
            $service->name = $request->name;
            $service->parent_id = isset($request->parent_id) ? $request->parent_id : 0;
            if($service->save()){
                $item = fractal()
                    ->item($service)
                    ->transformWith(new ServiceTransformer)
                    ->toArray();

                return response()->json([
                    'status_code' => 201,
                    'message' => 'The service has been updated',
                    'service' => $item
                ], 201);    
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to update a service',
                ], 200);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this service.',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        if($service){
            if($service->delete()){
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Delete this service successfully.'
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to delete this service.',
                ], 202);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this service.',
            ], 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexWeb()
    {
        return view('service.index');
    }

    public function createWeb(){
        $parentList = Service::where('parent_id', 0)->get();
        return view('service.create', ['parentList' => $parentList]);
    }

    public function storeWeb(Request $request){
        $service = new Service;
        $service->name = $request->name;
        $service->parent_id = $request->parent_id;
        $service->save();
        return redirect('/services');
    }

    public function editWeb($id){
        $service = Service::find($id);
        $parentList = Service::where('parent_id', 0)->get();
        return view('service.edit', ['service' => $service, 'parentList' => $parentList]);
    }

    public function updateWeb(Request $request, $id){
        $service = Service::find($id);
        $service->name = $request->name;
        $service->parent_id = $request->parent_id;
        $service->save();
        return redirect('/services');
    }

    public function viewWeb($id){
        $packages = Package::where("service_id", $id)->get();
        return view('service.show', ['id' => $id, 'packages' => $packages]);
    }
}
