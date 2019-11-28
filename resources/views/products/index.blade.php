@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">DSC Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
	<div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'product'])
        @endcomponent
    </div>
    <div class="col-sm-9">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Danh sách sản phẩm <a href="/products/create" class="pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></h3>
            </div>
            <div class="panel-body">
				<div class="row">
					<div class="col-sm-4"><input type="text" class="form-control" name="product_search" placeholder="Tên sản phẩm"></div>
					<div class="col-sm-4"><input type="text" class="form-control" name="category_search" placeholder="Tên danh mục"></div>
					<div class="col-sm-4"><input type="text" class="form-control" name="city_search" placeholder="Tên vùng"></div>
				</div>
            	<?php
                    $products = App\Product::orderBy('id', 'desc')->get();
            		foreach($products as $productView){
						?>
						@if($productView->active == 0)
						<div class="row service-parent inactive" data-name="{{ strtolower($productView->name) }}" data-category="{{ strtolower($productView->category->name) }}" data-city="{{ strtolower($productView->category->city->name) }}">
						@else
						<div class="row service-parent active" data-name="{{ strtolower($productView->name) }}" data-category="{{ strtolower($productView->category->name) }}" data-city="{{ strtolower($productView->category->city->name) }}">
						@endif
							<div class="col-sm-4"><img src="{{ url('/') }}/images/{{ $productView->image }}" width="200px"></div>
							<div class="col-sm-8">
								<div class="row"><a href="{{ url('/') }}/products/{{ $productView->id }}/edit">{{ $productView->name }}</a> - <a href="{{ url('/') }}/categories/{{ $productView->category->id }}">{{ $productView->category->name }}</a> - <a href="{{ url('/') }}/cities/{{ $productView->category->city->id }}">{{ $productView->category->city->name }}</a></div>
								@if(intval($productView->sale) > 0)
									@if(intval($productView->sale) == intval($productView->price))
										<div class="row">Giá: <span style="color:red">{{ number_format(intval($productView->sale), 0, ",", ".") }} vnđ</span></div>
									@else
										<div class="row">Giá: <span style="color:red">{{ number_format(intval($productView->sale), 0, ",", ".") }} vnđ</span> <span>(<del>{{ number_format(intval($productView->price), 0, ",", ".") }} vnđ </del>)</span></div>
									@endif
								@else
								<div class="row">Giá: <span style="color:red">Liên hệ</span></div>
								@endif
								<div class="row">Đơn vị: {{ $productView->unit }}</div>
								<div class="row">{!! $productView->address !!}</div>


								<div class="group-control float-right">
									<a href="{{ url('/') }}/products/{{ $productView->id }}/edit"><i class="fas fa-edit"></i></a>
									<form action="{{ url('products/'.$productView->id) }}" method="POST">
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
		$("input[name=product_search], input[name=category_search], input[name=city_search]").keyup(function() {
			var product_search  = $('input[name=product_search]').val().toLowerCase()
			var category_search = $('input[name=category_search]').val().toLowerCase()
			var city_search     = $('input[name=city_search]').val().toLowerCase()

			$(".service-parent").each(function( index ) {
				if (
					$( this ).attr('data-name').toLowerCase().indexOf(product_search) < 0 || 
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