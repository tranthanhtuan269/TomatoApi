<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\NewsTransformer;
use App\News;

class NewsController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexWeb()
    {
        return view('news.index');
    }

    public function createWeb(){
        return view('news.create');
    }

    public function storeWeb(Request $request){
        $news = new News;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->author = "HSP Admin";
        $news->save();
        return redirect('/news');
    }

    public function editWeb($id){
        $news = News::find($id);
        return view('news.edit', ['news' => $news]);
    }

    public function updateWeb(Request $request, $id){
        $news = News::find($id);
        $news->title = $request->title;
        $news->content = $request->content;
        $news->save();
        return redirect('/news');
    }

    public function destroyWeb($id){
        $news = News::find($id);
        if(isset($news)){
            $news->delete();
        }
        return back();
    }
}
