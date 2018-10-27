<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Transformers\OrderTransformer;
use App\Common\Helper;
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
            'start_time' => 'required|string|max:255',
            'end_time' => 'required|string|max:255',
            'price' => 'required',
            'list_packages' => 'required|string|max:5000', 
            'phone' => 'required|string|min:10|max:15',
            // 'access_token' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to create the order.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $user = Helper::checkAuth($request->phone, $request->access_token);
        if($user){
            $order = new Order([
                'user_id' => $user->id,
                'address' => $request->address,
                'number_address' => $request->number_address,
                'note' => $request->note,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'state' => 0,
                'price' => $request->price,
                'username' => $request->username,
                'email' => $request->email,
                'promotion_code' => $request->promotion_code,
                'list_packages' => $request->list_packages,
                'pay_type' => $request->pay_type
            ]);

            if($order->save()){
                // add packages
                $list_package = json_decode($request->list_packages);
                foreach ($list_package as $package) {
                    $order->packages()->attach($package->package_id, ['number' => $package->number]);
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
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found the user.',
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
            // 'address' => 'required|string|max:255',
            'start_time' => 'required|string|max:255',
            'end_time' => 'required|string|max:255',
            // 'price' => 'required',
            // 'list_packages' => 'required|string|max:5000',
            'phone' => 'required|string|min:10|max:15',
            'access_token' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to update the order.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $user = Helper::checkAuth($request->phone, $request->access_token);
        if($user){
            $order = Order::find($id);

            if($order){
                // $order->address = $request->address;
                // $order->number_address = $request->number_address;
                // $order->note = $request->note;
                $order->start_time = $request->start_time;
                $order->end_time = $request->end_time;
                // $order->user_id = $user->id;
                // $order->state = 0;
                // $order->price = $request->price;
                // $order->pay_type = $request->pay_type;
                // $order->username = $request->username;
                // $order->email = $request->email;
                // $order->promotion_code = $request->promotion_code;
                // $order->list_packages = $request->list_packages;
                    
                if($order->save()){
                    // remove package
                    $order->packages()->detach();

                    // add packages
                    $list_package = json_decode($request->list_packages);
                    foreach ($list_package as $package) {
                        $order->packages()->attach($package->package_id, ['number' => $package->number]);
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
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found the user.',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = Helper::checkAuth($request->phone, $request->access_token);
        if($user){
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
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found the user.',
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
        $orders = Order::orderBy('created_at')->paginate(15);
        return view('order.index', ['orders' => $orders]);
    }

    public function destroyWeb($id){
        $news = News::find($id);
        if(isset($news)){
            $news->delete();
        }
        return back();
    }
}
