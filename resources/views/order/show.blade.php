@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'daily'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Hiển thị chi tiết của đơn - {{ $order->id }} </h3>
            </div>
            <div class="panel-body">
                <div class="row order-row">
                    <div class="title-order">
                        <b><i>Mã đơn - {{ $order->id }}</i></b>
                    </div>
                    <div class="address">Số tiền: <b style="color: red;"><i>{{ $order->price / 1000 }} K</i></b></div>
                    <div class="address">Số tiền thực tế: <b style="color: red;"><i>{{ $order->real_price / 1000 }} K</i></b></div>
                    <div class="address">Sau khi CK: <b style="color: red;"><i>{{ ($order->real_price - $order->rewards - $order->promotional) / 1000 }} K</i></b></div>
                    <div class="starttime">Thời gian đặt hàng: <b><i>{{ date('H:i:s d-m-Y', intval($order->start_time) / 1000) }}</i></b></div>
                    <div class="username">Họ và Tên: <b><i>{{ $order->username }}</i></b></div>
                    <div class="userphone">Số điện thoại: <b><i>+{{ $order->user->phone }}</i></b></div>
                    <div class="address">Địa chỉ: <b><i>{{ $order->number_address }} - {{ $order->address }}</i></b></div>
                    <div class="address">Mã giới thiệu: <b><i>{{ $order->user->presenter_id }}</i></b></div>
                    <div class="promotion_code">Mã giảm giá: <b><i>@if(isset($order->promotion_code)) {{ $order->promotion_code }} @else Không có @endif</i></b></div>
                    <div class="list_packages">
                        <ul>
                            @foreach($order->packages as $package)
                            <li>{{ $package->pivot->number }} {{ $package->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection