<!--<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner">
        <div class="page-header-inner">
            <div class="navbar-header">
                <a href="{{ url(config('quickadmin.homeRoute')) }}" class="navbar-brand">
                    {{ trans('quickadmin::admin.partials-topbar-title') }}
                </a>
            </div>
            <a href="javascript:;"
               class="menu-toggler responsive-toggler"
               data-toggle="collapse"
               data-target=".navbar-collapse">
            </a>

            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">

                </ul>
            </div>
        </div>
    </div>
</div>-->
<header class="admin-header">
	<div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url(config('quickadmin.homeRoute')) }}"><img src="images/psn-logo.png" alt="" class="img-responsive">{{ trans('quickadmin::admin.partials-topbar-title') }}</a>
        </div>
        
         <div class="admin-menu">
         	<div class="welcome">Welcome, <strong>Admin</strong></div>
            <div class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
              <ul class="dropdown-menu">
                <li>
                    <a href="{{ route('changepassword.index') }}">
                        <i class="fa fa-key"></i>
                        <span class="title">Change Password</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('changeemail.index') }}">
                        <i class="fa fa-envelope"></i>
                        <span class="title">Change Email</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('sitesettings.index') }}">
                        <i class="fa fa-database"></i>
                        <span class="title">Site Settings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('logout') }}">
                        <i class="fa fa-sign-out"></i>
                        <span class="title">Logout</span>
                    </a>
                </li>
              </ul>
            </div>
      </div>
        
    </div>
</header>