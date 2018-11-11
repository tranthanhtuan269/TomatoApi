<?php

	$list = ['services', 'news', 'users'];

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
	<li class="list-group-item active">Order</li>
    <li class="list-group-item menu-link @if($active == 'new') actived @endif">
    	<a href="{{ url('/') }}/orders/new" class="text-capitalize">
    		New Order
    	</a>
    </li>
    <li class="list-group-item menu-link @if($active == 'accepted') actived @endif">
    	<a href="{{ url('/') }}/orders/accepted" class="text-capitalize">
    		Accepted Order
    	</a>
    </li>
    <li class="list-group-item menu-link @if($active == 'paid') actived @endif">
    	<a href="{{ url('/') }}/orders/paid" class="text-capitalize">
    		Paid Order
    	</a>
    </li>
    <li class="list-group-item menu-link @if($active == 'cancel') actived @endif">
    	<a href="{{ url('/') }}/orders/cancel" class="text-capitalize">
    		Cancel Order
    	</a>
    </li>
</ul>

<ul class="list-group">
	<li class="list-group-item active">Page</li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=whyUse" class="text-capitalize">
    		Why use HSP
    	</a>
	</li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=coupon" class="text-capitalize">
    		Coupon
    	</a>
	</li>
    <li class="list-group-item menu-link">
        <a href="{{ url('/') }}/pages?type=rewards" class="text-capitalize">
            Rewards
        </a>
    </li>
    <li class="list-group-item menu-link">
        <a href="{{ url('/') }}/pages?type=invite" class="text-capitalize">
            Invite
        </a>
    </li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=warranties" class="text-capitalize">
    		Warranties
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