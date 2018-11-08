@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'accepted'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">List Accepted Orders </h3>
            </div>
            <div class="panel-body">
            	<?php
        	       foreach($orders as $order){

        	    ?>
        	    <div class="row order-row">
                    <div class="title-order"><b><i>ORDER-{{ $order->id }}</i></b></div>
                    <div class="starttime">Thời gian bắt đầu: <b><i>{{ date('H:i:s d-m-Y', intval($order->start_time) / 1000) }}</i></b></div>
                    <div class="username">Họ và Tên: <b><i>{{ $order->username }}</i></b></div>
                    <div class="userphone">Số điện thoại: <b><i>+{{ $order->user->phone }}</i></b></div>
                    <div class="address">Địa chỉ: <b><i>{{ $order->number_address }} - {{ $order->address }}</i></b></div>
                    <div class="address">Số tiền: <b><i>{{ $order->price }} VNĐ</i></b></div>
                    <div class="address">Mã giới thiệu: <b><i>{{ $order->user->presenter_id }}</i></b></div>
                    <div class="promotion_code">Mã giảm giá: <b><i>@if(isset($order->promotion_code)) {{ $order->promotion_code }} @else Không có @endif</i></b></div>
                    <div class="list_packages">
                        <ul>
                            @foreach($order->packages as $package)
                            <li>{{ $package->pivot->number }} {{ $package->name }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="accept-remove">
                        <form action="{{ url('orders/'.$order->id.'/paid') }}" method="POST" style="float: left; margin: 0 10px 10px 0;">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> Thanh toán
                            </button>
                        </form>
                        <form action="{{ url('orders/'.$order->id.'/cancel') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Hủy
                            </button>
                        </form>
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