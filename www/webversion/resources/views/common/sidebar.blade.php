<!-- <aside class="left-side sidebar-offcanvas leftside-fixed"> -->
<aside class="left-side sidebar-offcanvas">
        <section class="sidebar affix">
            <div id="menu" class="menu_align" role="navigation">
                <ul class="navigation">
                    
                    <li id="dashboard" class="active">
                        <a href="{{ url('dashboard') }}">
                            <!-- <i class="menu-icon fa fa-fw fa-home"></i> -->
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                            <span class="mm-text ">Dashboard</span>
                        </a>
                    </li>    
                
                    @if( Helper::showBasedOnPermission( ['company.read'], 'OR' ) )
                    <li id="company">
                        <a href="{{ url('company/list') }}">
                        <i class="fa fa-building-o" aria-hidden="true"></i>
                            <span class="mm-text ">Company</span>
                        </a>
                    </li>
                    @endif

                    <li class="menu-dropdown">
                        <a href="#">
                        <i class="fa fa-fw fa-chevron-circle-down"></i>
                            <span>Devices</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if( Helper::showBasedOnPermission( ['temporary.read'],'OR' ) )
                            <li class="temporary">
                                <a href="{{ url('temporary/list') }}">
                                <i class="fa fa-tablet" aria-hidden="true"></i> Temporary Devices
                                </a>
                            </li>
                            @endif
                            
                            @if( Helper::showBasedOnPermission( ['permanent.read'],'OR' ) )
                            <li id="permanent">
                                <a href="{{ url('permanent/list') }}">
                                <i class="fa fa-tablet" aria-hidden="true"></i> Permanent Devices
                                </a>
                            </li>
                            @endif
                
                        </ul>
                    </li>

                    <li class="menu-dropdown">
                        <a href="#">
                        <i class="fa fa-fw fa-chevron-circle-down"></i>
                            <span>User Management</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @if( Helper::showBasedOnPermission( ['user.read'],'OR' ) )
                            <li id="user">
                                <a href="{{ url('user/list') }}" class="nav-link">
                                    <i class="fa fa-fw fa-users"></i> Manage Users
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