<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Transformers\OrderTransformer;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = fractal()
                ->collection(Order::get())
                ->parseIncludes(['user'])
                ->transformWith(new OrderTransformer)
                ->toArray();

        return response()->json([
            'status_code' => 200,
            'message' => 'List orders',
            'orders' => $orders
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
            'address' => 'required|string|max:255',
            'note' => 'required|string|max:255',
            'start_time' => 'required|string|max:255',
            'end_time' => 'required|string|max:255',
            'price' => 'required',
            'list_packages' => 'required|string|max:5000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to create the order.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $order = new Order([
            'user_id' => $request->user()->id,
            'address' => $request->address,
            'note' => $request->note,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'user_id' => $request->user()->id,
            'state' => 0,
            'price' => $request->price,
            'pay_type' => $request->pay_type
        ]);

        if($order->save()){
            // add packages
            $list_package = json_decode($request->list_packages);
            foreach ($list_package as $package) {
                $order->packages()->attach($package->package, ['number' => $package->number]);
            }
            $item = fractal()
                ->item($order)
                ->transformWith(new OrderTransformer)
                ->toArray();

            return response()->json([
                'status_code' => 201,
                'message' => 'The order has been created',
                'order' => $item
            ], 201);    
        }else{
            return response()->json([
                'status_code' => 204,
                'message' => 'Failed to create a new order.',
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
        $order = Order::find($id);
        if($order){
            $finder = fractal()
                ->item($order)
                ->parseIncludes(['user'])
                ->transformWith(new OrderTransformer)
                ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'OK',
                'order' => $finder
            ], 200);
        }else{
            return response()->json([
                'status_code' => 204,
                'message' => 'Not found this order.'
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
            'address' => 'required|string|max:255',
            'note' => 'required|string|max:255',
            'start_time' => 'required|string|max:255',
            'end_time' => 'required|string|max:255',
            'price' => 'required',
            'list_packages' => 'required|string|max:5000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to update the order.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $order = Order::find($id);

        if($order){
            $order->address = $request->address;
            $order->note = $request->note;
            $order->start_time = $request->start_time;
            $order->end_time = $request->end_time;
            $order->user_id = $request->user()->id;
            $order->state = 0;
            $order->price = $request->price;
            $order->pay_type = $request->pay_type;
                
            if($order->save()){
                // remove package
                $order->packages()->detach();

                // add packages
                $list_package = json_decode($request->list_packages);
                foreach ($list_package as $package) {
                    $order->packages()->attach($package->package, ['number' => $package->number]);
                }

                $item = fractal()
                    ->item($order)
                    ->transformWith(new OrderTransformer)
                    ->toArray();

                return response()->json([
                    'status_code' => 201,
                    'message' => 'The order has been updated',
                    'order' => $item
                ], 201);    
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to update a order',
                ], 200);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this order.',
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
        $order = Order::find($id);
        if($order){
            if($order->delete()){
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Delete this order successfully.'
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to delete this order.'
                ], 202);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this order.',
            ], 200);
        }
    }
}
