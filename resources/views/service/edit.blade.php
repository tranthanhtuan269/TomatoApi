@extends('layouts.app')

@section('content')
<script src="http://jcrop-cdn.tapmodo.com/v0.9.12/js/jquery.Jcrop.min.js"></script>
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
                <h3 class="panel-title">Sửa dịch vụ</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['url' => 'services/' . $service->id, 'class' => 'form-horizontal']) !!}
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Ảnh dịch vụ</label>
                        <div class="col-sm-10">
                            <div class="avatar">
                                <input type="hidden" id="avatar" name="icon" value="{{ $service->icon }}">
                                <img id="image-loading" src="{{ asset('images/general/bx_loader.gif') }}" width="50" height="50" style="display: none;">
                                @if(strlen($service->icon) > 0)
                                    <img src="{{ url('/') }}/public/images/{{ $service->icon }}" id="avatar-image" class="img" width="150" height="150">
                                @else
                                    <img src="{{ url('/') }}/public/images/noimage.png" width="150" height="150" id="avatar-image" class="img">
                                @endif
                            </div>
                            <div class="btn btn-primary" id="change-avatar-btn">Thay ảnh</div>
                            <div class="text-warning"><b>Chú ý: </b>Ảnh phải có kích cỡ từ 160 x 160 đến 3,000 x 3,000 pixels.</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tên dịch vụ</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $service->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tên tiếng Anh</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name_en" placeholder="Name" value="{{ $service->name_en }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tên tiếng Nhật</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name_ja" placeholder="Name" value="{{ $service->name_ja }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tên tiếng Hàn</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name_ko" placeholder="Name" value="{{ $service->name_ko }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Dịch vụ cha</label>
                        <div class="col-sm-10">
                            <select name="parent_id" id="service" class="form-control">
                            <?php 
                                if($service->parent_id == 0){
                                    echo '<option value="0" selected>No parent</option>';
                                }else{
                                    echo '<option value="0">No parent</option>';
                                }
                                foreach ($parentList as $serviceObj) {
                                    if($serviceObj->id == $service->parent_id){
                                        echo '<option value="'.$serviceObj->id.'" selected>--- '.$serviceObj->name.'</option>';
                                    }else{
                                        echo '<option value="'.$serviceObj->id.'">--- '.$serviceObj->name.'</option>';
                                    }
                                    $serviceChildList = \App\Service::where('parent_id', $serviceObj->id)->get();
                                    foreach($serviceChildList as $serviceChild){
                                        if($serviceChild->id == $service->parent_id){
                                            echo '<option value="'.$serviceChild->id.'" selected>--- --- '.$serviceChild->name.'</option>';
                                        }else{
                                            echo '<option value="'.$serviceChild->id.'">--- --- '.$serviceChild->name.'</option>';
                                        }
                                    }
                                }
                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Đối tác</label>
                        <div class="col-sm-10">
                        {!! Form::select('partner_id', $partnerList, $service->partner_id, ['placeholder' => 'Pick a partner...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Lưu lại</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="change-avatar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg modal-image">

    <!-- Modal content-->
    <div class="modal-content">
        <form id="form" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chọn ảnh mới</h4>
            </div>
            <div class="modal-body">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                        80%
                    </div>
                </div>
                <input id="file" type="file" class="hide" accept="image/*">
                <div id="views"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="load-btn">Chọn ảnh mới</button>
                <button type="button" class="btn btn-primary hide" id="submit-btn">Chọn</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </form>
    </div>
  </div>
</div>

<link rel="stylesheet" href="http://jcrop-cdn.tapmodo.com/v0.9.12/css/jquery.Jcrop.min.css" type="text/css" />

<script type="text/javascript">
    $(document).ready(function(){
        $('#change-avatar').on('shown.bs.modal', function (e) {
            e.preventDefault();
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
            if ($.inArray($($file).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                swal({
                    text: 'Chỉ những định dạng sau đây được cho phép : '+fileExtension.join(', '),
                    title: "Thông báo lỗi",
                    icon: "error",
                  })
                return;
            }
            loadImage($file);
        });
        
        var crop_max_width = 400;
        var crop_max_height = 400;
        var jcrop_api;
        var canvas;
        var context;
        var image;

        var prefsize;

        $('#avatar-image').click(function(){
            $('#file').val("");
            $('#file').click();
        });

        $("#file").change(function() {
            $file = this;
            if($(this).val().length > 0){
                $('.progress').removeClass('hide');
                loadImage(this);
            }
        });

        $('#load-btn').click(function(){
            $('#file').val("");
            $('#change-avatar').modal('hide');
            $('#file').click();
        });

        $('#change-avatar-btn').click(function(){
            $('#file').val("");
            $('#file').click();
        });

        function loadImage(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            canvas = null;
            reader.onload = function(e) {
              image = new Image();
              image.onload = validateImage;
              image.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
            $('#submit-btn').removeClass('hide');
          }
        }

        function validateImage() {
            $('.progress').addClass('hide');
            if (canvas != null) {
                image = new Image();
                image.onload = restartJcrop;
                image.src = canvas.toDataURL('image/png');

                $("#form").submit();
            } else restartJcropOpen();
        }

        function restartJcropOpen() {
            // if(image.width < 160 || image.height < 160 || image.width > 3000 || image.height > 3000){
            //     $("#views").empty();
            //     swal({
            //         text: 'Ảnh phải có kích cỡ từ 160 x 160 đến 3,000 x 3,000 pixels. Please select a different image',
            //     });
            // }else{
                $('#change-avatar').modal('show');
                restartJcrop();
            // }
        }

        function restartJcrop() {
          if (jcrop_api != null) {
            jcrop_api.destroy();
          }
          $("#views").empty();
          $("#views").append("<canvas id=\"canvas\">");
          canvas = $("#canvas")[0];
          context = canvas.getContext("2d");
          canvas.width = image.width;
          canvas.height = image.height;
          var imageSize = (image.width > image.height)? image.height : image.width;
          imageSize = (imageSize > 800)? 800: imageSize;
          context.drawImage(image, 0, 0);
          $("#canvas").Jcrop({
            onSelect: selectcanvas,
            onRelease: clearcanvas,
            boxWidth: crop_max_width,
            boxHeight: crop_max_height,
            setSelect: [0,0,imageSize,imageSize],
            aspectRatio: 1,
            bgOpacity:   .4,
            bgColor:     'black'
          }, function() {
            jcrop_api = this;
          });
          clearcanvas();
          selectcanvas({x:0,y:0,w:imageSize,h:imageSize});
        }

        function clearcanvas() {
          prefsize = {
            x: 0,
            y: 0,
            w: canvas.width,
            h: canvas.height,
          };
        }

        function selectcanvas(coords) {
          prefsize = {
            x: Math.round(coords.x),
            y: Math.round(coords.y),
            w: Math.round(coords.w),
            h: Math.round(coords.h)
          };
        }

        $('#submit-btn').click(function(){
            canvas.width = prefsize.w;
            canvas.height = prefsize.h;
            context.drawImage(image, prefsize.x, prefsize.y, prefsize.w, prefsize.h, 0, 0, canvas.width, canvas.height);
            validateImage();
        });

        $("#form").submit(function(e) {
          e.preventDefault();
          $('#change-avatar').modal('hide');
          formData = new FormData($(this)[0]);
          // var blob = dataURLtoBlob(canvas.toDataURL('image/png'));
          //---Add file blob to the form data
          formData.append("base64", canvas.toDataURL('image/png'));

          $.ajaxSetup(
          {
              headers:
              {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            url: "{{ url('/') }}/images/uploadImage",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("#image-loading").show();
            },
            success: function(data) {
                $("#image-loading").hide();
                if(data.code == 200){
                    $('#avatar-image').attr('src', "{{ url('/') }}/public/images/" + data.image_url);
                    $('#avatar').val(data.image_url);
                    $('#change-avatar').modal('hide');
                    $("#views").empty();
                }else{
                    swal({
                        text: 'Có một lỗi xảy ra trong quá trình xử lý, hãy thử lại!',
                        title: "Thông báo lỗi",
                        icon: "error",
                      })
                    return;
                }
                $('#avatar-image').on('load', function () {
                    $("#image-loading").hide();
                });
            },
            error: function(data) {
                $("#image-loading").hide();
                alert("Error");
            },
            complete: function(data) {
                $("#image-loading").hide();
            }
          });
        });
    });
</script>
@endsection