<!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item {{ Request::is('home') ? 'active': ''}}">
        <a class="nav-link" href="{{ route('home')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>@lang('global.dashboard')</span>
        </a>
      </li>
      <div class="border-top">
        <li class="nav-item {{ Request::is('home/calendar') ? 'active': ''}}">
            <a class="nav-link" href="{{ route('home.calendar')}}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>@lang('global.calendar')</span></a>
        </li>
        <li class="nav-item {{ Request::is('home/importView') ? 'active': ''}}">
                <a class="nav-link" href="{{ route('home.importView')}}">
                <i class="fas fa-file-import"></i>
                <span>@lang('global.import')</span></a>
            </li>
        <li class="nav-item {{ Request::is('home/tables') ? 'active': ''}}">
            <a class="nav-link" href="{{ route('home.tables')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>@lang('global.users')</span></a>
        </li>
      </div>
      <div class="border-top">
        <li class="nav-item {{ Request::is('home/reservations') ? 'active': ''}}">
            <a class="nav-link" href="{{ route('home.reservations')}}">
              <i class="fas fa-fw fa-table"></i>
              <span>@lang('global.reservations')</span></a>
          </li>
          <li class="nav-item {{ Request::is('home/reservations/calendar') ? 'active': ''}}">
            <a class="nav-link" href="{{ route('home.reservations.calendar')}}">
              <i class="fas fa-fw fa-calendar"></i>
              <span>@lang('global.reservationscalendar')</span></a>
          </li>
          <li class="nav-item {{ Request::is('home/customers') ? 'active': ''}}">
            <a class="nav-link" href="{{ route('home.customers')}}">
              <i class="fas fa-fw fa-user-circle"></i>
              <span>@lang('global.customers')</span></a>
          </li>
      </div>
      <div class="border-top">
        <li class="nav-item {{ Request::is('home/restaurant') ? 'active': ''}}">
            <a class="nav-link" href="{{ route('home.restaurant-tables')}}">
              <i class="fas fa-fw fa-table"></i>
              <span>@lang('global.restaurant-tables')</span></a>
          </li>
      </div>
      <div class="border-top border-bottom">
        <li class="nav-item {{ Request::is('home/profile') ? 'active': ''}}">
            <a class="nav-link" href="{{ route('home.profile.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>@lang('global.profile')</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>@lang('global.logout')</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </div>
    </ul>
