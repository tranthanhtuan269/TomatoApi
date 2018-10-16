@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">TRANG QUẢN LÝ</h2></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'services'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Sửa dịch vụ</h3>
            </div>
            <div class="panel-body">
            	   <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection