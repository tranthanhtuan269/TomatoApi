@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'partner'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Sửa đối tác</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['url' => 'partners/' . $partner->id, 'class' => 'form-horizontal']) !!}
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tên đối tác</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $partner->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Số điện thoại</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{ $partner->phone }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $partner->email }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Trạng thái</label>
                        <div class="col-sm-10">
                            {!! Form::select('active', [0 => 'inactive', 1 => 'active'], $partner->active, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Lưu lại</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  });
</script>
@endsection