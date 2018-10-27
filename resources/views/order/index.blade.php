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
                    <div class="username">{{ $order->username }}</div>
                    <div class="userphone">{{ $order->phone }}</div>
                    <div class="address">{{ $order->number_address }} - {{ $order->address }}</div>
                    <div class="starttime">{{ $order->start_time }}</div>
                    <div class="state">{{ $order->state }}</div>
                    <div class="promotion_code">{{ $order->promotion_code }}</div>
                    <div class="list_packages">{{ $order->list_packages }}</div>

                    <div class="btn-group">
                        <a href="{{ url('/') }}/order/{{ $order->id }}/edit" class="btn btn-primary" style="float: left; margin-right: 10px;"><i class="fas fa-edit"></i> Duyệt </a>
                        <form action="{{ url('order/'.$order->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Xóa
                            </button>
                        </form>
                    </div>
                </div>
                <?php	
	               }
            	?>
            </div>
        </div>
    </div>
</div>
@endsection