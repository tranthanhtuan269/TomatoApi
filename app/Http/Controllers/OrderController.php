<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Transformers\OrderTransformer;
use App\Common\Helper;
use App\Setting;
use App\Coupon;
use App\Order;
use App\User;

class OrderController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexWeb()
    {
        $orders = Order::orderBy('start_time', 'desc')->paginate(15);
        return view('order.index', ['orders' => $orders]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newOrder()
    {
        $orders = Order::orderBy('start_time', 'desc')->where('state', 0)->paginate(15);
        foreach ($orders as $order) {
            if($order->promotion_code != '' && $order->promotional != 0){
                if($order->service_id != 0){
                    $coupon = Coupon::where('name', $order->promotion_code)->where('service_id', $order->service_id)->first();
                    if($coupon){
                        $coup = ($order->real_price * intval($coupon->value) / 100);
                        $order->promotional = $coup;
                        $order->save();
                    }else{
                        $order->promotional = 0;
                        $order->save();
                    }  
                }
            }

            if(isset($order->user->presenter_id) && $order->user->presenter_id != ''){
                $user = User::where('code', $order->user->presenter_id)->first();
                if($user){
                    $rewards = Setting::where('key', 'rewards')->first();
                    $order->rewards = intval($rewards->value);
                    $order->save();
                }
            }
        }
        return view('order.new', ['orders' => $orders]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function acceptedOrder()
    {
        $orders = Order::orderBy('start_time', 'desc')->where('state', 1)->paginate(15);
        return view('order.accept', ['orders' => $orders]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paidOrder()
    {
        $orders = Order::orderBy('start_time', 'desc')->where('state', 2)->paginate(15);
        return view('order.paid', ['orders' => $orders]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelOrder()
    {
        $orders = Order::orderBy('start_time', 'desc')->where('state', 3)->paginate(15);
        return view('order.cancel', ['orders' => $orders]);
    }

    public function acceptWeb($id){
        $order = Order::find($id);
        if(isset($order)){
            
            $order->state = 1;
            $order->service_id = Helper::getService($order);

            $order->updated_at = date("Y-m-d H:i:s");
            $order->save();

            // send email to Admin
            \Mail::send('emails.job', ['job' => $order], function($message) use ($order){
                $message->from('postmaster@hspvietnam.com', 'hspvietnam.com');
                $message->to('tran.thanh.tuan269@gmail.com')->subject('HSP thông báo đăng ký thành công!');
            });

            // send email to Partner
            if(isset(Order::getServiceInfo($id))){
                if(isset(Order::getServiceInfo($id)->partner)){
                    if(isset(Order::getServiceInfo($id)->partner->email)){
                        \Mail::send('emails.job', ['job' => $order], function($message) use ($order){
                            $message->from('postmaster@hspvietnam.com', 'hspvietnam.com');
                            $message->to(Order::getServiceInfo($id)->partner->email)->subject('HSP thông báo đăng ký thành công!');
                        });
                    }
                }
            }
        }
        return back();
    }

    public function paidWeb($id){
        $order = Order::find($id);
        if(isset($order)){
            // save to report
            Helper::calculator($order);

            // change status of order
            $order->state = 2;
            $order->updated_at = date("Y-m-d H:i:s");
            $order->save();

            // send email to Admin
            \Mail::send('emails.job', ['job' => $order], function($message) use ($order){
                $message->from('postmaster@hspvietnam.com', 'hspvietnam.com');
                $message->to('tran.thanh.tuan269@gmail.com')->subject('HSP thông báo đăng ký thành công!');
            });
        }
        return back();
    }

    public function cancelWeb($id){
        $order = Order::find($id);
        if(isset($order)){
            $order->state = 3;
            $order->updated_at = date("Y-m-d H:i:s");
            $order->save();
        }
        return back();
    }

    public function editWeb($id){
        $order = Order::find($id);
        return view('order.edit', ['order' => $order]);
    }

    public function updateWeb(Request $request, $id){
        $order = Order::find($id);

        if(isset($order)){
            // rollback old report
            Helper::rollback($order);

            $order->real_price = $request->price;
            $order->save();
            
            // add new price to report
            Helper::calculator($order);
        }
        return redirect('/orders/' . $id);
    }

    public function viewWeb($id){
        $order = Order::find($id);
        return view('order.show', ['order' => $order]);
    }

    public function destroyWeb($id){
        $order = Order::find($id);
        if(isset($order)){
            $order->state = 3;
            $order->updated_at = date("Y-m-d H:i:s");
            $order->save();
        }
        return back();
    }
}
