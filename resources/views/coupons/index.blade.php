@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'coupons'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">List Coupon <a href="{{ url('/') }}/coupons/create" class="pull-right"><i class="fas fa-plus"></i> Add Coupon</a> </h3>
            </div>
            <div class="panel-body">
            	<table class="table table-striped">
                            <thead> 
                                <tr> 
                                    <th>#</th> 
                                    <th>Name</th> 
                                    <th>Service</th> 
                                    <th>Value</th> 
                                    <th>Expiration Date</th> 
                                    <th>Created At</th> 
                                    <th>Action</th> 
                                </tr> 
                            </thead>
                            <tbody> 
                                @foreach($coupons as $coupon)
                                <tr> 
                                    <th scope="row">{{ $coupon->id }}</th> 
                                    <td>{{ $coupon->name }}</td> 
                                    <td>
                                        @if(isset($coupon->service))
                                            {{ $coupon->service->name }}
                                        @else
                                            All
                                        @endif
                                    </td> 
                                    <td>{{ $coupon->value }}</td> 
                                    <td>{{ $coupon->expiration_date }}</td> 
                                    <td>{{ $coupon->created_at }}</td> 
                                    <td class="group-control">
                                        <a href="{{ url('/') }}/coupons/{{ $coupon->id }}/edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ url('coupons/'.$coupon->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="delete-btn">
                                                            <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td> 
                                </tr>
                                @endforeach
                            </tbody>
                       </table>
            </div>
        </div>
    </div>
</div>
@endsection