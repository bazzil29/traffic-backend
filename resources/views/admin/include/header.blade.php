<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
    {{--<span class="logo-mini"><b>Talaha</b></span>--}}
    <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Traffic</b> admin area</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                @if(isset(Auth::user()->name))
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if (($img = Auth::user()->img) == null)
                                <img src="{{asset('uploads/img_profile/meo.jpg')}}" class="user-image" alt="User Image">
                            @else
                                <img src="{{asset("uploads/img_profile/$img")}}" class="user-image" alt="User Image">
                            @endif
                            <span class="hidden-xs">{{Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                @if (($img = Auth::user()->img) == null)
                                    <img src="{{asset('uploads/img_profile/meo.jpg')}}" class="img-circle"
                                         alt="User Image">
                                @else
                                    <img src="{{asset("uploads/img_profile/$img")}}" class="img-circle"
                                         alt="User Image">
                                @endif
                                <p>
                                    {{Auth::user()->name}}
                                    <small>Member since {{Auth::user()->created_at->toFormattedDateString()}}</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{url('profile')}}" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="" onclick="   event.preventDefault();
                                                       document.getElementById('logout-form').submit();"
                                       class="btn btn-default btn-flat">
                                        Sign out
                                    </a>
                                    <form action="{{route('logout')}}" method="post" id="logout-form">
                                        {{csrf_field()}}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="dropdown user user-menu">
                        <a href="{{route('login')}}" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">Login</span>
                        </a>
                    </li>
            @endif
            <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>