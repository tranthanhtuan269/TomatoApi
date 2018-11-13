<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\User;
use App\Common\Helper;

class HomeController extends Controller
{
    //
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

    public function updatePage(Request $request, $id){
        $page = Page::find($id);
        $page->content = $request->content;
        $page->content_en = $request->content_en;
        $page->content_jp = $request->content_jp;
        $page->content_ko = $request->content_ko;
        $page->save();
        return back();
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
}
