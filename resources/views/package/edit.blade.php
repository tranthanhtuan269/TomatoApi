@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'packages'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Package</h3>
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
                        <label for="inputEmail3" class="col-sm-2 control-label">Parent Id</label>
                        <div class="col-sm-10">
                            <select name="service_id" id="service" class="form-control">
                            <?php 
                                foreach ($serviceList as $serviceObj) {
                                    echo '<optgroup label="'.$serviceObj->name.'">';
                                    $serviceChildList = \App\Service::where('parent_id', $serviceObj->id)->get();
                                    foreach($serviceChildList as $serviceChild){
                                        if($serviceChild->id == $package->service_id){
                                            echo '<option value="'.$serviceChild->id.'" checked>'.$serviceChild->name.'</option>';
                                        }else{
                                            echo '<option value="'.$serviceChild->id.'">'.$serviceChild->name.'</option>';
                                        }
                                    }
                                    echo '</optgroup>';
                                }
                            ?>
                            </select>
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
@endsection