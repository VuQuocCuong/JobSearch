@extends('layout')
@section('content')
<div id="main-div-after">
	<h1>Sign In</h1>
	<form method="post" id="loginForm">
		<fieldset>
			<div class="inputName">Username</div>
			<div class="inputField"><input type="text" name="username" id="login-username"></div>
		</fieldset>
		<fieldset>
			<div class="inputName">Password</div>
			<div class="inputField"><input type="password" name="password" id="login-password"></div>
		</fieldset>
		<fieldset>
			<div class="inputName">&nbsp;</div>
			<div class="inputField"><input type="checkbox" name="keep" id="keep"><label for="keep"> Keep me signed in</label></div>
		</fieldset>
		<fieldset>
			
		</fieldset>
		<fieldset>
			<div class="inputName">&nbsp;</div>
			<div class="inputButton"><input type="button" value="Login" class="button submit"></div>
		</fieldset>
	</form>
	<br><a href="http://hackathon.volunteerhousevietnam.org/password-recovery/">Forgot Your Password?</a>&nbsp;|&nbsp; <a href="http://hackathon.volunteerhousevietnam.org/registration/">Registration</a>
	
	<fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>

	<div class="clr"><br></div>
	<div id="grayBgBanner"></div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#loginForm .submit").click(function(event) {
			var username = $('input#login-password').val();
			var password = md5($('input#login-username').val());
		});
	});
</script>
@endsection