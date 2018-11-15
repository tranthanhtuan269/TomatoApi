@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'users'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">List User </h3>
            </div>
            <div class="panel-body">
            	<?php
        	       foreach($users as $user){
        	    ?>
        	    <div class="row order-row">
                    <div class="col-sm-4 user-image">
                        <img src="{{ url('/') }}/public/images/{{ $user->avatar }}" width="200" height="200">
                    </div>
                    <div class="col-sm-8 user-info">
                        <div class="title-order"><b><i>USER-{{ $user->id }}</i></b></div>
                        <div class="username">Họ và Tên: <b><i>{{ $user->name }}</i></b></div>
                        <div class="userphone">Số điện thoại: <b><i>+{{ $user->phone }}</i></b></div>
                        <div class="userphone">Email: <b><i>{{ $user->email }}</i></b></div>
                        <div class="address">Địa chỉ: <b><i>{{ $user->address }}</i></b></div>
                        <div class="address">Mã giới thiệu: <b><i>{{ $user->code }}</i></b></div>
                        <div class="address">Người giới thiệu: <b><i>{{ $user->presenter_id }}</i></b></div>
                        <div class="address">Số tiền hiện có: <b style="color:red;"><i>{{ $user->coin / 1000 }}</i></b> K</div>
                    </div>
                    <hr />
                </div>
                <?php	
	               }
            	?>
                <div class="text-center">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection