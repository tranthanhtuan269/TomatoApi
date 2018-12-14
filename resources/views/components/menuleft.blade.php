<?php

	$list = ['services', 'news', 'users', 'coupons', 'partners'];

?>

<ul class="list-group">
    <li class="list-group-item active">Report</li>
    <li class="list-group-item menu-link @if($active == 'daily') actived @endif">
        <a href="{{ url('/') }}/reports/daily" class="text-capitalize">
            Daily Report
        </a>
    </li>
    <li class="list-group-item menu-link @if($active == 'weekly') actived @endif">
        <a href="{{ url('/') }}/reports/weekly" class="text-capitalize">
            Weekly Report
        </a>
    </li>
    <li class="list-group-item menu-link @if($active == 'monthly') actived @endif">
        <a href="{{ url('/') }}/reports/monthly" class="text-capitalize">
            Monthly Report
        </a>
    </li>
    <li class="list-group-item menu-link @if($active == 'export') actived @endif">
        <a href="{{ url('/') }}/reports/custom" class="text-capitalize">
            Export
        </a>
    </li>
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
    <li class="list-group-item active">Setting</li>
    <li class="list-group-item menu-link">
        <a href="{{ url('/') }}/settings?type=rewards" class="text-capitalize">
            Configs
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