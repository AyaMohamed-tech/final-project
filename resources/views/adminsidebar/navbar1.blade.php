<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="{{asset('backend/images/2h_.png')}}" class="mr-2" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-layout-grid2"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
            <button type="button" class="btn btn-primary">
              Notifications <span class="badge badge-light">{{auth()->user()->notifications->where('read_at', null)->count()}}</span>
              <span class="sr-only">unread messages</span>
            </button>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              @foreach(auth()->user()->notifications->where('read_at', null) as $notification)
              <a class="dropdown-item"  href="{{URL::to('/admin/notifications/' . $notification->id)}}">
                <i class="ti-power-off text-primary"></i>
                {{ $notification->data['name'] }} received order
              </a>
              @endforeach
            </div>
          </li>
          
          <li class="nav-item active"><a  href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="nav-link"><span class="fa fa-user"></span>Logout</a></li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
					@csrf
				</form>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-layout-grid2"></span>
        </button>
      </div>
    </nav>