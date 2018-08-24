<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transformers\UserTransformer;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|min:3|max:255',
            'display_name' => 'string|max:255',
            'email' => 'required|string|email|min:6|max:255|unique:users',
            'password' => 'required|string|confirmed|min:3|max:100',
            'phone_number' => 'required|string|min:10|max:11'
        ]);
        $user = new User([
            'user_name' => $request->user_name,
            'display_name' => $request->display_name,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'avatar' => $request->avatar,
            'address' => $request->address,
            'city_id' => $request->city_id,
            'role_id' => 2,
            'active' => 1,
        ]);
        $user->save();
        return response()->json([
            'status_code' => 201,
            'message' => 'Successfully created user!',
            'user_id' => $user->id
        ], 201);
    }
  
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
        $request->validate([
            'user_name' => 'required|string|min:3|max:255',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['user_name', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'status_code' => 401,
                'message' => 'Unauthorized',
                'user_id' => null
            ], 200);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'status_code' => 200,
            'message' => 'Successfully Logined',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'user_id' => $user->id
        ]);
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
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json([
            'status_code' => 200,
            'message' => 'Get User info success',
            'user' => $request->user()
        ]);
    }
}
