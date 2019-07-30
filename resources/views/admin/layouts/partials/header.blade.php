<div class="page-header page-header-default">
  <div class="page-header-content">
    <div class="page-title" style="{{ @$subtitle ? 'padding: 22px 36px 22px 0' : '' }}">
      <h4><i class="icon-arrow-right15 position-left"></i> {{ $title ? : '' }}</h4>
      @if (@$subtitle)
        <div class="text-muted ml-20 pl-10">{{ $subtitle }}</div>
      @endif
    </div>

    <div class="heading-elements">
      <div class="heading-btn-group">
        @php ($now = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta'))
        <a class="btn btn-link btn-float text-size-small has-text">
          <i class="icon-calendar52 text-teal-600"></i>
          <span class="text-muted">{{ $now->format('d M Y') }}</span>
        </a>
        <a class="btn btn-link btn-float text-size-small has-text">
          <i class="icon-alarm text-teal-600"></i>
          <span class="text-muted time-timer">{{ $now->format('H:i:s') }}</span>
        </a>
        {{-- <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> --}}
      </div>
    </div>

    <script type="text/javascript">
      $(function() {
        setInterval(function(){
          $('.time-timer').text(new Date().toLocaleTimeString('it-ID'));
        }, 1000);
      });
    </script>

  </div>

  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}"><i class="icon-home2 position-left"></i> Dashboard</a></li>
      @foreach ($breadcrumbs as $breadcrumb)
        <li class="{{ $loop->last ? 'active' : '' }}">
          @if (is_array($breadcrumb))
            <a href="{{ @$breadcrumb[1] }}">{{ $breadcrumb[0] }}</a>
          @else
            {{ $breadcrumb }}
          @endif
        </li>
      @endforeach
    </ul>

    {{-- <ul class="breadcrumb-elements">
      <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="icon-gear position-left"></i>
          Settings
          <span class="caret"></span>
        </a>

        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
          <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
          <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
          <li class="divider"></li>
          <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
        </ul>
      </li>
    </ul> --}}
  </div>
</div>
