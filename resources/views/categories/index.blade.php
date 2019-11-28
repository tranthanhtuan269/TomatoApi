@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">DSC Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
	<div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'category'])
        @endcomponent
    </div>
    <div class="col-sm-9">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Danh sách danh mục <a href="/categories/create" class="pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></h3>
            </div>
            <div class="panel-body">
				<div class="row">
					<div class="col-sm-6"><input type="text" class="form-control" name="category_search" placeholder="Tên danh mục"></div>
					<div class="col-sm-6"><input type="text" class="form-control" name="city_search" placeholder="Tên vùng"></div>
				</div>
            	<?php
                    $categories = App\Category::orderBy('id', 'desc')->get();
            		foreach($categories as $categoryView){
						?>
						<div class="row service-parent active" data-name="{{ strtolower($categoryView->name) }}" data-category="{{ strtolower($categoryView->name) }}" data-city="{{ strtolower($categoryView->city->name) }}">
							<div class="col-sm-12">
								<div class="row"><a href="{{ url('/') }}/categories/{{ $categoryView->id }}/edit">{{ $categoryView->name }}</a> - <a href="{{ url('/') }}/cities/{{ $categoryView->city->id }}/edit">{{ $categoryView->city->name }}</a></div>
								<div class="group-control float-right">
									<a href="{{ url('/') }}/categories/{{ $categoryView->id }}/edit"><i class="fas fa-edit"></i></a>
									<form action="{{ url('categories/'.$categoryView->id) }}" method="POST">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}

										<button type="submit" class="delete-btn">
											<i class="fas fa-trash-alt"></i>
										</button>
									</form>
								</div>
							</div>
            			</div>
            			<?php
            		}
            	?>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		$("input[name=category_search], input[name=city_search]").keyup(function() {
			var category_search = $('input[name=category_search]').val().toLowerCase()
			var city_search     = $('input[name=city_search]').val().toLowerCase()

			$(".service-parent").each(function( index ) {
				if (
					$( this ).attr('data-category').toLowerCase().indexOf(category_search) < 0 || 
					$( this ).attr('data-city').toLowerCase().indexOf(city_search) < 0
				){
					$( this ).addClass('hide');
				}else{
					$( this ).removeClass('hide');
				}
			});
		});
	})
</script>
@endsection