@extends('layouts.login')

@section('title')
  Log in
@endsection

@section('content')
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('frontend/Login/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form">
				  <a href="{{URL::to('/')}}">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>
				  </a>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Don't have an account ? Signup
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
@endsection