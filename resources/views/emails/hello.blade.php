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
			<div style="width: 20%; float: left;"><a href="http://gmon.vn/job/{{ $job->id }}/{{ $job->slug }}"><img src="http://test.gmon.com.vn/?image={{ $job->logo }}" class="img-responsive" alt="http://test.gmon.com.vn/?image={{ $job->logo }}" style="width: 100%;border: 5px solid #eee;border-radius: 5px;"></a></div>
			<div style="width: 77%; float: left; margin-left: 3%;">
			<div style="font-size: 26px; font-weight: bold; color:#ff00a3; margin-bottom: 5px;"><a href="http://gmon.vn/job/{{ $job->id }}/{{ $job->slug }}" style="text-decoration: none; color:#ff00a3;">{{ $job->number }} {{ $job->name }} tại <span style="text-transform: capitalize;">{{ $job->companyname }}</span></a></div>
			<div style="">Địa chỉ tại: {{ $job->district }}, {{ $job->city }}</div>
			<div style="">Mức lương: <span style="font-size:20px; font-weight: bold; color:red;">{{ $job->salary }}</span></div>
			<div style="">Mô tả công việc:
				<?php 
					echo str_replace("p>", "div>", $job->description); 
					?>
			</div>
			<div style="">Chi tiết tại: <a href="http://gmon.vn/job/{{ $job->id }}/{{ $job->slug }}">http://gmon.vn/job/{{ $job->id }}/{{ $job->slug }}</a></div>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
</body>
</html>