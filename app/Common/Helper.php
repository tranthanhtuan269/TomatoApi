<?php

namespace App\Common;
use App\User;
use App\Setting;
use App\Service;
use App\Coupon;
use App\DailyReport;
use App\WeeklyReport;
use App\MonthlyReport;

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
			$user->code = processCode($phone);
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
            $rewards = Setting::where('key', 'rewards')->first();
            $user->coin = $user->coin + intval($rewards->value);
            if($user->save()){
                return intval($rewards->value);
            }
        }
        return 0;
    }

    public static function rollbackFromPresenter($code){
        $user = User::where('code', $code)->first();
        if($user){
            $rewards = Setting::where('key', 'rewards')->first();
            $user->coin = $user->coin - intval($rewards->value);
            if($user->save()){
                return intval($rewards->value);
            }
        }
        return 0;
    }

    public static function calculator($order){
        $today = date('Y-m-d', $order->start_time / 1000);
        $week = date('Y-W', $order->start_time / 1000);
        $month = date('Y-m', $order->start_time / 1000);
        $dailyReport = DailyReport::where('name', $today)->first();
        $weeklyReport = WeeklyReport::where('name', $week)->first();
        $monthlyReport = MonthlyReport::where('name', $month)->first();

        if(!isset($dailyReport)){
            $dailyReport = new DailyReport;
            $dailyReport->name = $today;
            $dailyReport->number = 0;
            $dailyReport->total = 0;
            $dailyReport->rewards = 0;
            $dailyReport->promotional = 0;
            $dailyReport->save();
        }

        if(!isset($weeklyReport)){
            $weeklyReport = new WeeklyReport;
            $weeklyReport->name = $week;
            $weeklyReport->number = 0;
            $weeklyReport->total = 0;
            $weeklyReport->rewards = 0;
            $weeklyReport->promotional = 0;
            $weeklyReport->save();
        }

        if(!isset($monthlyReport)){
            $monthlyReport = new MonthlyReport;
            $monthlyReport->name = $month;
            $monthlyReport->number = 0;
            $monthlyReport->total = 0;
            $monthlyReport->rewards = 0;
            $monthlyReport->promotional = 0;
            $monthlyReport->save();
        }

        $dailyReport->number = $dailyReport->number + 1;
        $weeklyReport->number = $weeklyReport->number + 1;
        $monthlyReport->number = $monthlyReport->number + 1;

        $dailyReport->total = $dailyReport->total + $order->real_price;
        $weeklyReport->total = $weeklyReport->total + $order->real_price;
        $monthlyReport->total = $monthlyReport->total + $order->real_price;

        if($order->user->presenter_id != '' && $order->user->presenter_id != $order->user->code){
            $rewards = Helper::payToPresenter($order->user->presenter_id);
            $dailyReport->rewards = $dailyReport->rewards + $rewards;
            $weeklyReport->rewards = $weeklyReport->rewards + $rewards;
            $monthlyReport->rewards = $monthlyReport->rewards + $rewards;
            $order->rewards = $rewards;
        }

        if($order->promotion_code != ''){
            $coupon = Coupon::where('name', $order->promotion_code)->first();
            if($coupon){
                $coup = ($order->real_price * intval($coupon->value) / 100);
                $dailyReport->promotional = $dailyReport->promotional + $coup;
                $weeklyReport->promotional = $weeklyReport->promotional + $coup;
                $monthlyReport->promotional = $monthlyReport->promotional + $coup;
                $order->promotional = $coup;
            }
        }

        $dailyReport->save();
        $weeklyReport->save();
        $monthlyReport->save();
        $order->save();
    }

    public static function rollback($order){
        $today = date('Y-m-d', $order->start_time / 1000);
        $week = date('Y-W', $order->start_time / 1000);
        $month = date('Y-m', $order->start_time / 1000);
        $dailyReport = DailyReport::where('name', $today)->first();
        $weeklyReport = WeeklyReport::where('name', $week)->first();
        $monthlyReport = MonthlyReport::where('name', $month)->first();

        if(!isset($dailyReport)){
            $dailyReport = new DailyReport;
            $dailyReport->name = $today;
            $dailyReport->number = 0;
            $dailyReport->total = 0;
            $dailyReport->rewards = 0;
            $dailyReport->promotional = 0;
            $dailyReport->save();
        }

        if(!isset($weeklyReport)){
            $weeklyReport = new WeeklyReport;
            $weeklyReport->name = $week;
            $weeklyReport->number = 0;
            $weeklyReport->total = 0;
            $weeklyReport->rewards = 0;
            $weeklyReport->promotional = 0;
            $weeklyReport->save();
        }

        if(!isset($monthlyReport)){
            $monthlyReport = new MonthlyReport;
            $monthlyReport->name = $month;
            $monthlyReport->number = 0;
            $monthlyReport->total = 0;
            $monthlyReport->rewards = 0;
            $monthlyReport->promotional = 0;
            $monthlyReport->save();
        }

        $dailyReport->number = $dailyReport->number - 1;
        $weeklyReport->number = $weeklyReport->number - 1;
        $monthlyReport->number = $monthlyReport->number - 1;

        $dailyReport->total = $dailyReport->total - $order->real_price;
        $weeklyReport->total = $weeklyReport->total - $order->real_price;
        $monthlyReport->total = $monthlyReport->total - $order->real_price;

        if($order->user->presenter_id != '' && $order->user->presenter_id != $order->user->code){
            $rewards = Helper::rollbackFromPresenter($order->user->presenter_id);
            $dailyReport->rewards = $dailyReport->rewards - $rewards;
            $weeklyReport->rewards = $weeklyReport->rewards - $rewards;
            $monthlyReport->rewards = $monthlyReport->rewards - $rewards;
            $order->rewards = $rewards;
        }

        if($order->promotion_code != ''){
            $coupon = Coupon::where('name', $order->promotion_code)->first();
            if($coupon){
                $coup = ($order->real_price * intval($coupon->value) / 100);
                $dailyReport->promotional = $dailyReport->promotional - $coup;
                $weeklyReport->promotional = $weeklyReport->promotional - $coup;
                $monthlyReport->promotional = $monthlyReport->promotional - $coup;
                $order->promotional = $coup;
            }
        }

        $dailyReport->save();
        $weeklyReport->save();
        $monthlyReport->save();
        $order->save();
    }

    public static function getService($order){
        foreach ($order->packages as $item) {
            return Helper::getParentService($item->service_id);
        }
    }

    public static function getParentService($id){
        $service = Service::find($id);
        if(isset($service)){
            if($service->parent_id == 0)
            {
                return $id;
            }
            return Helper::getParentService($service->parent_id);
        }
    }
}