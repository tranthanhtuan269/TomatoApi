@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'orders'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">List Orders </h3>
            </div>
            <div class="panel-body">
            	<?php
        	       foreach($orders as $order){

        	    ?>
        	    <div class="row order-row">
                    <div class="title-order">ORD{{ date("Ymd") }}{{ $order->id }}</div>
                    <div class="starttime">Thời gian bắt đầu: <b><i>{{ date('H:i:s d-m-Y', intval($order->start_time) / 1000) }}</i></b></div>
                    <div class="username">Họ và Tên: <b><i>{{ $order->username }}</i></b></div>
                    <div class="userphone">Số điện thoại: <b><i>+{{ $order->user->phone }}</i></b></div>
                    <div class="address">Địa chỉ: <b><i>{{ $order->number_address }} - {{ $order->address }}</i></b></div>
                    <div class="address">Số tiền: <b><i>{{ $order->price }}</i></b></div>
                    <div class="promotion_code">Mã giảm giá: <b><i>@if(isset($order->promotion_code)) {{ $order->promotion_code }} @else Không có @endif</i></b></div>
                    <div class="list_packages">{{ $order->list_packages }}</div>
                    <div class="list_packages">
                        <ul>
                            @foreach($order->packages as $package)
                            <li>{{ $package->name }} - {{ $package->pivot->number }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="accept-remove">
                        @if($order->state == 0) 
                        <a href="{{ url('/') }}/order/{{ $order->id }}/edit" class="btn btn-primary" style="float: left; margin-right: 10px;"><i class="fas fa-edit"></i> Duyệt </a>
                        <form action="{{ url('order/'.$order->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Hủy
                            </button>
                        </form>
                        @elseif($order->state == 1) 
                        <a href="{{ url('/') }}/order/{{ $order->id }}/edit" class="btn btn-primary disabled" style="float: left; margin-right: 10px;"><i class="fas fa-edit"></i> Đã Duyệt </a>
                        <form action="{{ url('order/'.$order->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Hủy
                            </button>
                        </form>
                        @else
                        <form action="{{ url('order/'.$order->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger disabled">
                                <i class="fas fa-trash-alt"></i> Đã hủy
                            </button>
                        </form>
                        @endif
                        
                        
                    </div>
                    <hr />
                </div>
                <?php	
	               }
            	?>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection