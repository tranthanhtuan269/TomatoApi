<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function accept(Request $request){
        if(isset($request->user_id) || isset($request->group_id)){
            $user = User::find($request->user_id);
            $group = Group::find($request->group_id);

            if($group && $user){
                if(!$user->checkInGroup($request->group_id)){
                    if($group->users()->save($request->user_id)){
                        $finder = fractal()
                            ->item($group)
                            ->parseIncludes(['users'])
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
                    $finder = fractal()
                            ->item($group)
                            ->parseIncludes(['users'])
                            ->transformWith(new GroupTransformer)
                            ->toArray();

                        return response()->json([
                            'status_code' => 200,
                            'message' => 'OK',
                            'group' => $finder
                        ], 200);
                }
            }else if($user){
                return response()->json([
                    'status_code' => 404,
                    'message' => 'Not found this user.',
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 404,
                    'message' => 'Not found this group.',
                ], 200);
            }
        }else{
            return response()->json([
                    'status_code' => 400,
                    'message' => 'User or Group are null.',
                ], 200);
        }
    }

    public function reject(Request $request){
        $group = Group::find($id);

        if($group){
            if($group->users()->detach($request->user()->id)){
                $finder = fractal()
                    ->item($group)
                    ->parseIncludes(['users'])
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
}
