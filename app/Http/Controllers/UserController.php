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
    public function index(Request $request)
    {
        if(isset($request->phone)){
            $find = User::where('phone', Helper::removePlusInPhone($request->phone))->first();
            if($find){
                $users = fractal()
                        ->item($find)
                        ->parseIncludes(['groups'])
                        ->transformWith(new UserTransformer)
                        ->toArray();

                return response()->json([
                    'status_code' => 200,
                    'message' => 'List users',
                    'users' => $users
                ], 200);
            }else{
                $user = new User;
                $user->name = "";
                $user->display_name = "";
                $user->avatar = "";
                $user->email = "";
                $user->phone = $request->phone;
                $user->address = "";
                $user->city_id = 1;
                $user->role_id = 2;
                $user->active = 1;
                $user->presenter_id = 1;
                $user->code = $request->phone;
                $user->save();
                
                return response()->json([
                    'status_code' => 200,
                    'message' => 'List users',
                    'users' => $users
                ], 200);
            }
        }else{
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
        // dd($request->id);
        $validator = \Validator::make($request->all(), [
            // 'name' => 'string|min:3|max:255|unique:users,name,'.$request->id,
            // 'display_name' => 'string|max:255',
            // 'email' => 'string|email|min:6|max:255|unique:users,email,'.$request->id,
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
            if(isset($request->name)){
                $user->name = $request->name;
            }
            // if(isset($request->display_name))
            //     $user->display_name = $request->display_name;
            if(isset($request->email)){
                $user->email = $request->email;
            }

            if(isset($request->presenter_id)){
                $user->presenter_id = $request->presenter_id;
            }

            if(isset($request->avatar)){
                $part = base_path('public/images/');
                $filename = rand()."_".time().'.jpeg';
                $destinationfile = $part.$filename;
                
                $image = $request->avatar;
                if(file_put_contents($destinationfile, base64_decode($image)))
                {
                    $user->avatar = $filename;
                }
            }
            // if(isset($request->address))
            //     $user->address = $request->address;
            // if(isset($request->city_id))
            //     $user->city_id = $request->city_id;
            
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateIOS(Request $request, $id)
    {
        // dd($request->id);
        $validator = \Validator::make($request->all(), [
            // 'name' => 'string|min:3|max:255|unique:users,name,'.$request->id,
            // 'display_name' => 'string|max:255',
            // 'email' => 'string|email|min:6|max:255|unique:users,email,'.$request->id,
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
            if(isset($request->name)){
                $user->name = $request->name;
            }
            // if(isset($request->display_name))
            //     $user->display_name = $request->display_name;
            if(isset($request->email)){
                $user->email = $request->email;
            }

            if(isset($request->presenter_id)){
                $user->presenter_id = $request->presenter_id;
            }

            if(isset($request->avatar)){
                $part = base_path('public/images/');
                $filename = rand()."_".time().'.jpeg';
                $destinationfile = $part.$filename;
                
                $image = $request->avatar;
                if(move_uploaded_file($request->avatar, $destinationfile))
                {
                    $user->avatar = $filename;
                }
            }
            // if(isset($request->address))
            //     $user->address = $request->address;
            // if(isset($request->city_id))
            //     $user->city_id = $request->city_id;
            
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
                ->collection(Order::where("user_id", $user->id)->where('created_at', '>=', time())->get())
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
                ->collection(Order::where("user_id", $user->id)->where('created_at', '<', time())->get())
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
