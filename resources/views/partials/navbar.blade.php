<!-- Navbar Top -->
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="{{ route('welcome') }}">@lang('global.home')</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="@lang('global.search')" aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-link">
        <span class="mr-2">{{auth()->user()->name}}</span>
        @if(auth()->user()->avatar == 0)
            <i class="fas fa-user-circle fa-fw"></i>
        @else
            <img height="30" width="30" src="/storage/avatars/{{ auth()->user()->avatar }}" />
        @endif
      </li>
    </ul>

  </nav>
