@extends('layouts.app')

@section('content')
<script src="http://jcrop-cdn.tapmodo.com/v0.9.12/js/jquery.Jcrop.min.js"></script>
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">DSC Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'paid'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Sửa đơn</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['url' => 'orders/' . $order->id, 'class' => 'form-horizontal']) !!}
                    @method('PUT')
                    <div class="form-group">
                        <div class="col-sm-4">
                            <div class="avatar">
                                <img id="image-loading" src="{{ asset('images/general/bx_loader.gif') }}" width="50" height="50" style="display: none;">
                                @if(strlen($order->image) > 0)
                                    <img src="{{ url('/') }}/images/{{ $order->image }}" id="avatar-image" class="img" width="150" height="150">
                                @else
                                    <img src="{{ url('/') }}/images/300px-No_image_available.svg.png" width="150" height="150" id="avatar-image" class="img">
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Total</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="price" placeholder="Total" value="{{ $order->real_price }}">
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-default">Save</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){

    });
</script>
@endsection