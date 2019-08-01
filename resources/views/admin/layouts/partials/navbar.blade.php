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

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="icon-puzzle3"></i>
          <span class="visible-xs-inline-block position-right">Git updates</span>
          <span class="status-mark border-orange-400"></span>
        </a>

        <div class="dropdown-menu dropdown-content">
          <div class="dropdown-content-heading">
            Git updates
            <ul class="icons-list">
              <li><a href="#"><i class="icon-sync"></i></a></li>
            </ul>
          </div>

          <ul class="media-list dropdown-content-body width-350">
            <li class="media">
              <div class="media-left">
                <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
              </div>

              <div class="media-body">
                Drop the IE <a href="#">specific hacks</a> for temporal inputs
                <div class="media-annotation">4 minutes ago</div>
              </div>
            </li>

            <li class="media">
              <div class="media-left">
                <a href="#" class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></a>
              </div>

              <div class="media-body">
                Add full font overrides for popovers and tooltips
                <div class="media-annotation">36 minutes ago</div>
              </div>
            </li>

            <li class="media">
              <div class="media-left">
                <a href="#" class="btn border-info text-info btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-branch"></i></a>
              </div>

              <div class="media-body">
                <a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span> branch
                <div class="media-annotation">2 hours ago</div>
              </div>
            </li>

            <li class="media">
              <div class="media-left">
                <a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-merge"></i></a>
              </div>

              <div class="media-body">
                <a href="#">Eugene Kopyov</a> merged <span class="text-semibold">Master</span> and <span class="text-semibold">Dev</span> branches
                <div class="media-annotation">Dec 18, 18:36</div>
              </div>
            </li>

            <li class="media">
              <div class="media-left">
                <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
              </div>

              <div class="media-body">
                Have Carousel ignore keyboard events
                <div class="media-annotation">Dec 12, 05:46</div>
              </div>
            </li>
          </ul>

          <div class="dropdown-content-footer">
            <a href="#" data-popup="tooltip" title="All activity"><i class="icon-menu display-block"></i></a>
          </div>
        </div>
      </li>
    </ul>

    <div class="navbar-right">
      <p class="navbar-text">Welcome, {{ Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name }}!</p>
      {{-- <p class="navbar-text"><span class="label bg-success-400">Online</span></p> --}}

      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="icon-bell2"></i>
            <span class="visible-xs-inline-block position-right">Activity</span>
            <span class="status-mark border-orange-400"></span>
          </a>

          <div class="dropdown-menu dropdown-content">
            <div class="dropdown-content-heading">
              Activity
              <ul class="icons-list">
                <li><a href="#"><i class="icon-menu7"></i></a></li>
              </ul>
            </div>

            <ul class="media-list dropdown-content-body width-350">
              <li class="media">
                <div class="media-left">
                  <a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs"><i class="icon-mention"></i></a>
                </div>

                <div class="media-body">
                  <a href="#">Taylor Swift</a> mentioned you in a post "Angular JS. Tips and tricks"
                  <div class="media-annotation">4 minutes ago</div>
                </div>
              </li>

              <li class="media">
                <div class="media-left">
                  <a href="#" class="btn bg-pink-400 btn-rounded btn-icon btn-xs"><i class="icon-paperplane"></i></a>
                </div>

                <div class="media-body">
                  Special offers have been sent to subscribed users by <a href="#">Donna Gordon</a>
                  <div class="media-annotation">36 minutes ago</div>
                </div>
              </li>

              <li class="media">
                <div class="media-left">
                  <a href="#" class="btn bg-blue btn-rounded btn-icon btn-xs"><i class="icon-plus3"></i></a>
                </div>

                <div class="media-body">
                  <a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span> branch in <span class="text-semibold">Limitless</span> repository
                  <div class="media-annotation">2 hours ago</div>
                </div>
              </li>

              <li class="media">
                <div class="media-left">
                  <a href="#" class="btn bg-purple-300 btn-rounded btn-icon btn-xs"><i class="icon-truck"></i></a>
                </div>

                <div class="media-body">
                  Shipping cost to the Netherlands has been reduced, database updated
                  <div class="media-annotation">Feb 8, 11:30</div>
                </div>
              </li>

              <li class="media">
                <div class="media-left">
                  <a href="#" class="btn bg-warning-400 btn-rounded btn-icon btn-xs"><i class="icon-bubble8"></i></a>
                </div>

                <div class="media-body">
                  New review received on <a href="#">Server side integration</a> services
                  <div class="media-annotation">Feb 2, 10:20</div>
                </div>
              </li>

              <li class="media">
                <div class="media-left">
                  <a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-xs"><i class="icon-spinner11"></i></a>
                </div>

                <div class="media-body">
                  <strong>January, 2016</strong> - 1320 new users, 3284 orders, $49,390 revenue
                  <div class="media-annotation">Feb 1, 05:46</div>
                </div>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
