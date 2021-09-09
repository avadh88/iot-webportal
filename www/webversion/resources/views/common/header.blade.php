<header class="header">
    <nav class="navbar navbar-expand-md navbar-fixed-top" role="navigation">
        <a href="{{ url('dashboard') }}" class="logo">
            <img src="{{ session('company_logo') }}" alt="logo"/>
        </a>
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <i
                    class="fa fa-fw fa-bars"></i>
            </a>
        </div>
        <div class="navbar-right ml-auto" id="navbarNav">
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown user user-menu">
                    <a href="#" class="dropdown-toggle padding-user nav-link">
                        <img src="{{asset('public/assets/images/authors/avatar1.jpg')}}" width="35" class="rounded-circle img-responsive pull-left"
                             height="35" alt="User Image">
                        <div class="riot">
                            <div>
                                @if(Session::has('username'))
                                    {{ Session::get('username') }}
                                @endif
                                
                                <span>
                                        <i class="fa fa-caret-down"></i>
                                    </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{asset('public/assets/images/authors/avatar1.jpg')}}" class="rounded-circle" alt="User Image">
                            <p> @if(Session::has('username'))
                                    {{ Session::get('username') }}
                                @endif
                                </p>
                        </li>
                        <li class="p-t-3 nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-fw fa-user"></i> My Profile
                            </a>
                        </li>
                        @if( Helper::showBasedOnPermission( ['user.read'],'OR' ) )

                            <li class="p-t-3 nav-item">
                                <a href="{{ url('user/list') }}" class="nav-link">
                                    <i class="fa fa-fw fa-users"></i> Manage User
                                </a>
                            </li>
                        @endif
                        <li ></li>
                      
                        <li  class="dropdown-divider"></li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="lockscreen.html">
                                    <i class="fa fa-fw fa-lock"></i>
                                    Lock
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('login.logout') }}">
                                    <i class="fa fa-fw fa-sign-out"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
