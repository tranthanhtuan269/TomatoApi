@extends('layouts.app')

@section('content')
<script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/classic/ckeditor.js"></script>
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
    </div>
    <div class="col-sm-9"> 
        {!! Form::open(['url' => 'pages/' . $page->id, 'class' => 'form-horizontal']) !!}
        @method('PUT')
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Edit "{{ $_GET["type"] }}" Page</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea name="content" id="editor">
                            {{ $page->content }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
                    
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-default">Save</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script type="text/javascript">
    ClassicEditor.create( document.querySelector( '#editor' ) );
</script>
@endsection