@extends('layouts.app')

@section('content')
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
                <h3 class="panel-title">Danh sách vùng <a href="/cities/create" class="pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></h3>
            </div>
            <div class="panel-body">
				<div class="row">
					<div class="col-sm-12"><input type="text" class="form-control" name="city_search" placeholder="Tên vùng"></div>
				</div>
            	<?php
                    $cities = App\City::orderBy('id', 'desc')->get();
            		foreach($cities as $cityView){
						?>
						<div class="row service-parent active" data-city="{{ strtolower($cityView->name) }}">
								<div class="col-sm-4"><img src="{{ url('/') }}/images/{{ $cityView->image }}" width="200px"></div>
							<div class="col-sm-8">
								<div class="row"><a href="{{ url('/') }}/cities/{{ $cityView->id }}/edit">{{ $cityView->name }}</a></div>
								<div class="group-control float-right">
									<a href="{{ url('/') }}/cities/{{ $cityView->id }}/edit"><i class="fas fa-edit"></i></a>
									<form action="{{ url('cities/'.$cityView->id) }}" method="POST">
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
		$("input[name=city_search]").keyup(function() {
			var city_search     = $('input[name=city_search]').val().toLowerCase()

			$(".service-parent").each(function( index ) {
				if (
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