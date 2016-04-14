<link type="text/css" rel="stylesheet" href="cv-style.css">
<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300' rel='stylesheet' type='text/css'>
@extends('layout')
@section('content')
<!-- Begin content -->
<h1>CURRICULUM VITAE</h1>

<div id="jobseach-cv">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">CV của bạn</a></li>
		<li role="presentation"><a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">Chỉnh sửa CV</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="home">
			<div id="cv" class="instaFade">
				<div class="mainDetails">
					<div id="headshot" class="quickFade">
						<img src="/img/headshot.jpg" alt="Alan Smith" />
					</div>
					
					<div id="name">
						<h1 class="quickFade delayTwo">FULL NAME</h1>
						<h2 class="quickFade delayThree">Job Title</h2>
					</div>
					
					<div id="contactDetails" class="quickFade delayFour">
						<ul>
							<li>e: <a href="mailto:joe@bloggs.com" target="_blank">joe@bloggs.com</a></li>
							<li>w: <a href="http://www.bloggs.com">www.bloggs.com</a></li>
							<li>m: 01234567890</li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
				
				<div id="mainArea" class="quickFade delayFive">
					<section>
						<article>
							<div class="sectionTitle">
								<h1>Personal Profile</h1>
							</div>
							
							<div class="sectionContent">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dolor metus, interdum at scelerisque in, porta at lacus. Maecenas dapibus luctus cursus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies massa et erat luctus hendrerit. Curabitur non consequat enim. Vestibulum bibendum mattis dignissim. Proin id sapien quis libero interdum porttitor.</p>
							</div>
						</article>
						<div class="clear"></div>
					</section>
					
					
					<section>
						<div class="sectionTitle">
							<h1>Work Experience</h1>
						</div>
						
						<div class="sectionContent">
							<article>
								<h2>Job Title at Company</h2>
								<p class="subDetails">April 2011 - Present</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies massa et erat luctus hendrerit. Curabitur non consequat enim. Vestibulum bibendum mattis dignissim. Proin id sapien quis libero interdum porttitor.</p>
							</article>
							
							<article>
								<h2>Job Title at Company</h2>
								<p class="subDetails">Janruary 2007 - March 2011</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies massa et erat luctus hendrerit. Curabitur non consequat enim. Vestibulum bibendum mattis dignissim. Proin id sapien quis libero interdum porttitor.</p>
							</article>
							
							<article>
								<h2>Job Title at Company</h2>
								<p class="subDetails">October 2004 - December 2006</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies massa et erat luctus hendrerit. Curabitur non consequat enim. Vestibulum bibendum mattis dignissim. Proin id sapien quis libero interdum porttitor.</p>
							</article>
						</div>
						<div class="clear"></div>
					</section>
					
					
					<section>
						<div class="sectionTitle">
							<h1>Key Skills</h1>
						</div>
						
						<div class="sectionContent">
							<ul class="keySkills">
								<li>A Key Skill</li>
								<li>A Key Skill</li>
								<li>A Key Skill</li>
								<li>A Key Skill</li>
								<li>A Key Skill</li>
								<li>A Key Skill</li>
								<li>A Key Skill</li>
								<li>A Key Skill</li>
							</ul>
						</div>
						<div class="clear"></div>
					</section>
					
					
					<section>
						<div class="sectionTitle">
							<h1>Education</h1>
						</div>
						
						<div class="sectionContent">
							<article>
								<h2>College/University</h2>
								<p class="subDetails">Qualification</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies massa et erat luctus hendrerit. Curabitur non consequat enim.</p>
							</article>
							
							<article>
								<h2>College/University</h2>
								<p class="subDetails">Qualification</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies massa et erat luctus hendrerit. Curabitur non consequat enim.</p>
							</article>
						</div>
						<div class="clear"></div>
					</section>
					
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="edit">
			<!-- Make CV -->
			<div id="make-cv">
				<h1 class="text-center">Tạo CV bằng cách điền đầy đủ thông tin dưới đây!</h1>
				<hr>
				<form action="/cv/update" method="get" accept-charset="utf-8">
					<div class="form-group row">
						<label class="col-sm-3">Họ & Tên: </label>
						<input class="col-sm-7" type="text" name="full_name" value="">
					</div>
					<div class="form-group row">
						<label class="col-sm-3">Job Title: </label>
						<input class="col-sm-7" type="text" name="job_title" value="">
					</div>
					<div class="form-group row">
						<label class="col-sm-3">Email: </label>
						<input class="col-sm-7" type="text" name="email" value="">
					</div>
					<div class="form-group row">
						<label class="col-sm-3">Website: </label>
						<input class="col-sm-7" type="text" name="website" value="">
					</div>
					<div class="form-group row">
						<label class="col-sm-3">Số Điện Thoại: </label>
						<input class="col-sm-7" type="text" name="mobile" value="">
					</div>
					<div class="form-group row">
						<label class="col-sm-3">Mô tả cá nhân: </label>
						<textarea class="col-sm-7" name="your_info"></textarea>
					</div>
					<div class="form-group row">
						<label class="col-sm-3">Kinh nghiệp làm việc: </label>
						<input class="col-sm-7" type="text" name="job_history" value="">
					</div>
					<div class="form-group row">
						<label class="col-sm-3">Kỹ Năng: </label>
						<input class="col-sm-7" type="text" name="skill" value="">
					</div>
					<button type="submit">Lưu</button>
					<button type="reset">Hủy</button>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- End Content -->
<<script src="/javascripts/application.js" type="text/javascript" charset="utf-8" async defer>
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		e.target // newly activated tab
		e.relatedTarget // previous active tab
	})
</script>
</div>
@endsection
