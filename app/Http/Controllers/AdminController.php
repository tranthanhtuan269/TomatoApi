<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Transformers\GroupTransformer;
use App\Group;
use App\User;

class AdminController extends Controller
{
    public function accept(Request $request){
        if(isset($request->user_id) || isset($request->group_id)){
            $user = User::find($request->user_id);
            $group = Group::find($request->group_id);

            if($group && $user){
                if($user->checkInGroup($request->group_id)){
                    $group->users()->updateExistingPivot($user, ['accept' => 1]);
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
                        'status_code' => 404,
                        'message' => 'Join request is not exist!',
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
                    'status_code' => 422,
                    'message' => 'User or Group are null.',
                ], 200);
        }
    }

    public function reject(Request $request){
        if(isset($request->user_id) || isset($request->group_id)){
            $user = User::find($request->user_id);
            $group = Group::find($request->group_id);

            if($group && $user){
                $group->users()->detach($request->user()->id);
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
                    'status_code' => 422,
                    'message' => 'User or Group are null.',
                ], 200);
        }
    }
}
