@extends('layouts.app2')

@section('content')
<div class="container-fluid">
    <div class="col-12"><h2 class="text-center">HSP Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-3">
            @component('components.menuleft', ['active' => 'services'])
            @endcomponent
        </div>
        <div class="col-9 page-content"> 
            <div class="row">
                <div class="col-6">
                    <div class="card mb-3">
                        <div class="card-header"><h5 class="float-left">Danh sách dịch vụ</h5>
                            <div class="float-right">
                                <button id="btnReload" type="button" class="btn btn-outline-secondary">
                                    <i class="fa fa-play"></i> Làm mới lại</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul id="myEditor" class="sortableLists list-group">
                            </ul>
                            <div class="text-center mt-2">
                                <button id="btnOutput" type="button" class="btn btn-success"><i class="fas fa-check-square"></i> Lưu lại</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card border-primary mb-3">
                        <div class="card-header bg-primary text-white">Sửa</div>
                        <div class="card-body">
                            <form id="frmEdit" class="form-horizontal">
                                <div class="form-group">
                                    <label for="text">Tên tiếng Việt</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">
                                        <div class="input-group-append">
                                            <button type="button" id="myEditor_icon" class="btn btn-outline-secondary"></button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="icon" class="item-menu">
                                </div>
                                <div class="form-group">
                                    <label for="href">Tên tiếng Anh</label>
                                    <input type="text" class="form-control item-menu" id="name_en" name="name_en" placeholder="name_en">
                                </div>
                                <div class="form-group">
                                    <label for="href">Tên tiếng Nhật</label>
                                    <input type="text" class="form-control item-menu" id="name_ja" name="name_ja" placeholder="name_ja">
                                </div>
                                <div class="form-group">
                                    <label for="href">Tên tiếng Hàn</label>
                                    <input type="text" class="form-control item-menu" id="name_ko" name="name_ko" placeholder="name_ko">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Cập nhật</button>
                            <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Thêm mới</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/js/jquery-menu-editor.js"></script>
<script type="text/javascript" src="{{ url('/') }}/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js"></script>
<script>
    jQuery(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /* =============== DEMO =============== */  
        // menu items
        var arrayjson = [
        @php
            $service_parent = \App\Service::where('parent_id', 0)->where('active', 1)->orderBy('index', 'asc')->get();
            foreach($service_parent as $key=>$parent){
                if($key == 0){
                    echo '{';
                }else{
                    echo ',{';
                }
                echo '"id":"'.$parent->id.'",';
                echo '"icon":"'.$parent->icon.'",';
                echo '"name_en":"'.$parent->name_en.'",';
                echo '"name_ja":"'.$parent->name_ja.'",';
                echo '"name_ko":"'.$parent->name_ko.'",';
                $service_children = \App\Service::where('parent_id', $parent->id)->where('active', 1)->orderBy('index', 'asc')->get();
                if(count($service_children) > 0){
                    echo '"text":"'.$parent->name.'",';
                    echo '"children":[';
                }else{
                    echo '"text":"'.$parent->name.'"';
                }
                foreach($service_children as $key2=>$child){
                    if($key2 == 0){
                        echo '{';
                    }else{
                        echo ',{';
                    }
                    echo '"id":"'.$child->id.'",';
                    echo '"icon":"'.$child->icon.'",';
                    echo '"name_en":"'.$child->name_en.'",';
                    echo '"name_ja":"'.$child->name_ja.'",';
                    echo '"name_ko":"'.$child->name_ko.'",';
                    $service_children_children = \App\Service::where('parent_id', $child->id)->where('active', 1)->orderBy('index', 'asc')->get();
                    if(count($service_children_children) > 0){
                        echo '"text":"'.$child->name.'",';
                        echo '"children":[';
                    }else{
                        echo '"text":"'.$child->name.'"';
                    }
                    foreach($service_children_children as $key3=>$child_child){
                        if($key3 == 0){
                            echo '{';
                        }else{
                            echo ',{';
                        }
                        echo '"id":"'.$child_child->id.'",';
                        echo '"icon":"'.$child_child->icon.'",';
                        echo '"name_en":"'.$child_child->name_en.'",';
                        echo '"name_ja":"'.$child_child->name_ja.'",';
                        echo '"name_ko":"'.$child_child->name_ko.'",';
                        echo '"text":"'.$child_child->name.'"';
                        echo '}';
                    }
                    if(count($service_children_children) > 0){
                        echo ']';
                    }
                    echo '}';
                }
                if(count($service_children) > 0){
                    echo ']';
                }
                echo '}';
            }
        @endphp
        ];
        // icon picker options
        var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
        // sortable list options
        var sortableListOptions = {
            placeholderCss: {'background-color': "#cccccc"}
        };

        var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
        editor.setForm($('#frmEdit'));
        editor.setUpdateButton($('#btnUpdate'));
        editor.setData(arrayjson);

        $('#btnReload').on('click', function () {
            editor.setData(arrayjson);
        });

        $('#btnOutput').on('click', function () {
            var str = editor.getString();

            var request = $.ajax({
                url: "{{ url('/') }}/services/save",
                method: "POST",
                data: { content : JSON.stringify(str) },
                dataType: "json"
            });
             
            request.done(function( msg ) {
                Swal.fire({
                    title: 'Cập nhật thành công!',
                    text: 'Hệ thống dịch vụ đã được cập nhật thành công!',
                    type: 'success',
                    confirmButtonText: 'Done'
                }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                })
            });
             
            request.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });
            $("#out").text(str);
        });

        $("#btnUpdate").click(function(){
            editor.update();
        });

        $('#btnAdd').click(function(){
            editor.add();
        });
    });
</script>
@endsection
