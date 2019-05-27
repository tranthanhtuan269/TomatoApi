<?php

	$list = [
        ['services', 'Dịch vụ'],
        ['news', 'Tin tức'],
        ['users', 'Tài khoản'],
        ['coupons', 'Mã giảm giá'],
        ['partners', 'Đối tác'],
        ['cooperators', 'Cộng tác viên']
    ];

?>

<ul class="list-group">
    <li class="list-group-item active">Báo cáo</li>
    <li class="list-group-item menu-link @if($active == 'daily') actived @endif">
        <a href="{{ url('/') }}/reports/daily" class="text-capitalize">
            Báo cáo ngày
        </a>
    </li>
    <li class="list-group-item menu-link @if($active == 'weekly') actived @endif">
        <a href="{{ url('/') }}/reports/weekly" class="text-capitalize">
            Báo cáo tuần
        </a>
    </li>
    <li class="list-group-item menu-link @if($active == 'monthly') actived @endif">
        <a href="{{ url('/') }}/reports/monthly" class="text-capitalize">
            Báo cáo tháng
        </a>
    </li>
    <li class="list-group-item menu-link @if($active == 'export') actived @endif">
        <a href="{{ url('/') }}/reports/user" class="text-capitalize">
            Xuất báo cáo theo tài khoản
        </a>
    </li>
    <li class="list-group-item menu-link @if($active == 'export') actived @endif">
        <a href="{{ url('/') }}/reports/custom" class="text-capitalize">
            Xuất báo cáo
        </a>
    </li>
</ul>

<ul class="list-group">
    <li class="list-group-item active">Đơn hàng</li>
    <li class="list-group-item menu-link @if($active == 'new') actived @endif">
        <a href="{{ url('/') }}/orders/new" class="text-capitalize">
            Đơn mới
        </a>
    </li>
    <li class="list-group-item menu-link @if($active == 'accepted') actived @endif">
        <a href="{{ url('/') }}/orders/accepted" class="text-capitalize">
            Đơn đã duyệt
        </a>
    </li>
    <li class="list-group-item menu-link @if($active == 'paid') actived @endif">
        <a href="{{ url('/') }}/orders/paid" class="text-capitalize">
            Đơn đã thanh toán
        </a>
    </li>
    <li class="list-group-item menu-link @if($active == 'cancel') actived @endif">
        <a href="{{ url('/') }}/orders/cancel" class="text-capitalize">
            Đơn đã hủy
        </a>
    </li>
</ul>

<ul class="list-group">
	<li class="list-group-item active">Danh mục</li>
	@foreach($list as $item)
    <li class="list-group-item menu-link @if($active == $item) actived @endif">
    	<a href="{{ url('/') }}/{{ $item[0] }}" class="text-capitalize">
    		{{ $item[1] }}
    	</a>
    </li>
    @endforeach
</ul>

<ul class="list-group">
    <li class="list-group-item active">Cấu hình</li>
    <li class="list-group-item menu-link">
        <a href="{{ url('/') }}/settings?type=rewards" class="text-capitalize">
            Phần thưởng
        </a>
    </li>
</ul>

<ul class="list-group">
	<li class="list-group-item active">Các trang</li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=whyUse" class="text-capitalize">
    		Tại sao sử dụng HSP
    	</a>
	</li>
    <li class="list-group-item menu-link">
        <a href="{{ url('/') }}/pages?type=invite" class="text-capitalize">
            Mời bạn
        </a>
    </li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=warranties" class="text-capitalize">
    		Bảo hành
    	</a>
	</li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=bestPractices" class="text-capitalize">
    		Trải nghiệm tốt
    	</a>
	</li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=faqs" class="text-capitalize">
    		Câu hỏi và trả lời
    	</a>
	</li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=Contact" class="text-capitalize">
    		Liên hệ
    	</a>
	</li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=legal" class="text-capitalize">
    		Điều khoản sử dụng
    	</a>
	</li>
	<li class="list-group-item menu-link">
		<a href="{{ url('/') }}/pages?type=about" class="text-capitalize">
    		Về chúng tôi
    	</a>
	</li>
</ul>