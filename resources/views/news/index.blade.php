@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">HSP Administrator</h2></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'news'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">List News <a href="{{ url('/') }}/news/create" class="pull-right"><i class="fas fa-plus"></i> Add News</a> </h3>
            </div>
            <div class="panel-body">
            	<?php
            		$news = App\News::all();
            		foreach($news as $newObj){
            			?>
            			<div class="row news-row">
                            <div class="title-news">{{ $newObj->title }}</div>

                            <div class="group-control">
                            <a href="{{ url('/') }}/news/{{ $newObj->id }}/edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ url('news/'.$newObj->id) }}" method="POST">
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