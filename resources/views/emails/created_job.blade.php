<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="margin: 20px;">
	<h1 style="text-align: center;">Đây là email thông báo yêu cầu dịch vụ được khởi tạo</h1>
	<h3 style="margin-left: 10px;">Chi tiết yêu cầu như sau:</h3>
	<div class="jobs-component">
		<div style="font-size: 16px; line-height: 25px;" class="job-component">
			<div style="width: 77%; float: left; margin-left: 3%;">
				<div style="font-size: 26px; font-weight: bold; color:#ff00a3; margin-bottom: 5px;">
					{{ $job->user->name }} 
				</div>
				<div style="font-size: 26px; font-weight: bold; margin-bottom: 5px;">
					<span style="text-transform: capitalize;">{{ $job->address }}</span>
				</div>
				<div style="">
					Số tiền: <span style="font-size:20px; font-weight: bold; color:red;">{{ number_format($job->price, 0) }} vnd</span>
				</div>
				<div style="">
					Chi tiết đầu việc:
					<ul style="margin:0; padding:0 15px;"> 
					@foreach($job->products as $product)
			            <li>{{ $product->name }}: {{ $product->pivot->number }}</li>
			        @endforeach
			    	</ul>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</body>
</html>