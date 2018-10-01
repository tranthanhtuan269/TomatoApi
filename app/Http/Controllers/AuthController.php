<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transformers\UserTransformer;
use App\Common\Helper;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller{

  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'phone' => 'required|string|min:10|max:15',
            'access_token' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to login.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        if(Helper::checkAuth($request->phone, $request->access_token)){
            return response()->json([
                'status_code' => 200,
                'message' => 'Successfully Logined'
            ]);
        }else{
            return response()->json([
                'status_code' => 401,
                'message' => 'Unauthorized',
                'user_id' => null
            ], 200);
        }        
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'status_code' => 200,
            'message' => 'Successfully logged out'
        ]);
    }
}
