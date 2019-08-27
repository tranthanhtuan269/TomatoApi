@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'services'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        {!! Form::open(['url' => 'settings', 'class' => 'form-horizontal']) !!}
        @method('POST')
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Cấu hình</h3>
            </div>
            <div class="panel-body">

                @foreach($settings as $setting)
                <div class="form-group">
                    <div class="col-sm-12" style="color:red;"><b><i>{{ ucwords($setting->key) }}</i></b></div>
                    <div class="col-sm-12">
                    <input type="text" class="form-control" name="{{ $setting->key }}" placeholder="{{ $setting->key }}" value="{{ $setting->value }}">
                    </div>
                </div>
                @endforeach
                <b>Chú ý:</b> <u><i>Gửi nhiều người cùng lúc theo cú pháp: kiennv@hsp.com, tuantt@hsp.com, hai@hsp.com</i></u>
            </div>
        </div>
                    
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-default">Save</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection