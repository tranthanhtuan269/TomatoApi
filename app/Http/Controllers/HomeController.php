<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

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
            if(isset($request->type)){
                $page = Page::where('key', $request->type)->first();
            }
    	
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $page->content
	        ], 200);
    }  

    public function pages(Request $request){
        $page = Page::where('key', $request->type)->first();
        return view('page.edit', ['page' => $page]);
    }

    public function updatePage(Request $request, $id){
        $page = Page::find($id);
        $page->content = $request->content;
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
        // Path to move uploaded files
        $target_path = base_path('public/images/');
         
        // array for final json respone
        $response = array();         
         
        if (isset($_FILES['image']['name'])) {
            $target_path = $target_path . basename($_FILES['image']['name']);
         
            $response['file_name'] = basename($_FILES['image']['name']);
         
            try {
                // Throws exception incase file is not being moved
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                    // make error flag true
                    $response['error'] = true;
                    $response['message'] = 'Could not move the file!';
                }
         
                // File successfully uploaded
                $response['message'] = 'File uploaded successfully!';
                $response['error'] = false;
                $response['file_path'] = $target_path . basename($_FILES['image']['name']);
            } catch (Exception $e) {
                // Exception occurred. Make error flag true
                $response['error'] = true;
                $response['message'] = $e->getMessage();
            }
        } else {
            // File parameter is missing
            $response['error'] = true;
            $response['message'] = 'Not received any file!';
        }
         
        // Echo final json response to client
        echo json_encode($response);
    }
}
