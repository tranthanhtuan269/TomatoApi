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
                <h3 class="panel-title">Danh sách các gói</h3>
            </div>
            <div class="panel-body">
            	<?php
            		
                    $packages = App\Package::where('service_id', 8)->get();
            		foreach($packages as $packageView){
            			
            			?>
            			<div class="row service-parent">
            				<img src="{{ url('/') }}/images/{{ $packageView->icon }}" width="50px">{{ $packageView->name }}
        					<div class="group-control">
        						<a href="{{ url('/') }}/packages/{{ $packageView->id }}/edit"><i class="fas fa-edit"></i></a>
        						<form action="{{ url('services/'.$packageView->id) }}" method="POST">
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