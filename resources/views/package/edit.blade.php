@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">TRANG QUẢN LÝ</h2></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'packages'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Sửa các gói</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['url' => 'packages/' . $package->id, 'class' => 'form-horizontal']) !!}
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $package->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="price" placeholder="Parent Id" value="{{ $package->price }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Service Id</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="service_id" placeholder="Parent Id" value="{{ $package->service_id }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Sửa</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection