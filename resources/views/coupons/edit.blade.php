@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'coupons'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Coupon </h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['url' => 'coupons/' . $coupon->id, 'class' => 'form-horizontal']) !!}
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $coupon->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Value</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="value" placeholder="Value" value="{{ $coupon->value }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Service</label>
                        <div class="col-sm-10">
                            {!! Form::select('service_id', $services, $coupon->service_id, ['placeholder' => 'All', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Expiration date</label>
                        <div class="col-sm-10">
                            <input type="text" id="datepicker" class="form-control" name="expiration_date" placeholder="Expiration date" value="{{ $coupon->expiration_date }}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Save</button>
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