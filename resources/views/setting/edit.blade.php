@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'services'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        {!! Form::open(['url' => 'settings/' . $setting->id, 'class' => 'form-horizontal']) !!}
        @method('PUT')
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Edit "{{ $_GET["type"] }}" Setting</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-12" style="color:red;"><b><i>{{ $setting->key }}</i></b></div>
                    <div class="col-sm-12">
                    <input type="text" class="form-control" name="value" placeholder="Name" value="{{ $setting->value }}">
                    </div>
                </div>
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