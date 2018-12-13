<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="margin: 20px;">
	<h1 style="text-align: center;">Đây là email thông báo yêu cầu dịch vụ được khởi tạo</h1>
	<h3 style="margin-left: 10px;">Chi tiết yêu cầu như sau:</h3>
	<div class="jobs-component">
		<div style="margin: 10px; border: 1px solid #eee; border-radius: 5px; padding: 16px; font-size: 16px; line-height: 25px;" class="job-component">
			<div style="width: 20%; float: left;">
				<img src="http://api.timtruyen.online/public/images/{{ $job->image }}" class="img-responsive" alt="http://api.timtruyen.online/public/images/{{ $job->image }}" style="width: 100%;border: 5px solid #eee;border-radius: 5px;">
			</div>
			<div style="width: 77%; float: left; margin-left: 3%;">
				<div style="font-size: 26px; font-weight: bold; color:#ff00a3; margin-bottom: 5px;">
					{{ $job->user->name }} tại <span style="text-transform: capitalize;">{{ $job->address }}</span>
				</div>
				<div style="">
					Số tiền: <span style="font-size:20px; font-weight: bold; color:red;">{{ $job->price }}</span>
				</div>
				<div style="">
					Chi tiết đầu việc:
					@foreach($job->packages as $package)
			                            <li>{{ $package->pivot->number }} {{ $package->name }}</li>
			                          @endforeach
				</div>
			</div>
		</div>
	</div>
</body>
</html>