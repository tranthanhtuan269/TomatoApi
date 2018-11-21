@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'export'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Report</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['url' => url('/reports/export'), 'method' => 'post', 'class' => 'form-inline']) !!}
                  <div class="form-group">
                    <label for="exampleInputName2">From: </label>
                    <input type="text" class="form-control datepicker" name="from">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail2">To: </label>
                    <input type="text" class="form-control datepicker" name="to">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail2">Service: </label>
                    {!! Form::select('service', $services, null, ['placeholder' => 'All', 'class' => 'form-control']) !!}
                  </div>
                  <button type="submit" class="btn btn-default">Export Excel</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.datepicker').datepicker({
            dateFormat: "dd-mm-yy",
            maxDate: 0
        });
    });
</script>
@endsection