<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\NewsTransformer;
use App\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:2000',
            'author' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to create the news.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $news = new News([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author
        ]);

        if($news->save()){
            return response()->json([
                'status_code' => 201,
                'message' => 'The news has been created',
                'news' => $news
            ], 201);    
        }else{
            return response()->json([
                'status_code' => 204,
                'message' => 'Failed to create a new news.',
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:2000',
            'author' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to update the news.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $news = News::find($id);

        if($news){
            $news->title = $request->title;
            $news->content = $request->content;
            $news->author = $request->author;
                
            if($news->save()){

                $item = fractal()
                    ->item($news)
                    ->transformWith(new NewsTransformer)
                    ->toArray();

                return response()->json([
                    'status_code' => 201,
                    'message' => 'The news has been updated',
                    'news' => $item
                ], 201);    
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to update a news',
                ], 200);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this news.',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        if($news){
            if($news->delete()){
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Delete this news successfully.'
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to delete this news.'
                ], 202);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this news.',
            ], 200);
        }
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
