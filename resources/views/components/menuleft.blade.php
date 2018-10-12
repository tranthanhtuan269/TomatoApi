<?php

	$list = ['services', 'packages', 'orders', 'users'];

?>
<ul class="list-group">
	<li class="list-group-item active">Danh sách</li>
	@foreach($list as $item)
    <li class="list-group-item menu-link @if($active == $item) actived @endif">
    	<a href="{{ url('/') }}/{{ $item }}" class="text-capitalize">
    		{{ $item }}
    	</a>
    </li>
    @endforeach
</ul>