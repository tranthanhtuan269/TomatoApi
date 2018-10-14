<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
