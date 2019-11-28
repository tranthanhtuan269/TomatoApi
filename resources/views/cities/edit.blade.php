@extends('layouts.app')

@section('content')
<script src="http://jcrop-cdn.tapmodo.com/v0.9.12/js/jquery.Jcrop.min.js"></script>
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">DSC Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'city'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Sửa vùng</h3>
            </div>
            <div class="panel-body">
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {!! Form::open(['url' => 'cities/' . $city->id, 'class' => 'form-horizontal']) !!}
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Ảnh vùng</label>
                        <div class="col-sm-10">
                            <div class="avatar">
                                <input type="hidden" id="image" name="image" value="{{ $city->image }}">
                                <img id="image-loading" src="{{ asset('images/general/bx_loader.gif') }}" width="50" height="50" style="display: none;">
                                @if(strlen($city->image) > 0)
                                    <img src="{{ url('/') }}/images/{{ $city->image }}" id="city-image" class="img" width="150" height="150">
                                @else
                                    <img src="{{ url('/') }}/images/noimage.png" width="150" height="150" id="city-image" class="img">
                                @endif
                            </div>
                            <div class="btn btn-primary" id="change-image-btn">Thay ảnh</div>
                            <div class="text-warning"><b>Chú ý: </b>Ảnh phải có kích thước từ 160 x 160 đến 3,000 x 3,000 pixels.</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tên vùng</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $city->name }}">
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
<div id="change-image" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg modal-image">

    <!-- Modal content-->
    <div class="modal-content">
        <form id="form" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chọn 1 ảnh mới</h4>
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
                <button type="button" class="btn btn-primary hide" id="submit-btn">Lưu lại</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
            </div>
        </form>
    </div>
  </div>
</div>

<link rel="stylesheet" href="http://jcrop-cdn.tapmodo.com/v0.9.12/css/jquery.Jcrop.min.css" type="text/css" />

<script type="text/javascript">
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
    $(document).ready(function(){
        $('#change-image').on('shown.bs.modal', function (e) {
            e.preventDefault();
            var fileExtension = ['jpeg', 'jpg', 'png'];
            if ($.inArray($($file).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                swal({
                    text: 'Định dạng hợp lệ bao gồm : '+fileExtension.join(', '),
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

        $('#city-image').click(function(){
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
            $('#change-image').modal('hide');
            $('#file').click();
        });

        $('#change-image-btn').click(function(){
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
            //         text: 'Ảnh chỉ nên để ở độ phân giải 160 x 160 — 3,000 x 3,000 pixels. Xin hãy chọn 1 ảnh khác',
            //         title: "Thông báo lỗi",
            //         icon: "error",
            //     });
            //   }else{
                $('#change-image').modal('show');
                restartJcrop();
            //   }
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
          $('#change-image').modal('hide');
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
                    $('#city-image').attr('src', "{{ url('/') }}/images/" + data.image_url);
                    $('#image').val(data.image_url);
                    $('#change-image').modal('hide');
                    $("#views").empty();
                }else{
                    swal({
                        text: 'Có lỗi xảy ra trong quá trình xử lý, hãy thử lại!',
                        title: "Thông báo lỗi",
                        icon: "error",
                      })
                    return;
                }
                $('#city-image').on('load', function () {
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