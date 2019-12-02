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
                <?php $service = \App\Service::find($id); ?>
                <h3 class="panel-title">Danh sách dịch vụ con của "{{ $service->name }}" of "{{ $service->parent()->first()->name }}" <a href="{{ url('/') }}/packages/create" class="pull-right"><i class="fas fa-plus"></i> Thêm dịch vụ con</a></h3>
            </div>
            <div class="panel-body">
            
            	<?php
            		foreach($packages as $packageView){
            			?>
            			<div class="row service-parent package-list">
            				<img src="{{ url('/') }}/images/{{ $packageView->image }}" width="50px">{{ $packageView->name }} - {{ $packageView->name_en }} - {{ $packageView->name_ja }} - {{ $packageView->name_ko }}
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