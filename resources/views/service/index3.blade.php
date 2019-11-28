@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">
    body.dragging, body.dragging * {
      cursor: move !important;
    }

    .dragged {
      position: absolute;
      opacity: 0.5;
      z-index: 2000;
    }

    ol li{
        border: 1px solid #ccc;
        border-radius: 4px;
        margin: 8px;
        padding: 8px;
    }

    ol li span.hide-child{
        float: right;
        margin: -4px 4px;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 3px 10px;
        cursor: pointer;
    }

    ol li span.control-object{
        float: right;
        margin: -4px 4px;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 3px 10px;
        cursor: pointer;
    }

</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ url('/') }}/public/js/jquery-sortable.js"></script>
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
    <div class="col-sm-12"><h2 class="text-center">DSC Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'services'])
        @endcomponent
    </div>
    <div class="col-sm-9 page-content"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Danh sách dịch vụ<a href="{{ url('/') }}/services/create" class="pull-right"><i class="fas fa-plus"></i> Thêm dịch vụ</a> </h3>
            </div>
            <div class="panel-body">
                <ol class="nested_with_switch vertical parent-parent" data-id="0">
                    <?php
                        $services = App\Service::where('parent_id', 0)->orderBy('index', 'asc')->get();
                        foreach($services as $serviceChild1){
                            $listChild1 = App\Service::where('parent_id', $serviceChild1->id)->orderBy('index', 'asc')->get();
                            ?>
                    <li data-id="{{ $serviceChild1->id }}" data-name="{{ $serviceChild1->name }}">
                        <span class="content-text">{{ $serviceChild1->name }} - {{ $serviceChild1->name_en }} - {{ $serviceChild1->name_ja }} - {{ $serviceChild1->name_ko }}</span>

                        <span id="hint-{{ $serviceChild1->id }}" class="control-object hint-child" data-hide="{{ $serviceChild1->id }}">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                        <span id="show-{{ $serviceChild1->id }}" class="control-object show-child" data-hide="{{ $serviceChild1->id }}" style="display: none;">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                        @if(false)
                        <span class="control-object">
                            <form action="{{ url('services/'.$serviceChild1->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="control-object delete-btn">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </span>
                        @endif
                        <span class="control-object">
                            <a href="{{ url('/') }}/services/{{ $serviceChild1->id }}/edit" class="control-object">
                                <i class="fas fa-edit"></i>
                            </a>
                        </span>
                        <span id="unactive-{{ $serviceChild1->id }}" data-id="{{ $serviceChild1->id }}" class="control-object unactive @if($serviceChild1->active == 1) hidden @endif">
                            <i class="fas fa-check"></i>
                        </span>
                        <span id="active-{{ $serviceChild1->id }}" data-id="{{ $serviceChild1->id }}" class="control-object active @if($serviceChild1->active == 0) hidden @endif">
                            <i class="fas fa-check" style="color:#00cc00"></i>
                        </span>
                        <ol class="parent parent-{{ $serviceChild1->id }}" data-id="{{ $serviceChild1->id }}">
                            <?php
                            foreach($listChild1 as $serviceChild2){
                                $listChild2 = App\Service::where('parent_id', $serviceChild2->id)->orderBy('index', 'asc')->get();
                               ?>
                            <li data-id="{{ $serviceChild2->id }}" data-name="{{ $serviceChild2->name }}" class="hide-{{ $serviceChild1->id }}">
                                <span class="content-text">{{ $serviceChild2->name }} - {{ $serviceChild2->name_en }} - {{ $serviceChild2->name_ja }} - {{ $serviceChild2->name_ko }}</span>
                                <span id="hint-{{ $serviceChild2->id }}" class="control-object hint-child" data-hide="{{ $serviceChild2->id }}">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                                <span id="show-{{ $serviceChild2->id }}" class="control-object show-child" data-hide="{{ $serviceChild2->id }}" style="display: none;">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                                @if(false)
                                <span class="control-object">
                                    <form action="{{ url('services/'.$serviceChild2->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="control-object delete-btn">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </span>
                                @endif
                                <span class="control-object">
                                    <a href="{{ url('/') }}/services/{{ $serviceChild2->id }}/edit" class="control-object">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </span>
                                <span id="unactive-{{ $serviceChild2->id }}" data-id="{{ $serviceChild2->id }}" class="control-object unactive @if($serviceChild2->active == 1) hidden @endif">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span id="active-{{ $serviceChild2->id }}" data-id="{{ $serviceChild2->id }}" class="control-object active @if($serviceChild2->active == 0) hidden @endif">
                                    <i class="fas fa-check" style="color:#00cc00"></i>
                                </span>
                                <ol class="child child-{{ $serviceChild2->id }}" data-id="{{ $serviceChild2->id }}">
                                    <?php
                                    foreach($listChild2 as $serviceChild3){
                                        $listChild2 = App\Service::where('parent_id', $serviceChild2->id)->orderBy('index', 'asc')->get();
                                       ?>
                                    <li data-id="{{ $serviceChild3->id }}" data-name="{{ $serviceChild3->name }}" class="hide-{{ $serviceChild2->id }}">
                                        <span class="content-text">{{ $serviceChild3->name }} - {{ $serviceChild3->name_en }} - {{ $serviceChild3->name_ja }} - {{ $serviceChild3->name_ko }}</span>
                                        @if(false)
                                        <span class="control-object">
                                            <form action="{{ url('services/'.$serviceChild3->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="control-object delete-btn">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </span>
                                        @endif
                                        <span class="control-object">
                                            <a href="{{ url('/') }}/services/{{ $serviceChild3->id }}/edit" class="control-object">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </span>
                                        <span class="control-object">
                                            <a href="{{ url('/') }}/services/{{ $serviceChild3->id }}">
                                                <i class="fas fa-list"></i>
                                            </a>
                                        </span>
                                        <span id="unactive-{{ $serviceChild3->id }}" data-id="{{ $serviceChild3->id }}" class="control-object unactive @if($serviceChild3->active == 1) hidden @endif">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span id="active-{{ $serviceChild3->id }}" data-id="{{ $serviceChild3->id }}" class="control-object active @if($serviceChild3->active == 0) hidden @endif">
                                            <i class="fas fa-check" style="color:#00cc00"></i>
                                        </span>
                                    </li>
                                    <?php
                                        }
                                    ?>
                              </ol>
                            </li>
                            <?php
                                }
                            ?>
                      </ol>
                    </li>
                    <?php
                        }
                    ?>
                </ol>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var oldContainer;
    $("ol.nested_with_switch").sortable({
        group: 'nested',
        afterMove: function (placeholder, container) {
            if(oldContainer != container){
                if(oldContainer)
                    oldContainer.el.removeClass("active");
                container.el.addClass("active");
                oldContainer = container;
            }
        },
        onDrop: function ($item, container, _super) {
            container.el.removeClass("active");
            _super($item, container);

            var parent_id = 0;
            var class_list = "";
            var class_parent = "";
            var order_list = "";
            
            if($item.parent().attr('data-id') == undefined){
                if($(container).hasClass('parent-parent')){
                    parent_id = $item.parent().parent().attr('data-id');
                    class_list = $item.parent().parent().attr("class");
                    var res = class_list.split(" ");
                    for(var $i = 0; $i < res.length; $i++){
                       class_parent += "." + res[$i];
                    }
                    class_parent += ">li";
                }else{
                    parent_id = $item.parent().parent().attr('data-id');
                    class_list = $item.parent().attr("class");
                    var res = class_list.split(" ");

                    for(var $i = 0; $i < res.length; $i++){
                       class_parent += "." + res[$i];
                    }

                    class_parent += ">li";
                }
            }else{
                parent_id = $item.parent().attr('data-id');
                class_list = $item.parent().attr("class");
                var res = class_list.split(" ");

                for(var $i = 0; $i < res.length; $i++){
                   class_parent += "." + res[$i];
                }

                class_parent += ">li";
            }

            $(class_parent).each(function( index ) {
                order_list += $(this).attr('data-id') + ",";
            });

            var request = $.ajax({
              url: "{{ url('/') }}/services/sort",
              method: "POST",
              data: { 
                'id' : $item.attr('data-id'), 
                'parent_id' : parent_id,
                'order_list' : order_list,
              },
              dataType: "json"
            });
             
            request.done(function( msg ) {
              $( "#log" ).html( msg );
            });
             
            request.fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
            });



            // console.log($('.parent-parent>li'));
            // $('.parent-parent>li').each(function( index ) {
            //     console.log($(this).attr('data-id'));
            // });

            // var service_list = [];
            // $('.service-object').each(function( index ) {
            //     var obj = {
            //         'id' : $( this ).attr('data-id'), 
            //         'parent2' : $( this ).attr('data-parent-2'), 
            //         'parent1' : $( this ).attr('data-parent-1'), 
            //     }
            //     service_list.push(obj);
            // });

            // var request = $.ajax({
            //   url: "{{ url('/') }}/services/sort",
            //   method: "POST",
            //   data: { content : JSON.stringify(service_list) },
            //   dataType: "json"
            // });
             
            // request.done(function( msg ) {
            //   $( "#log" ).html( msg );
            // });
             
            // request.fail(function( jqXHR, textStatus ) {
            //   alert( "Request failed: " + textStatus );
            // });
        }
    });

    $(".switch-container").on("click", ".switch", function  (e) {
      var method = $(this).hasClass("active") ? "enable" : "disable";
      $(e.delegateTarget).next().sortable(method);
    });

    $(document).ready(function(){
        $('.hint-child').click(function(){
            $(this).hide();
            $('#show-' + $(this).attr('data-hide')).show();
            $('.hide-' + $(this).attr('data-hide')).hide();
        });
        $('.show-child').click(function(){
            $(this).hide();
            $('#hint-' + $(this).attr('data-hide')).show();
            $('.hide-' + $(this).attr('data-hide')).show();
        });
    });
</script>
@endsection