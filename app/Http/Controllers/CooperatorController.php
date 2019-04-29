<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CooperatorController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = \DB::table('orders')->where("id", -1)->get();
        if(isset($request->search)){
           	$orders = \DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('users.presenter_id', $request->search)
            ->where('orders.state', 2)
            ->where('orders.status', 0)
            ->select('orders.*')
            ->get();
        }
        return view("cooperators.index", ['orderList' => $orders]);
    }

    public function pay(Request $request){
        $orders = \DB::table('orders')->where("id", -1)->get();
        if(isset($request->search)){
            $orders = \DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('users.presenter_id', $request->search)
            ->select('orders.*')
            ->update(['status' => 1]);
        }
        return back();
    }
}
