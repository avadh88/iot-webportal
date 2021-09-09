<!-- <aside class="left-side sidebar-offcanvas leftside-fixed"> -->
<aside class="left-side sidebar-offcanvas">
        <section class="sidebar affix">
            <div id="menu" class="menu_align" role="navigation">
                <ul class="navigation">
                    <li id="dashboard">
                        <a href="{{ url('dashboard') }}">
                            <i class="menu-icon fa fa-fw fa-home"></i>
                            <span class="mm-text ">Dashboard</span>
                        </a>
                    </li>    
                    <!-- @if( Helper::showBasedOnPermission( ['temporary.read'],'OR' ) )
                
                    <li>
                        <a href="{{ url('temporary/list') }}">
                            <i class="menu-icon fa fa-fw fa-home"></i>
                            <span class="mm-text ">Temp Device Data</span>
                        </a>
                    </li>
                    @endif
                
                    @if( Helper::showBasedOnPermission( ['role.read'],'OR' ) )
                    <li>
                        <a href="{{ url('roles/list') }}">
                            <i class="menu-icon fa fa-fw fa-home"></i>
                            <span class="mm-text ">Roles</span>
                        </a>
                    </li>
                    @endif

                    @if( Helper::showBasedOnPermission( ['permanent.read'],'OR' ) )
                    <li>
                        <a href="{{ url('permanent/list') }}">
                            <i class="menu-icon fa fa-fw fa-home"></i>
                            <span class="mm-text ">Permanent Devices</span>
                        </a>
                    </li>
                    @endif -->

                    @if( Helper::showBasedOnPermission( ['company.read'], 'OR' ) )
                    <li id="company">
                        <a href="{{ url('company/list') }}">
                            <i class="menu-icon fa fa-fw fa-home"></i>
                            <span class="mm-text ">Company</span>
                        </a>
                    </li>
                    @endif

                    <li class="menu-dropdown">
                        <a href="#">
                            <i class="menu-icon fa fa-check-square"></i>
                            <span>Devices</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if( Helper::showBasedOnPermission( ['temporary.read'],'OR' ) )
                            <li class="temporary">
                                <a href="{{ url('temporary/list') }}">
                                    <i class="fa fa-fw fa-fire"></i> Temporary Devices
                                </a>
                            </li>
                            @endif
                            
                            @if( Helper::showBasedOnPermission( ['permanent.read'],'OR' ) )
                            <li id="permanent">
                                <a href="{{ url('permanent/list') }}">
                                    <i class="fa fa-fw fa-file-text-o"></i> Permanent Devices
                                </a>
                            </li>
                            @endif
                
                        </ul>
                    </li>

                    <li class="menu-dropdown">
                        <a href="#">
                            <i class="menu-icon fa fa-check-square"></i>
                            <span>User Management</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if( Helper::showBasedOnPermission( ['user.read'],'OR' ) )
                            <li id="user">
                                <a href="{{ url('user/list') }}" class="nav-link">
                                    <i class="fa fa-fw fa-users"></i> Manage User
                                </a>
                            </li>
                            @endif
                            
                            @if( Helper::showBasedOnPermission( ['role.read'],'OR' ) )
                            <li id="role">
                                <a href="{{ url('roles/list') }}">
                                    <i class="fa fa-fw fa-file-text-o"></i> Roles
                                </a>
                            </li>
                            @endif
                
                        </ul>
                    </li>

                </ul>
            </div>
        </section>
</aside>