<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\PackageTransformer;
use App\Package;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $packages = fractal()
                ->collection(Package::get())
                ->parseIncludes(['service'])
                ->transformWith(new PackageTransformer)
                ->toArray();

        return response()->json([
            'status_code' => 200,
            'message' => 'List packages',
            'packages' => $packages
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
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:15',
            'image' => 'required|string|max:255',
            'service_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to create the package.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $package = new Package([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
            'service_id' => $request->service_id
        ]);

        if($package->save()){
            $item = fractal()
                ->item($package)
                ->transformWith(new PackageTransformer)
                ->toArray();

            return response()->json([
                'status_code' => 201,
                'message' => 'The package has been created',
                'package' => $item
            ], 201);    
        }else{
            return response()->json([
                'status_code' => 204,
                'message' => 'Failed to create a new package.',
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
        $package = Package::find($id);
        if($package){
            $finder = fractal()
                ->item($package)
                ->parseIncludes(['service'])
                ->transformWith(new PackageTransformer)
                ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'OK',
                'package' => $finder
            ], 200);
        }else{
            return response()->json([
                'status_code' => 204,
                'message' => 'Not found this package.'
            ], 200);
        }
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
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:15',
            'image' => 'required|string|max:255',
            'service_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to update the package.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $package = Package::find($id);

        if($package){
            $package->name = $request->name;
            $package->price = $request->price;
            $package->image = $request->image;
            $package->service_id = $request->service_id;
            if($package->save()){
                $item = fractal()
                    ->item($package)
                    ->transformWith(new PackageTransformer)
                    ->toArray();

                return response()->json([
                    'status_code' => 201,
                    'message' => 'The package has been updated',
                    'package' => $item
                ], 201);    
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to update a package',
                ], 200);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this package.',
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
        $package = Package::find($id);
        if($package){
            if($package->delete()){
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Delete this package successfully.'
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to delete this package.',
                ], 202);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this package.',
            ], 200);
        }
    }
}
