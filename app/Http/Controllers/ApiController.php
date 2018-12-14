<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\PackageTransformer;
use App\Transformers\ServiceTransformer;
use App\Transformers\OrderTransformer;
use App\Transformers\NewsTransformer;
use App\Transformers\UserTransformer;
use App\Common\Helper;
use Carbon\Carbon;
use App\Feedback;
use App\Setting;
use App\Service;
use App\Package;
use App\Coupon;
use App\News;
use App\Order;
use App\User;
use App\Page;
use Validator;
use Cache;
use Mail;

class ApiController extends Controller
{
    
    private $services;
    private $parentServices;

    public function __construct()
    {
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
    public function serviceIndex(Request $request)
    {
        $service = fractal()
                ->collection(Service::where('active', 1)->get())
                ->transformWith(new ServiceTransformer)
                ->toArray();

        return response()->json([
            'status_code' => 200,
            'message' => 'List service',
            'service' => $this->services
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function serviceShow($id)
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
        // $services = Service::where('parent_id', '=', $id)->where('active', 1)->get();
        if($id == 0){
            $services = Service::where('parent_id', '=', $id)->where('active', 1)->get();

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
        }else{
            return response()->json([
                'status_code' => 200,
                'message' => 'OK',
                'service' => $this->services[$id]
            ], 200);
        }
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userIndex(Request $request)
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
                $user->code = Helper::processCode($request->phone);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userShow($id)
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
    public function userUpdate(Request $request, $id)
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
                $presenter = User::where("code", $request->presenter_id)->first();
                if(isset($presenter)){
                    $user->presenter_id = $request->presenter_id;
                }
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
                    'user' => $updated
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
    public function userUpdateIOS(Request $request, $id)
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
                $presenter = User::where("code", $request->presenter_id)->first();
                if(isset($presenter)){
                    $user->presenter_id = $request->presenter_id;
                }
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userOrders(Request $request)
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
    public function userNewOrders(Request $request)
    {
        $user = Helper::checkAuth($request->phone, $request->access_token);
        $orders = [];
        if(isset($user)){
            $orders = fractal()
                ->collection(Order::where("user_id", $user->id)->where('start_time', '>=', time() * 1000)->get())
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
    public function userOldOrders(Request $request)
    {
        $user = Helper::checkAuth($request->phone, $request->access_token);
        $orders = [];
        if(isset($user)){
            $orders = fractal()
                ->collection(Order::where("user_id", $user->id)->where('start_time', '<', time() * 1000)->get())
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
    public function orderIndex(Request $request)
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
    public function orderStore(Request $request)
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
            // check promotion code is exist in database;
            $coupon = Coupon::where("name", $request->promotion_code)->first();
            $order = new Order([
                'user_id' => $user->id,
                'address' => $request->address,
                'number_address' => $request->number_address,
                'note' => $request->note,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'state' => 0,
                'service_id' => $request->service_id,
                'status_payment' => isset($request->status_payment) ? $request->status_payment : 0,
                'price' => $request->price,
                'real_price' => $request->price,
                'username' => $request->username,
                'email' => $request->email,
                'promotion_code' => $request->promotion_code,
                'coupon_value' => isset($coupon) ? $coupon->value : 0,
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

                // send email to Admin
                \Mail::send('emails.created_job', ['job' => $order], function($message) use ($order){
                    $message->from('postmaster@hspvietnam.com', 'hspvietnam.com');
                    $message->to('tran.thanh.tuan269@gmail.com')->subject('HSP thông báo đăng ký thành công!');
                });

                // send email to setting
                $emaiSetting = \App\Setting::where('key', 'adminEmail')->first();
                \Mail::send('emails.created_job', ['job' => $order], function($message) use ($emaiSetting){
                    $message->from('postmaster@hspvietnam.com', 'hspvietnam.com');
                    $message->to($emaiSetting->value)->subject('HSP thông báo đăng ký thành công!');
                });

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
    public function orderShow($id)
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
    public function orderUpdate(Request $request, $id)
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

                    if(isset($request->list_packages) && strlen($request->list_packages) > 0){
                        // remove package
                        $order->packages()->detach();

                        // add packages
                        $list_package = json_decode($request->list_packages);
                        foreach ($list_package as $package) {
                            $order->packages()->attach($package->package_id, ['number' => $package->number]);
                        }
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderUploadImage(Request $request, $id)
    {
        // dd($request->id);
        $validator = \Validator::make($request->all(), [
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

            $order = Order::find($id);

            if($order){
                if(isset($request->image)){
                    $part = base_path('public/images/');
                    $filename = rand()."_".time().'.jpeg';
                    $destinationfile = $part.$filename;
                    
                    $image = $request->image;
                    if(file_put_contents($destinationfile, base64_decode($image)))
                    {
                        $order->image = $filename;
                    }
                }

                if($order->save()){
                    $updated = fractal()
                        ->item($order)
                        ->transformWith(new OrderTransformer)
                        ->toArray();

                    return response()->json([
                        'status_code' => 200,
                        'message' => 'The order info has been updated',
                        'group' => $updated
                    ], 200);
                }else{
                    return response()->json([
                        'status_code' => 202,
                        'message' => 'Failed to update the order info.',
                    ], 200);
                }
            }else{
                return response()->json([
                    'status_code' => 404,
                    'message' => 'Not found the order.',
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
    public function orderUploadImageIOS(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
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

            $order = Order::find($id);

            if($order){
                if(isset($request->image)){
                    $part = base_path('public/images/');
                    $filename = rand()."_".time().'.jpeg';
                    $destinationfile = $part.$filename;
                    
                    if(move_uploaded_file($request->image, $destinationfile))
                    {
                        $order->image = $filename;
                    }
                }

                if($order->save()){
                    $updated = fractal()
                        ->item($order)
                        ->transformWith(new OrderTransformer)
                        ->toArray();

                    return response()->json([
                        'status_code' => 200,
                        'message' => 'The order info has been updated',
                        'group' => $updated
                    ], 200);
                }else{
                    return response()->json([
                        'status_code' => 202,
                        'message' => 'Failed to update the order info.',
                    ], 200);
                }
            }else{
                return response()->json([
                    'status_code' => 404,
                    'message' => 'Not found the order.',
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
    public function orderDestroy(Request $request, $id)
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
    public function newsIndex()
    {
        $news = fractal()
                ->collection(News::get())
                ->transformWith(new NewsTransformer)
                ->toArray();

        return response()->json([
            'status_code' => 200,
            'message' => 'List news',
            'news' => $news
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function newsShow($id)
    {
        $news = News::find($id);
        if($news){
            $finder = fractal()
                ->item($news)
                ->transformWith(new NewsTransformer)
                ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'OK',
                'news' => $finder
            ], 200);
        }else{
            return response()->json([
                'status_code' => 204,
                'message' => 'Not found this news.'
            ], 200);
        }
    }
    
    public function whyUse(){
            $page = Page::where('key', 'whyUse')->first();
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $page->content
	        ], 200);
    }
    
    public function bestPractices(){
    	$page = Page::where('key', 'bestPractices')->first();
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $page->content
	        ], 200);
    }
    
    public function faqs(){
    	$page = Page::where('key', 'faqs')->first();
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $page->content
	        ], 200);
    }
    
    public function reportAndFeedback(){
    	$page = Page::where('key', 'contact')->first();
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $page->content
	        ], 200);
    }
    
    public function contact(){
    	$page = Page::where('key', 'contact')->first();
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $page->content
	        ], 200);
    }
    
    public function legal(){
        $page = Page::where('key', 'legal')->first();
        return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'content' => $page->content
            ], 200);
    }
    
    public function coupon(){
    	$page = Page::where('key', 'coupon')->first();
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $page->content
	        ], 200);
    }
    
    public function about(){
    	$page = Page::where('key', 'about')->first();
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $page->content
	        ], 200);
    }

    public function favoriteTasker(){
        $page = Page::where('key', 'favoriteTasker')->first();
        return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'content' => $page->content
            ], 200);
    }

    public function hspinfo(){
        $page = Page::where('key', 'hspinfo')->first();
        return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'content' => $page->content
            ], 200);
    }

    public function getContent(Request $request){
        if(isset($request->phone) && isset($request->type)){
            $user = User::where('phone', Helper::removePlusInPhone($request->phone))->first();
            if(isset($user)){
                $page = Page::where('key', $request->type)->first();
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Success',
                    'content' => $user->code,
                    'content2' => $page->content
                ], 200);
            }
        }

        if(isset($request->type)){
            if(!isset($request->type2)){
                $page = Page::where('key', $request->type)->first();
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Success',
                    'content' => $page->content
                ], 200);
            }else{
                $page = Page::where('key', $request->type)->first();
                $page2 = Page::where('key', $request->type2)->first();
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Success',
                    'content' => $page->content,
                    'content2' => $page2->content
                ], 200);
            }
        }
    }  

    public function pages(Request $request){
        $page = Page::where('key', $request->type)->first();
        return view('page.edit', ['page' => $page]);
    }
    
    public function uploadImage(Request $request){
        $img_file = '';
        if (isset($request->base64)) {
            $data = $request->base64;

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $filename = time() . '.png';
            file_put_contents(base_path('public/images/') . $filename, $data);

            return \Response::json(array('code' => '200', 'message' => 'success', 'image_url' => $filename));
        }
        return \Response::json(array('code' => '404', 'message' => 'unsuccess', 'image_url' => ""));
    }

    public function uploadImageApi(Request $request){
        $part = base_path('public/images/');
        $filename = rand(9,9999).basename($_FILES["imageupload"]["name"]);
        $res = array(); 
        $kode = ""; 
        $pesan = ""; 

        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if($_FILES['imageupload'])
            {
                $destinationfile = $part.$filename;
                if(move_uploaded_file($_FILES['imageupload']['tmp_name'], $destinationfile))
                {
                    return \Response::json(array('code' => '200', 'message' => 'success', 'image_url' => $filename));
                }else
                {
                    return \Response::json(array('code' => '403', 'message' => 'unsuccess', 'image_url' => ""));
                }
            }else{
                return \Response::json(array('code' => '404', 'message' => 'unsuccess', 'image_url' => ""));
            }
        }else
        {
            return \Response::json(array('code' => '404', 'message' => 'unsuccess', 'image_url' => ""));
        }
    }

    public function uploadImageApi2(Request $request){
        $part = base_path('public/images/');
        $filename = rand()."_".time().'.jpeg';

        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $image = $_POST['image'];
            $destinationfile = $part.$filename;
            if(file_put_contents($destinationfile, base64_decode($image)))
            {
                return \Response::json(array('code' => '200', 'message' => 'success', 'image_url' => $filename));
            }else
            {
                return \Response::json(array('code' => '403', 'message' => 'unsuccess', 'image_url' => ""));
            }
        }else
        {
            return \Response::json(array('code' => '404', 'message' => 'unsuccess', 'image_url' => ""));
        }
    }

    public function feedbacks(Request $request) 
    {
        if(isset($request->phone) && isset($request->access_token)){
            $user = Helper::checkAuth($request->phone, $request->access_token);
            if(isset($user)){
                $feedback = new Feedback;
                $feedback->user_id = $user->id;
                $feedback->content_feedback = $request->content_feedback;
                if($feedback->save()){
                    return \Response::json(array('code' => '200', 'message' => 'success'));
                }
            }
        }
        return \Response::json(array('code' => '403', 'message' => 'unsuccess'));
    }

    public function checkCoupon(Request $request){
        if(isset($request->service_id) && isset($request->coupon)){
            $coupon = Coupon::where('name', $request->coupon)->where('service_id', 0)->first();

            if(isset($coupon)){
                return \Response::json(array('code' => '200', 'message' => 'success', 'value' => $coupon->value));
            }else{
                $coupon = Coupon::where('name', $request->coupon)->where('service_id', $request->service_id)->first();
                
                if(isset($coupon)){
                    return \Response::json(array('code' => '200', 'message' => 'success', 'value' => $coupon->value));
                }
            }
        }
        return \Response::json(array('code' => '403', 'message' => 'unsuccess'));
    }
}
