<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class HomeController extends Controller
{
    //
    public function whyUse(){
    	$content = "<div>whyUse</div><div>def</div>";
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
	        ], 200);
    }
    
    public function bestPractices(){
    	$content = "<div>bestPractices</div><div>def</div>";
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
	        ], 200);
    }
    
    public function faqs(){
    	$content = "<div>faqs</div><div>def</div>";
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
	        ], 200);
    }
    
    public function reportAndFeedback(){
    	$content = "<div>reportAndFeedback</div><div>def</div>";
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
	        ], 200);
    }
    
    public function contact(){
    	$content = "<div>contact</div><div>def</div>";
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
	        ], 200);
    }
    
    public function legal(){
    	$content = "<div>legal</div><div>def</div>";
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
	        ], 200);
    }
    
    public function about(){
    	$content = "<div>about</div><div>def</div>";
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

    public function getContent(Request $request){
            if(isset($request->type)){
                switch ($request->type) {
                    case 'whyUse':
                        $content = "whyUse";
                        break;
                        
                    case 'bestPractices':
                        $content = "bestPractices";
                        break;
                        
                    case 'faqs':
                        $content = "faqs";
                        break;
                        
                    case 'reportAndFeedback':
                        $content = "reportAndFeedback";
                        break;
                        
                    case 'contact':
                        $content = "contact";
                        break;
                        
                    case 'legal':
                        $content = "legal";
                        break;
                        
                    case 'about':
                        $content = "about";
                        break;
                        
                    case 'favoriteTasker':
                        $content = "favoriteTasker";
                        break;
                        
                    case 'hspinfo':
                        $content = "hspinfo";
                        break;
                    
                    default:
                        $content = "hspinfo";
                        break;
                }
            }
    	
    	return response()->json([
	            'status_code' => 200,
	            'message' => 'Success',
	            'content' => $content
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
