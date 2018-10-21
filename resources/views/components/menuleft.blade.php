<?php

	$list = ['services', 'news',/*, 'orders', 'users'*/];

?>
<ul class="list-group">
	<li class="list-group-item active">Category</li>
	@foreach($list as $item)
    <li class="list-group-item menu-link @if($active == $item) actived @endif">
    	<a href="{{ url('/') }}/{{ $item }}" class="text-capitalize">
    		{{ $item }}
    	</a>
    </li>
    @endforeach
</ul>

<ul class="list-group">
	<li class="list-group-item active">Page</li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=whyUse" class="text-capitalize">
    		Why use HSP
    	</a>
	</li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=bestPractices" class="text-capitalize">
    		Best Practices
    	</a>
	</li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=faqs" class="text-capitalize">
    		FAQs
    	</a>
	</li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=Contact" class="text-capitalize">
    		Contact
    	</a>
	</li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=legal" class="text-capitalize">
    		Legal
    	</a>
	</li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=about" class="text-capitalize">
    		About
    	</a>
	</li>
</ul>