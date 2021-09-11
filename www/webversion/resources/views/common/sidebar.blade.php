<!-- <aside class="left-side sidebar-offcanvas leftside-fixed"> -->
<aside class="left-side sidebar-offcanvas">
        <section class="sidebar affix">
            <div id="menu" class="menu_align" role="navigation">
                <ul class="navigation">
                    <li>
                        <a href="{{ url('dashboard') }}">
                            <i class="menu-icon fa fa-fw fa-home"></i>
                            <span class="mm-text ">Dashboard</span>
                        </a>
                    </li>    
                    @if( Helper::showBasedOnPermission( 'temporary.read' ) )
                
                    <li>
                        <a href="{{ url('temporary/list') }}">
                            <i class="menu-icon fa fa-fw fa-home"></i>
                            <span class="mm-text ">Temp Device Data</span>
                        </a>
                    </li>
                    @endif
                
                    @if( Helper::showBasedOnPermission( 'role.read' ) )
                    <li>
                        <a href="{{ url('roles/list') }}">
                            <i class="menu-icon fa fa-fw fa-home"></i>
                            <span class="mm-text ">Roles</span>
                        </a>
                    </li>
                    @endif

                    @if( Helper::showBasedOnPermission( 'permanent.read' ) )
                    <li>
                        <a href="{{ url('permanent/list') }}">
                            <i class="menu-icon fa fa-fw fa-home"></i>
                            <span class="mm-text ">Permanent Devices</span>
                        </a>
                    </li>
                    @endif

                </ul>
            </div>
        </section>
</aside>