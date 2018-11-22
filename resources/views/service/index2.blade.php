@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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
          data: { content : JSON.stringify(service_list) },
          dataType: "json"
        });
         
        request.done(function( msg ) {
          $( "#log" ).html( msg );
        });
         
        request.fail(function( jqXHR, textStatus ) {
          alert( "Request failed: " + textStatus );
        });
    }

    $('.active').click(function(){
        var id = $(this).attr('data-id');
        $('#active-' + id).addClass('hidden');
        $('#unactive-' + id).removeClass('hidden');

        var request2 = $.ajax({
          url: "{{ url('/') }}/services/active",
          method: "POST",
          data: { 
            id : id,
            type : 1
          },
          dataType: "json"
        });
         
        request2.done(function( msg ) {
          $( "#log" ).html( msg );
        });
         
        request2.fail(function( jqXHR, textStatus ) {
          alert( "Request failed: " + textStatus );
        });
    });

    $('.unactive').click(function(){
        var id = $(this).attr('data-id');
        $('#active-' + id).removeClass('hidden');
        $('#unactive-' + id).addClass('hidden');

        var request2 = $.ajax({
          url: "{{ url('/') }}/services/active",
          method: "POST",
          data: { 
            id : id,
            type : 0
          },
          dataType: "json"
        });
         
        request2.done(function( msg ) {
          $( "#log" ).html( msg );
        });
         
        request2.fail(function( jqXHR, textStatus ) {
          alert( "Request failed: " + textStatus );
        });
    });
} );
</script>
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'services'])
        @endcomponent
    </div>
    <div class="col-sm-9 page-content"> 
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

                            <span id="active-{{ $serviceChild1->id }}" data-id="{{ $serviceChild1->id }}" class="active @if($serviceChild1->active == 0) hidden @endif"><i class="fas fa-check" style="color:#00cc00"></i></span>
                            <span id="unactive-{{ $serviceChild1->id }}" data-id="{{ $serviceChild1->id }}" class="unactive @if($serviceChild1->active == 1) hidden @endif"><i class="fas fa-check"></i></span>
                            <a href="{{ url('/') }}/services/{{ $serviceChild1->id }}/edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ url('services/'.$serviceChild1->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="delete-btn">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            <span class="hint-child"><i class="fas fa-chevron-right"></i></span>
                            <span class="show-child" style="display: none;"><i class="fas fa-chevron-down"></i></span>
                            </div>
            			</div>
            			<?php
            			foreach($listChild1 as $serviceChild2){
                            $listChild2 = App\Service::where('parent_id', $serviceChild2->id)->orderBy('index', 'asc')->get();
                                       ?>
            				<div class="row service-child">
            					<img src="{{ url('/') }}/public/images/{{ $serviceChild1->icon }}" width="50px">{{ $serviceChild2->name }}
            					<div class="group-control">
                                    <span id="active-{{ $serviceChild2->id }}" data-id="{{ $serviceChild2->id }}" class="active  @if($serviceChild2->active == 0) hidden @endif"><i class="fas fa-check" style="color:#00cc00"></i></span>
                                    <span id="unactive-{{ $serviceChild2->id }}" data-id="{{ $serviceChild2->id }}" class="unactive  @if($serviceChild2->active == 1) hidden @endif"><i class="fas fa-check"></i></span>
            						<a href="{{ url('/') }}/services/{{ $serviceChild2->id }}/edit"><i class="fas fa-edit"></i></a>
            						<form action="{{ url('services/'.$serviceChild2->id) }}" method="POST">
						            {{ csrf_field() }}
						            {{ method_field('DELETE') }}
    						            <button type="submit" class="delete-btn">
    						                <i class="fas fa-trash-alt"></i>
    						            </button>
                                    </form>
                                    <span class="hint-child"><i class="fas fa-chevron-right"></i></span>
                                    <span class="show-child" style="display: none;"><i class="fas fa-chevron-down"></i></span>
            					</div>
	            			</div>
                            <div class="service-child2-group">
                				<?php
                                foreach($listChild2 as $serviceChild3){
                                    ?>
                                    <div class="row service-object service-child2" data-parent-1="{{ $serviceChild1->id }}" data-parent-2="{{ $serviceChild2->id }}" data-id="{{ $serviceChild3->id }}">
                                        <img src="{{ url('/') }}/public/images/{{ $serviceChild1->icon }}" width="50px">{{ $serviceChild3->name }}
                                        <div class="group-control">
                                            <span id="active-{{ $serviceChild3->id }}" data-id="{{ $serviceChild3->id }}" class="active  @if($serviceChild3->active == 0) hidden @endif"><i class="fas fa-check" style="color:#00cc00"></i></span>
                                            <span id="unactive-{{ $serviceChild3->id }}" data-id="{{ $serviceChild3->id }}" class="unactive  @if($serviceChild3->active == 1) hidden @endif"><i class="fas fa-check"></i></span>
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

<script type="text/javascript">
    $(document).ready(function(){
        $('.hint-child').click(function(){
            $(this).hide();
            $(this).parent().find('.show-child').show();
        });
        $('.show-child').click(function(){
            $(this).hide();
            $(this).parent().find('.hint-child').show();
        });
    });
</script>
@endsection