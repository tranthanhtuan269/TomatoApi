@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'services'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">List Service <a href="{{ url('/') }}/services/create" class="pull-right"><i class="fas fa-plus"></i> Add Service</a> </h3>
            </div>
            <div class="panel-body">
            	<?php
            		$services = App\Service::where('parent_id', 0)->get();
            		foreach($services as $serviceChild1){
            			$listChild1 = App\Service::where('parent_id', $serviceChild1->id)->get();
            			?>
            			<div class="row service-parent">
            				<img src="{{ url('/') }}/public/images/{{ $serviceChild1->icon }}" width="50px">{{ $serviceChild1->name }}
                            <div class="group-control">
                            <a href="{{ url('/') }}/services/{{ $serviceChild1->id }}/edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ url('services/'.$serviceChild1->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="delete-btn">
                                                <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            </div>
            			</div>
            			<?php
            			foreach($listChild1 as $serviceChild2){
                                                    $listChild2 = App\Service::where('parent_id', $serviceChild2->id)->get();
                                       ?>
            				<div class="row service-child">
            					<img src="{{ url('/') }}/public/images/{{ $serviceChild1->icon }}" width="50px">{{ $serviceChild2->name }}
            					<div class="group-control">
            						<a href="{{ url('/') }}/services/{{ $serviceChild2->id }}/edit"><i class="fas fa-edit"></i></a>
            						<form action="{{ url('services/'.$serviceChild2->id) }}" method="POST">
						            {{ csrf_field() }}
						            {{ method_field('DELETE') }}
    						            <button type="submit" class="delete-btn">
    						                <i class="fas fa-trash-alt"></i>
    						            </button>
            						</form>
            					</div>
	            			</div>
            				<?php
                            foreach($listChild2 as $serviceChild3){
                                ?>
                                <div class="row service-child2">
                                    <img src="{{ url('/') }}/public/images/{{ $serviceChild1->icon }}" width="50px">{{ $serviceChild3->name }}
                                    <div class="group-control">
                                        <a href="{{ url('/') }}/services/{{ $serviceChild3->id }}"><i class="fas fa-list"></i></a>
                                        <a href="{{ url('/') }}/services/{{ $serviceChild3->id }}/edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ url('services/'.$serviceChild3->id) }}" method="POST">
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
            		}
            	?>
            </div>
        </div>
    </div>
</div>
@endsection