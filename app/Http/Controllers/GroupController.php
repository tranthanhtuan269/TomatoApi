<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Transformers\GroupTransformer;
use App\Group;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!isset($request->search)){
            $groups = fractal()
                    ->collection(Group::get())
                    ->parseIncludes(['usersActive'])
                    ->transformWith(new GroupTransformer)
                    ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'List groups',
                'groups' => $groups
            ], 200);
        }else{
            $groups = fractal()
                    ->collection(Group::where('group_name', 'like', '%' . $request->search . '%')->get())
                    ->parseIncludes(['usersActive'])
                    ->transformWith(new GroupTransformer)
                    ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'List groups',
                'groups' => $groups
            ], 200);
        }
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
            'group_name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to create the group.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $group = new Group([
            'group_name' => $request->group_name
        ]);

        if($group->save()){
            $item = fractal()
                ->item($group)
                ->transformWith(new GroupTransformer)
                ->toArray();

            return response()->json([
                'status_code' => 201,
                'message' => 'The group has been created',
                'group' => $item
            ], 201);    
        }else{
            return response()->json([
                'status_code' => 204,
                'message' => 'Failed to create a new group.',
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
        $group = Group::find($id);
        if($group){
            $finder = fractal()
                ->item($group)
                ->parseIncludes(['usersActive'])
                ->transformWith(new GroupTransformer)
                ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'OK',
                'group' => $finder
            ], 200);
        }else{
            return response()->json([
                'status_code' => 204,
                'message' => 'Not found this group.'
            ], 200);
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
        $validator = \Validator::make($request->all(), [
            'group_name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to update the group.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $group = Group::find($id);

        if($group){
            $group->group_name = $request->group_name;
            
            if($group->save()){
                $updated = fractal()
                    ->item($group)
                    ->transformWith(new GroupTransformer)
                    ->toArray();

                return response()->json([
                    'status_code' => 200,
                    'message' => 'The group has been updated',
                    'group' => $updated
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to update a group.',
                ], 200);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this group.',
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
        $group = Group::find($id);
        if($group){
            if($group->delete()){
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Delete this group successfully.'
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to delete this group.',
                ], 202);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this group.',
            ], 200);
        }
    }

    public function users(Request $request, $id){
        $group = Group::find($id);
        if($group){
            $users = fractal()
                ->collection($group->users()->get())
                ->transformWith(new UserTransformer)
                ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'List members',
                'users' => $users
            ], 200);    
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this group.',
            ], 200);
        }
    }

    public function join(Request $request, $id){
        $group = Group::find($id);
        if($group){
            if(!$request->user()->checkInGroup($id)){
                $group->users()->attach($request->user()->id, ['accept' => 0]);
                
                $finder = fractal()
                    ->item($group)
                    ->parseIncludes(['usersActive'])
                    ->transformWith(new GroupTransformer)
                    ->toArray();

                return response()->json([
                    'status_code' => 200,
                    'message' => 'OK',
                    'group' => $finder
                ], 200);
            }else{
                $finder = fractal()
                        ->item($group)
                        ->parseIncludes(['usersActive'])
                        ->transformWith(new GroupTransformer)
                        ->toArray();

                return response()->json([
                    'status_code' => 200,
                    'message' => 'OK',
                    'group' => $finder
                ], 200);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this group.',
            ], 200);
        }
    }

    public function leave(Request $request, $id){
        $group = Group::find($id);

        if($group){
            if($group->users()->detach($request->user()->id)){
                $finder = fractal()
                    ->item($group)
                    ->parseIncludes(['usersActive'])
                    ->transformWith(new GroupTransformer)
                    ->toArray();

                return response()->json([
                    'status_code' => 200,
                    'message' => 'OK',
                    'group' => $finder
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to join this group.',
                ], 202);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this group.',
            ], 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function wait(Request $request, $id)
    {
        if(isset($id)){
            $group = Group::find($id);
            if($group){
                $finder = fractal()
                        ->item($group)
                        ->parseIncludes(['usersWait'])
                        ->transformWith(new GroupTransformer)
                        ->toArray();

                return response()->json([
                    'status_code' => 200,
                    'message' => 'Get Group Info',
                    'group' => $finder
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 404,
                    'message' => 'Not found this group.',
                ], 200);
            }
        }else{
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Group_id is null.',
                ], 200);
        }
    }
}
