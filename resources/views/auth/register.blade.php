@extends('layout')
@section('content')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<div id="main-div-after">
	<h1>Employer Registration</h1>
	<br>Fields marked with an asterisk (<font color="red">*</font>) are mandatory<br>
	<form method="post" action="/auth/register" id="registr-form">
		<fieldset>
			<div class="inputName">User name</div>
			<div class="inputReq">&nbsp;*</div>
				<input type="text" value="" class="" name="username" id="username">
				<span class="aMessage"></span>
		</fieldset>
		<fieldset>
			<div class="inputName">Password</div>
			<div class="inputReq">&nbsp;*</div>
			<div class="inputField">
				<input type="password" name="password" class="inputString " id="password"><br>
				<input type="password" name="password_confirmed" class="inputString" id="password_confirmed" style="margin-top:2px;"><br>
				<span style="font-size:11px">Confirm Password</span>
			</div>
		</fieldset>
		<fieldset>
			<div class="inputName">Email</div>
			<div class="inputReq">&nbsp;*</div>
			<div class="inputField">
				<input type="text" value="" class="inputString " name="email" id="email">
				<span class="aMessage" ></span>
				<br>
			</div>
		</fieldset>
		<fieldset>
			<div class="inputName">Accept terms of use</div>
			<div class="inputReq">*</div>
			<div class="inputField">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="checkbox" name="terms" id="terms">
				<a style="cursor:pointer; color: #666666; text-decoration:underline;">Read terms of use</a>
			</div>
		</fieldset>
		<fieldset>
			<div class="inputName">&nbsp;</div>
				<div class="inputReq">&nbsp;</div>
				<div class="inputField"><input type="hidden" name="user_group_id" value="Employer">
				<input type="submit" value="Register">
			</div>
		</fieldset>
	</form>
<script type="text/javascript">
	function checkform() {
			if (!document.getElementById('terms').checked) {
		alert('Read terms of use');
		return false;
	}
		return true;
	}
</script>
<script type="text/javascript">
	$('#registr-form').validate({
		rules: {
			username:{
				required: true,
				minlength: 3
			},
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength: 6
			},
			password_confirmed: {
				equalTo: "#password"
			}
		}
	});
</script>
<div class="clr"><br></div>
</div>
@endsection