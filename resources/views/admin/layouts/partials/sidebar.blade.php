@php ($route = Route::currentRouteName())
@php ($sentinel = \Sentinel::getUser())

<div class="sidebar sidebar-main sidebar-default sidebar-fixed">
  <div class="sidebar-content">

    <!-- User menu -->
    <div class="sidebar-user-material">
      <div class="category-content" style="background:url({{ asset('assets/admin/images/login_cover.jpg') }}) no-repeat right bottom; background-size:440px">
        <div class="sidebar-user-material-content">
          <a href="#" class="legitRipple">
              <img src="{{ asset('assets/admin/images/avatar2.png') }}" class="img-circle img-responsive">
          </a>
          <h6>{{ Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name }}</h6>
        </div>

        <div class="sidebar-user-material-menu">
          <a href="#user-nav" data-toggle="collapse"><span>My Account</span> <i class="caret"></i></a>
        </div>
      </div>

      <div class="navigation-wrapper collapse" id="user-nav">
        <ul class="navigation">
          <li>
            <a href="#"><i class="icon-vcard text-success"></i> <span>My Profile</span></a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="#"><i class="icon-cog5 text-primary"></i> <span>Settings</span></a>
          </li>
          <li>
            <a href="">
              <i class="icon-switch2 text-danger"></i> <span>Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- /user menu -->

    <!-- Main navigation -->
    <div class="sidebar-category sidebar-category-visible">
      <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">

          <!-- Menu -->
          <li class="navigation-header"><span>Menu</span> <i class="icon-menu" title="Main pages"></i></li>

          {{-- Dashboard --}}
          <li class="{{ $route == 'admin.dashboard' ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}"><i class="icon-shutter"></i> <span>Dashboard</span></a>
          </li>

          {!! \App\Libraries\MenuLib::init() !!}

        </ul>
      </div>
    </div>
    <!-- /main navigation -->

  </div>
</div>
