@php ($route = Route::currentRouteName())
@php ($sentinel = \Sentinel::getUser())

<div class="sidebar sidebar-main sidebar-default sidebar-fixed">
  <div class="sidebar-content">

    <div class="sidebar-user-material">
      <div class="category-content" style="background: #ffffff;">
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

    <div class="sidebar-category sidebar-category-visible">
      <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
          <li class="navigation-header"><span>Menu</span> <i class="icon-menu" title="Main pages"></i></li>
          {!! \App\Libraries\MenuLib::init() !!}
        </ul>
      </div>
    </div>
  </div>
</div>
