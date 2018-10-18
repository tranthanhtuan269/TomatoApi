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
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Add Service</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['url' => 'services', 'class' => 'form-horizontal']) !!}
                    @method('POST')
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Parent Id</label>
                        <div class="col-sm-10">
                            <select name="parent_id" id="service" class="form-control">
                            <?php 
                                    echo '<option value="0">No parent</option>';
                                    foreach ($parentList as $serviceObj) {
                                        echo '<option value="'.$serviceObj->id.'">--- '.$serviceObj->name.'</option>';
                                        $serviceChildList = \App\Service::where('parent_id', $serviceObj->id)->get();
                                        foreach($serviceChildList as $serviceChild){
                                                echo '<option value="'.$serviceChild->id.'">--- --- '.$serviceChild->name.'</option>';
                                        }
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