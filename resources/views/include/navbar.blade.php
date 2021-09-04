<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	<div class="container">

		<a class="navbar-brand" href="index.html"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
		</button>

		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active"><a href="{{URL::to('/')}}" class="nav-link">Home</a></li>
				<li class="nav-item active"><a href="{{route('shop')}} " class="nav-link">shop</a></li>
				
				
				<li class="nav-item cta cta-colored"><a href="{{route('cart')}} " class="nav-link"><span class="icon-shopping_cart"></span>[{{Session::has('cart')? Session::get('cart')->integer_quantity:0 }}]</a></li>
				@guest
				@if (Route::has('login'))
				<li class="nav-item active"><a href="{{URL::to('/login')}}" class="nav-link"><span class="fa fa-user">Login</span></a></li>
				@endif

				@else
				<li class="nav-item active"><a href="{{route('profile')}} " class="nav-link">profile</a></li>

				<li class="nav-item active"> <a  class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
				<span class="fa fa-user">	{{ __('Logout') }}</span>
				</a></li>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
					@csrf
				</form>

				@endguest


			</ul>



		</div>
	</div>



</nav>

<nav class="navbar navbar-light bg-light">
	<a class="navbar-brand">Find your product</a>
	<form class="form-inline" action="/search">
		<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query">
		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	</form>
</nav>
<!-- END nav -->