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
        $setting = Setting::where('key', $request->type)->first();
        return view('setting.edit', ['setting' => $setting]);
    }

    public function updateSettings(Request $request, $id){
        $setting = Setting::find($id);
        $setting->value = $request->value;
        $setting->save();
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
}
