<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\PackageTransformer;
use App\Transformers\ServiceTransformer;
use App\Transformers\ProductTransformer;
use App\Transformers\OrderTransformer;
use App\Transformers\NewsTransformer;
use App\Transformers\UserTransformer;
use App\Transformers\CityTransformer;
use App\Common\Helper;
use Carbon\Carbon;
use App\Feedback;
use App\Setting;
use App\Service;
use App\Package;
use App\Product;
use App\Coupon;
use App\News;
use App\Order;
use App\User;
use App\Page;
use App\City;
use Validator;
use Cache;
use Mail;

class ApiController extends Controller
{
    
    private $cities;
    private $services;
    private $parentServices;

    public function __construct()
    {   
        Cache::forget('cities');
        $this->cities = Cache::remember('cities', 1440, function() {
            return City::where('active', 1)->get();
        });
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
            'price' => 'required',
            'list_products' => 'required|string|max:5000', 
            'phone' => 'required|string|min:10|max:15',
            'username' => 'required|string|min:3|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to create the order.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $user = Helper::checkAuth($request->phone, $request->username);
        if($user){
            if(!isset($request->username)){
                $username = "";
            }else{
                $username = $request->username;
            }
            if(!isset($request->email)){
                $email = "";
            }else{
                $email = $request->email;
            }
            if(!isset($request->note)){
                $note = "";
            }else{
                $note = $request->note;
            }
            if(!isset($request->promotion_code)){
                $promotion_code = "";
            }else{
                $promotion_code = $request->promotion_code;
            }
            // check promotion code is exist in database;
            $coupon = Coupon::where("name", $promotion_code)->first();
            $order = new Order([
                'user_id' => $user->id,
                'address' => $request->address,
                'number_address' => $request->number_address,
                'note' => $note,
                'state' => 0,
                'status_payment' => isset($request->status_payment) ? $request->status_payment : 0,
                'price' => $request->price,
                'real_price' => $request->price,
                'username' => $username,
                'email' => $email,
                'promotion_code' => $promotion_code,
                'coupon_value' => isset($coupon) ? $coupon->value : 0,
                'list_products' => $request->list_products,
                'pay_type' => $request->pay_type
            ]);

            if($order->save()){
                // add packages
                $list_products = json_decode($request->list_products);
                foreach ($list_products as $product) {
                    $order->products()->attach($product->product_id, ['number' => $product->number]);
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
                // $emaiSetting = \App\Setting::where('key', 'adminEmail')->first();
                // $emaiSetting->value = str_replace(" ","",$emaiSetting->value);
                // $emailArray = explode(",",$emaiSetting->value);

                // \Mail::send('emails.created_job', ['job' => $order], function($message) use ($emailArray){
                //     $message->from('postmaster@hspvietnam.com', 'hspvietnam.com');
                //     $message->to($emailArray)->subject('HSP thông báo đăng ký thành công!');
                // });

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

    public function getCities(Request $request){
        $cities = fractal()
                ->collection($this->cities)
                // ->parseIncludes(['products'])
                ->transformWith(new CityTransformer)
                ->toArray();

        return response()->json([
            'status_code' => 200,
            'message' => 'List cities',
            'cities' => $cities
        ], 200);
    }

    public function getCity(Request $request, $id){
        $city = City::find($id);

        $finder = fractal()
            ->item($city)
            ->parseIncludes(['categories'])
            ->transformWith(new CityTransformer)
            ->toArray();

        return response()->json([
            'status_code' => 200,
            'message' => 'OK',
            'city' => $finder
        ], 200);
    }

    public function getCategories(Request $request, $city_id){
        $categories = fractal()
                ->collection(Category::where('city_id', $city_id)->get())
                // ->parseIncludes(['products'])
                ->transformWith(new CategoryTransformer)
                ->toArray();

        return response()->json([
            'status_code' => 200,
            'message' => 'List category',
            'categories' => $categories
        ], 200);
    }

    public function getCategory(Request $request, $category_id){
        $category = Category::find($category_id);

        $finder = fractal()
            ->item($category)
            ->parseIncludes(['products'])
            ->transformWith(new CategoryTransformer)
            ->toArray();

        return response()->json([
            'status_code' => 200,
            'message' => 'OK',
            'category' => $finder
        ], 200);
    }

    public function getProduct(Request $request, $product_id){
        
        $item = Product::find($product_id);
        if($item){
            $product = fractal()
                    ->item(Product::find($product_id))
                    ->transformWith(new ProductTransformer)
                    ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'Show Product',
                'product' => $product
            ], 200);
        }else{
            return \Response::json(array('code' => '404', 'message' => 'find not found'));
        }
    }

    public function checkCoupon(Request $request, $coupon){
        $coupon = Coupon::where('name', $coupon)->first();
        dd($coupon);
        if($coupon){
            return response()->json([
                'status_code' => 200,
                'message' => 'Coupon value',
                'coupon' => $coupon
            ], 200);
        }else{
            return \Response::json(array('code' => '404', 'message' => 'find not found'));
        }
    }
}
