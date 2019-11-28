@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">DSC Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'packages'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Sửa danh mục</h3>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {!! Form::open(['url' => 'categories/' . $category->id, 'class' => 'form-horizontal']) !!}
                    @method('PUT')

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tên danh mục</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $category->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Thuộc vùng</label>
                        <div class="col-sm-10">
                            <select name="city_id" id="city_id" class="form-control">
                            <?php 
                                foreach ($cities as $cityObj) {
                                    if($cityObj->id == $category->city->id)
                                    echo '<option value="'.$cityObj->id.'" selected>'.$cityObj->name.'</option>';
                                    else
                                    echo '<option value="'.$cityObj->id.'">'.$cityObj->name.'</option>';
                                }
                            ?>
                            </select>
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
@endsection