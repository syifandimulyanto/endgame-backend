<div class="navbar navbar-inverse navbar-fixed-top bg-teal-600">
  <div class="navbar-header">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
       <img src="{{ asset('assets/admin/images/logo_dark.png') }}">
    </a>

    <ul class="nav navbar-nav visible-xs-block">
      <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
      <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
    </ul>
  </div>

  <div class="navbar-collapse collapse" id="navbar-mobile">
    <ul class="nav navbar-nav">
      <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
    </ul>

    <div class="navbar-right">
      <p class="navbar-text"> {{ Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name }}!</p>
      <p class="navbar-text"><span class="label bg-teal-400">Online</span></p>
      </a>
    </div>
  </div>
</div>
