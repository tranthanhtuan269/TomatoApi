<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function whyUse(){
    	$content = "abc test";
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
	        ], 200);
    }
    
    public function bestPractices(){
    	$content = "abc test";
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
	        ], 200);
    }
    
    public function faqs(){
    	$content = "abc test";
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
	        ], 200);
    }
    
    public function reportAndFeedback(){
    	$content = "abc test";
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
	        ], 200);
    }
    
    public function contact(){
    	$content = "abc test";
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
	        ], 200);
    }
    
    public function legal(){
    	$content = "abc test";
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
	        ], 200);
    }
    
    public function about(){
    	$content = "abc test";
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
	        ], 200);
    }

    public function favoriteTasker(){
        $content = "abc test";
        return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'content' => $content
            ], 200);
    }

    public function hspinfo(){
    	$content = "hspinfo";
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
	        ], 200);
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
}
