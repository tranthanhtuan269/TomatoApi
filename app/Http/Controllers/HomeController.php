<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Setting;
use App\User;
use App\Feedback;
use App\DailyExport;
use App\Common\Helper;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Mail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function logout(){
        \Auth::logout();
        return redirect('/');
    }

    public function pages(Request $request){
        $page = Page::where('key', $request->type)->first();
        return view('page.edit', ['page' => $page]);
    }

    public function updatePage(Request $request, $id){
        $page = Page::find($id);
        $page->content = $request->content;
        $page->content_en = $request->content_en;
        $page->content_ja = $request->content_ja;
        $page->content_ko = $request->content_ko;
        $page->save();
        return back();
    }

    public function settings(Request $request){
        $settings = Setting::all();
        return view('setting.edit', ['settings' => $settings]);
    }

    public function storeSettings(Request $request){
        $input = $request->all();
        foreach($input as $k=>$v){
            if($k == "_token" || $k == "_method"){
                continue;
            }else{
                $setting = Setting::where('key', $k)->update(['value' => $v]);
            }
        }
        return back();
    }

    public function export(Request $request) 
    {
        if(!isset($request->date)){
            $today = date("Y-m-d");
        }else{
            $today =  $request->date;
        }

        return (new DailyExport($today))->download('dailyExport.xlsx');
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

    public function test(Request $request){
        // $dataUser = array('email'=>'tran.thanh.tuan269@gmail.com', 'name'=>'Tran Thanh Tuan');
        // Mail::send('emails.hello', [], function($message) use ($dataUser) {
        //     $message->from('admin@hspvietnam.com', 'hspvietnam.com');
        //     $message->to('tran.thanh.tuan269@gmail.com')->subject('HSP thông báo đăng ký thành công!');
        // });
    }
}
