@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'weekly'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Weekly Report - Week: {{ date("W", strtotime($data->created_at)) }}</h3>
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
                                    <th>Date</th> 
                                    <th>Cash flow</th> 
                                    <th>Commission</th> 
                                    <th>Promotional</th> 
                                    <th>Created At</th>
                                    <th></th>
                                </tr> 
                            </thead>
                            <tbody> 
                                @foreach($dailyList as $daily)
                                <tr> 
                                    <th scope="row">{{ $daily->id }}</th> 
                                    <td>{{ $daily->name }}</td> 
                                    <td class="text-center"><b>{{ $daily->total / 1000 }}</b> K</td> 
                                    <td class="text-center"><b>{{ $daily->rewards / 1000 }}</b> K</td> 
                                    <td class="text-center"><b>{{ $daily->promotional / 1000 }}</b> K</td> 
                                    <td>{{ date("H:i:s", strtotime($daily->created_at)) }}</td> 
                                    <td><a href="{{ url('/') }}/reports/daily?date={{ $daily->name }}"><i class="fas fa-info-circle"></i></a></td> 
                                </tr>
                                @endforeach
                            </tbody>
                       </table>
            </div>
        </div>
    </div>
</div>
@endsection