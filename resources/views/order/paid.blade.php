@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'paid'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Danh sách đơn đã thanh toán</h3>
            </div>
            <div class="panel-body">
            	<?php
        	        foreach($orders as $order){
                    $order_level = 0;
                    if(isset($order->user) && $order->user->order_number > 2 && $order->user->order_number < 10){
                        $order_level = 1;
                    }
                    if(isset($order->user) && $order->user->order_number >= 10){
                        $order_level = 2;
                    }
        	    ?>
        	    <div class="row order-row user-order-level-{{ $order_level }}">
                    <div class="col-sm-8">
                        <div class="title-order">
                            <b><i>Mã đơn - {{ $order->id }}</i></b><a href="{{ url('/') }}/orders/{{ $order->id }}/edit" class="edit-order"><i class="fas fa-edit"></i></a>
                        </div>
                        <div class="address">Số tiền: <b style="color: red;"><i>{{ $order->real_price / 1000 }} K</i></b></div>
                        <div class="address">Số tiền thực tế: <b style="color: red;"><i>{{ $order->real_price / 1000 }} K</i></b></div>
                        <div class="address">Sau khi CK: <b style="color: red;"><i>{{ ($order->real_price - $order->rewards - $order->promotional) / 1000 }} K</i></b></div>
                        <div class="starttime">Thời gian đặt hàng: <b><i>{{ date('H:i:s d-m-Y', intval($order->start_time) / 1000) }}</i></b></div>
                        <div class="username">Họ và Tên: <b><i>{{ $order->username }}</i></b></div>
                        @if(isset($order->user))
                        <div class="userphone">Số điện thoại: <b><i>+{{ $order->user->phone }}</i></b></div>
                        @endif
                        <div class="address">Địa chỉ: <b><i>{{ $order->number_address }} - {{ $order->address }}</i></b></div>
                        @if(isset($order->user))
                        <div class="address">Mã giới thiệu: <b><i>{{ $order->user->presenter_id }}</i></b></div>
                        @endif
                        <div class="promotion_code">Mã giảm giá: <b><i>@if(isset($order->promotion_code)) {{ $order->promotion_code }} @else Không có @endif</i></b></div>
                        <div class="list_packages">
                            <ul>
                                @foreach($order->packages as $package)
                                <li>{{ $package->pivot->number }} {{ $package->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        @if(strlen($order->image) > 0)
                        <img src="{{ url('/') }}/public/images/{{ $order->image }}" width="100%">
                        @else 
                        <img src="{{ url('/') }}/public/images/300px-No_image_available.svg.png" width="100%">
                        @endif
                    </div>
                    <hr />
                </div>
                <?php	
	               }
            	?>
                <div class="text-center">{{ $orders->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection