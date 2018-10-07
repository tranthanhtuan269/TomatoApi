<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transformers\UserTransformer;
use App\Transformers\OrderTransformer;
use App\Common\Helper;
use Carbon\Carbon;
use App\Order;
use App\User;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $users = fractal()
                    ->collection(User::get())
                    ->parseIncludes(['groups'])
                    ->transformWith(new UserTransformer)
                    ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'List users',
                'users' => $users
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user){
            $finder = fractal()
                ->item($user)
                ->parseIncludes(['groups'])
                ->transformWith(new UserTransformer)
                ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'OK',
                'group' => $finder
            ], 200);
        }else{
            return response()->json([
                'status_code' => 204,
                'message' => 'Not found this user.'
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
            'name' => 'required|string|min:3|max:255|unique:users,name,'.$id,
            'display_name' => 'string|max:255',
            'email' => 'required|string|email|min:6|max:255|unique:users,email,'.$id,
            'phone' => 'required|string|min:10|max:15',
            'access_token' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to update the user info.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $user = Helper::checkAuth($request->phone, $request->access_token);

        if($user){
            $user->name = $request->name;
            $user->display_name = $request->display_name;
            $user->email = $request->email;
            $user->avatar = $request->avatar;
            $user->address = $request->address;
            $user->city_id = $request->city_id;
            
            if($user->save()){
                $updated = fractal()
                    ->item($user)
                    ->transformWith(new UserTransformer)
                    ->toArray();

                return response()->json([
                    'status_code' => 200,
                    'message' => 'The user info has been updated',
                    'group' => $updated
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to update the user info.',
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
    public function destroy(Request $request)
    {
        $user = Helper::checkAuth($request->phone, $request->access_token);
        if($user){
            if($user->delete()){
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Delete this user successfully.'
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to delete this user.',
                ], 202);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this user.',
            ], 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orders(Request $request)
    {
        $user = Helper::checkAuth($request->phone, $request->access_token);
        $orders = [];
        if(isset($user)){
            $orders = fractal()
                ->collection(Order::where("user_id", $user->id)->get())
                ->transformWith(new OrderTransformer)
                ->toArray();    
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'List orders',
            'orders' => $orders
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newOrders(Request $request)
    {
        $user = Helper::checkAuth($request->phone, $request->access_token);
        $orders = [];
        if(isset($user)){
            $orders = fractal()
                ->collection(Order::where("user_id", $user->id)->where('created_at', '>=', date('Y-m-d').' 00:00:00')->get())
                ->transformWith(new OrderTransformer)
                ->toArray();    
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'List orders',
            'orders' => $orders
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function oldOrders(Request $request)
    {
        $user = Helper::checkAuth($request->phone, $request->access_token);
        $orders = [];
        if(isset($user)){
            $orders = fractal()
                ->collection(Order::where("user_id", $user->id)->where('created_at', '<', date('Y-m-d').' 00:00:00')->get())
                ->transformWith(new OrderTransformer)
                ->toArray();    
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'List orders',
            'orders' => $orders
        ], 200);
    }
}