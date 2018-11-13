<?php

namespace App\Common;
use App\User;

Class Helper{

    	public static function checkAuth($phone, $access_token){
                        $phone = Helper::removePlusInPhone($phone);
    		$user = User::where("phone", $phone)->first();
    		if(!isset($user)){
    			$user = new User;
    			$user->name = "";
    			$user->display_name = "";
    			$user->avatar = "";
    			$user->email = "";
    			$user->phone = $phone;
    			$user->address = "";
    			$user->city_id = 1;
    			$user->role_id = 2;
    			$user->active = 1;
    			$user->presenter_id = 1;
    			$user->code = $phone;
    			$user->save();
    		}
        		return $user;
    	}

            public static function removePlusInPhone($phone){
                        return str_replace("+", "", $phone);
            }

            public static function processCode($phone){
                        $first = substr($phone, 0, strlen($phone) - 6);
                        $last = substr($phone, strlen($phone) - 6, strlen($phone));
                        $lastInt = intval($last) + 111111;
                        $lastOut = substr($lastInt, 0, 6);
                        return $first . $lastOut;
            }

            public static function payToPresenter($code){
                $user = User::where('code', $code)->first();
                if($user){
                    $user->coin = $user->coin + 10;
                    $user->save();
                }
            }
}