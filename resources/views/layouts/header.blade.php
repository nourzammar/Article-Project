    <!-- Navbar Start -->
    <div class="container-fluid bg-light position-relative shadow">
        <nav
          class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5"
        >
          <a
            href="{{url('/')}}"
            class="navbar-brand font-weight-bold text-secondary"
            style="font-size: 50px"
          >
            <i class="flaticon-043-teddy-bear"></i>
            <span class="text-primary">Article </span>
          </a>
          <button
            type="button"
            class="navbar-toggler"
            data-toggle="collapse"
            data-target="#navbarCollapse"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
          
            <div class="navbar-nav font-weight-bold mx-auto py-0">
              <a href="{{url('')}}" class="nav-item nav-link " >Home</a>
            </div>
            @if (Auth::check())
            <a href="{{url('profile')}}" class="btn btn-primary px-4  " >Profile</a>
            <a href="{{url('logout')}}" class="btn btn-primary px-4" >LogOut</a>
            @else
            <a href="{{url('login')}}" class="btn btn-primary px-4" >Login</a>
            <a href="{{url('register')}}" class="btn btn-primary px-4" >Register</a>
            @endif
          </div>
        </nav>
      </div>
      <!-- Navbar End -->