<?php $user = Session::get('user'); ?>

<div id="header">
	<div id="header-left">
		<a href="/"><img src="/img/logo.png" border="0" alt="Social Job Search" title="Social Job Search"></a>
		<div class="clr"><br></div>
	</div>
	<div id="header-right">
		<div class="clr"><br></div>
		<div class="header-user-menu">
		@if ( !($user) )
		    <div class="login-facebook">
				<a href="/auth/facebook">
					<img src="/img/facebook-login.png" alt="facebook login">
				</a>
			</div>
		@else
			<span>Welcome <span class="longtext-60 tooltip-counter-0"><b>{{ $user['name'] }}</b></span> &nbsp;
												&nbsp;&nbsp;|&nbsp;&nbsp;
				<a href="/auth/logout">Logout</a>
			</span>
			<br>
		@endif
	</div>
	</div>

	<div class="clr"></div>
	<div id="top-menu">
		<ul>
			<li><a href="/cv">CV</a></li>
			<li><a href="#">Menu</a></li>
			<li><a href="#">Menu</a></li>
			<li><a href="#">Menu</a></li>
		</ul>
	</div>
</div>
<div class="clr"></div>
