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
                <h3 class="panel-title">Daily Report {{ date("d-m-Y", strtotime($data->name)) }}</h3>
            </div>
            <div class="panel-body">
            <div class="row">
                <div class="col-sm-3">Transaction Number: <b><i>{{ $data->number }}</i></b></div>
                <div class="col-sm-3">Cash flow: <b><i>{{ $data->total / 1000 }}</i></b> K</div>
                <div class="col-sm-3">Commission: <b><i>{{ $data->rewards / 1000 }}</i></b> K</div>
                <div class="col-sm-3">Promotional: <b><i>{{ $data->promotional / 1000 }}</i></b> K</div>
            </div>
            	<table class="table table-striped">
                            <thead> 
                                <tr> 
                                    <th>#</th> 
                                    <th>User Name</th> 
                                    <th>User Phone</th> 
                                    <th>Cost</th> 
                                    <th>Commission</th> 
                                    <th>Promotional</th> 
                                    <th>Created At</th>
                                    <th></th>
                                </tr> 
                            </thead>
                            <tbody> 
                                @foreach($orderList as $order)
                                <tr> 
                                    <th scope="row">{{ $order->id }}</th> 
                                    @if(isset($order->user))<td>{{ $order->user->name }}</td>@endif
                                    @if(isset($order->user))<td>+{{ $order->user->phone }}</td>@endif
                                    <td class="text-center"><b>{{ $order->price / 1000 }}</b> K</td> 
                                    <td class="text-center"><b>{{ $order->rewards / 1000 }}</b> K</td> 
                                    <td class="text-center"><b>{{ $order->promotional / 1000 }}</b> K</td> 
                                    <td>{{ date("H:i:s", strtotime($order->created_at)) }}</td> 
                                    <td><a href="{{ url('/') }}/orders/{{ $order->id }}"><i class="fas fa-info-circle"></i></a></td> 
                                </tr>
                                @endforeach
                            </tbody>
                       </table>
            </div>
        </div>
    </div>
</div>
@endsection