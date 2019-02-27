@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'export'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Order By Cooperators</h3>
            </div>
            <div class="panel-body">
                <div class="col-sm-11">
                    {!! Form::open(['url' => url('/cooperators'), 'method' => 'get', 'class' => 'form-inline']) !!}
                      <div class="form-group">
                        <label for="exampleInputName2">Presenter_id: </label>
                        <input type="text" class="form-control" name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">
                      </div>
                      <button type="submit" class="btn btn-default">Search</button>
                    {!! Form::close() !!}
                </div>
                <div class="col-sm-1 float-right">
                    {!! Form::open(['url' => url('/cooperators/pay'), 'method' => 'post', 'class' => 'form-inline']) !!}
                    <div class="form-group" style="display: none">
                        <label for="exampleInputName2">Presenter_id: </label>
                        <input type="text" class="form-control" name="search" value="{{ $_GET['search'] }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Pay All</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <table class="table table-striped">
                    <thead> 
                        <tr> 
                            <th>#</th> 
                            <th>Order_id</th> 
                            <th class="text-center">Cost</th> 
                            <th>Created At</th>
                        </tr> 
                    </thead>
                    <tbody> 
                        <?php
                            $total_price = 0;
                            ?>
                        @foreach($orderList as $key => $order)
                        <?php
                            $total_price += $order->price;
                            ?>
                        <tr> 
                            <th scope="row"><a href="{{ url('/') }}/orders/{{ $order->id }}">{{ $key + 1 }}</a></th> 
                            <th scope="row"><a href="{{ url('/') }}/orders/{{ $order->id }}">{{ $order->id }}</a></th> 
                            <td class="text-center"><b>{{ $order->price / 1000 }}</b> K</td> 
                            <td>{{ date("H:i:s d/m/Y", strtotime($order->created_at)) }}</td>
                        </tr>
                        @endforeach
                        <tr> 
                            <th colspan="2" scope="row">Total</th>
                            <td colspan="2" class="text-center"><b>{{ $total_price / 1000 }}</b> K</td>
                        </tr>
                    </tbody>
               </table>
    </div>
</div>
@endsection