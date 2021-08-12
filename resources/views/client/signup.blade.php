@extends('layouts.login')
@section('title')
Sign up
@endsection
@section('content')
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url(frontend/login/images/bg-01.jpg);">
			<div class="wrap-login1001">
				@if(Session::has('status'))
				   <div class="alert alert-success">
					   {{Session::get('status')}}
				   </div>
				@endif
				@if(count($errors) >0)
				   <div class="alert alert-danger">
					  <ul>
                         @foreach($errors->all() as $error)
						     <li> {{$error}}</li>
						 @endforeach

					  </ul>
				   </div>
				@endif
				<form class="login100-form validate-form" action="{{url('/createaccount')}}" method="POST">
				{{csrf_field()}}
                <a href="{{URL::to('/')}}">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>
                </a>
					<span class="login100-form-title p-b-34 p-t-27">
                    Sign up

					</span>
					<div class="wrap-input100 validate-input" data-validate = "Enter your name">
						<input class="input100" type="text" name="name" placeholder="Name">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter email">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Sign up
						</button>
					</div>
					
					<div class="text-center p-t-90">
						<a class="txt1" href="/login">
							<h6>Do you Have an account ? SignIn</h6>
                        </a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
    @endsection