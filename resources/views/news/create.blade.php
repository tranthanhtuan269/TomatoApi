@extends('layouts.app')

@section('content')
<script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/classic/ckeditor.js"></script>
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
                <h3 class="panel-title">Add News</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['url' => 'news', 'class' => 'form-horizontal']) !!}
                    @method('POST')
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" placeholder="Title" value="">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Content</label>
                        <div class="col-sm-10">
                            <textarea name="content" id="editor">
                                
                            </textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Save</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
</script>
@endsection