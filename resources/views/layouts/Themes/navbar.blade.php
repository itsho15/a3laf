<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        <div class="user-profile">
            <div class="user-pro-body">
                <div><img src="{{ url('design/adminlte') }}/assets/images/users/2.jpg" alt="user-img" class="img-circle"></div>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ auth(activeGuard())->user()->name }} <span class="caret"></span></a>
                    <div class="dropdown-menu animated flipInY">

                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a class="dropdown-item" href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-lock"></i>Logout
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <!-- text-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar navigation-->
       @include('layouts.Themes.sidebar')
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>


<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->