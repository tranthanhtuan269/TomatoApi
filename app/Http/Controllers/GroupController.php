<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\GroupTransformer;
use App\Group;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = fractal()
                ->collection(Group::get())
                ->parseIncludes(['users'])
                ->transformWith(new GroupTransformer)
                ->toArray();

        return response()->json([
            'status_code' => 200,
            'message' => 'List groups',
            'groups' => $groups
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_name' => 'required|string|max:255'
        ]);
        $group = new Group([
            'group_name' => $request->group_name
        ]);
        $group->save();

        $item = fractal()
                ->item($group)
                ->transformWith(new GroupTransformer)
                ->toArray();

        return response()->json([
            'status_code' => 201,
            'message' => 'Successfully Created Group!',
            'groups' => $item
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::find($id);
        if($group){
            return fractal()
                ->item($group)
                ->parseIncludes(['users'])
                ->transformWith(new GroupTransformer)
                ->toArray();
        }
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
        $request->validate([
            'group_name' => 'required|string|max:255'
        ]);

        $group = Group::find($id);
        if($group){
            $group->group_name = $request->group_name;
            $group->save();
            return fractal()
                ->item($group)
                ->transformWith(new GroupTransformer)
                ->toArray();
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
        $group = Group::find($id);
        if($group){
            $group->delete();
        }
    }
}
