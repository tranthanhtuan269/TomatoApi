@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">TRANG QUẢN LÝ</h2></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'services'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Danh sách dịch vụ</h3>
            </div>
            <div class="panel-body">
            	<?php
            		$services = App\Service::where('parent_id', 0)->get();
            		foreach($services as $serviceParent){
            			$listChild = App\Service::where('parent_id', $serviceParent->id)->get();
            			?>
            			<div class="row service-parent">
            				<img src="{{ url('/') }}/images/{{ $serviceParent->icon }}" width="50px">{{ $serviceParent->name }}
        					<div class="group-control">
        						<a href="{{ url('/') }}/services/{{ $serviceParent->id }}/edit"><i class="fas fa-edit"></i></a>
        						<form action="{{ url('services/'.$serviceParent->id) }}" method="POST">
						            {{ csrf_field() }}
						            {{ method_field('DELETE') }}

						            <button type="submit" class="delete-btn">
						                <i class="fas fa-trash-alt"></i>
						            </button>
						        </form>
        					</div>
            			</div>
            			<?php
            			foreach($listChild as $child){
            				?>
            				<div class="row service-child">
            					<img src="{{ url('/') }}/images/{{ $child->icon }}" width="50px">{{ $child->name }}
            					<div class="group-control">
            						<a href="{{ url('/') }}/services/{{ $child->id }}/edit"><i class="fas fa-edit"></i></a>
            						<form action="{{ url('services/'.$child->id) }}" method="POST">
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
            		}
            	?>
            </div>
        </div>
    </div>
</div>
@endsection