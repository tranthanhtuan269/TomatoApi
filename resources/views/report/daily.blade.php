@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'news'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Daily Report</h3>
            </div>
            <div class="panel-body">
            	<table class="table table-striped">
                            <thead> 
                                <tr> 
                                    <th>#</th> 
                                    <th>User Name</th> 
                                    <th>User Phone</th> 
                                    <th>Value</th> 
                                    <th>Rewards</th> 
                                    <th>Promotional</th> 
                                    <th>Created At</th>
                                </tr> 
                            </thead>
                            <tbody> 
                                @foreach($orderList as $order)
                                <tr> 
                                    <th scope="row">{{ $order->id }}</th> 
                                    <td>{{ $order->user->name }}</td> 
                                    <td>{{ $order->user->phone }}</td> 
                                    <td><b>{{ $order->price / 1000 }}</b> K</td> 
                                    <td><b>{{ $order->rewards / 1000 }}</b> K</td> 
                                    <td><b>{{ $order->promotional / 1000 }}</b> K</td> 
                                    <td>{{ $order->created_at }}</td> 
                                </tr>
                                @endforeach
                            </tbody>
                       </table>
            </div>
        </div>
    </div>
</div>
@endsection