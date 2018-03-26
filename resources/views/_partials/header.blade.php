@section('header')
<!-- Main navbar -->
<div class="navbar navbar-inverse bg-indigo">
  <div class="navbar-header">
    <!--<a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>-->
    <a class="navbar-brand" href=""><strong>iCheck</strong> for business</a>

    <ul class="nav navbar-nav pull-right visible-xs-block">
      <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
    </ul>
  </div>

  <div class="navbar-collapse collapse" id="navbar-mobile">
    <ul class="nav navbar-nav navbar-right">
      @if (auth()->check())
      <li class="dropdown dropdown-user">
        <a class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{ asset('assets/images/image.png') }}" alt="">
          <span ng-bind="$root.user.name">{{ auth()->user()->name }}</span>
          <i class="caret"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="{{ url('logout') }}"><i class="icon-switch2"></i> Đăng xuất</a></li>
        </ul>
      </li>
      @else
      <li><a href="/login">Đăng nhập</a>
      <li><a href="/register">Đăng ký</a>
      @endif
    </ul>
  </div>
</div>
<!-- /main navbar -->
@show
