@extends('layouts.app')

@section('content')
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
                <h3 class="panel-title">List Package</h3>
            </div>
            <div class="panel-body">
            	<?php
            		
                    $packages = App\Package::all();
            		foreach($packages as $packageView){
            			
            			?>
            			<div class="row service-parent">
            				<img src="{{ url('/') }}/public/images/{{ $packageView->icon }}" width="50px">{{ $packageView->name }}
        					<div class="group-control">
        						<a href="{{ url('/') }}/packages/{{ $packageView->id }}/edit"><i class="fas fa-edit"></i></a>
        						<form action="{{ url('packages/'.$packageView->id) }}" method="POST">
						            {{ csrf_field() }}
						            {{ method_field('DELETE') }}

						            <button type="submit" class="delete-btn">
						                <i class="fas fa-trash-alt"></i>
						            </button>
						        </form>
        					</div>
            			</div>
            			<?php
            			
            		}
            	?>
            </div>
        </div>
    </div>
</div>
@endsection