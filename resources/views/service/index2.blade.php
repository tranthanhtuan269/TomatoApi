@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
    $( ".service-child2-group" ).sortable({
        stop: function( event, ui ) {
            updateJson();
        }
    });
    $( ".service-child2-group" ).disableSelection();

    function updateJson(){
        var service_list = [];
        $('.service-object').each(function( index ) {
            var obj = {
                'id' : $( this ).attr('data-id'), 
                'parent2' : $( this ).attr('data-parent-2'), 
                'parent1' : $( this ).attr('data-parent-1'), 
            }
            service_list.push(obj);
        });

        var request = $.ajax({
          url: "{{ url('/') }}/services/sort",
          method: "POST",
          data: { id : serialize(service_list) },
          dataType: "json"
        });
         
        request.done(function( msg ) {
          $( "#log" ).html( msg );
        });
         
        request.fail(function( jqXHR, textStatus ) {
          alert( "Request failed: " + textStatus );
        });

        console.log(service_list);
    }
} );
</script>
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
                            <div class="service-child2-group">
                				<?php
                                foreach($listChild2 as $serviceChild3){
                                    ?>
                                    <div class="row service-object service-child2" data-parent-1="{{ $serviceChild1->id }}" data-parent-2="{{ $serviceChild2->id }}" data-id="{{ $serviceChild3->id }}">
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
                                ?>
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