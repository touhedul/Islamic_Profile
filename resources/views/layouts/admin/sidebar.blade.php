<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"></li>
            {{--Show if it is super admin--}}
            @if(Auth::user()->role == "super admin")
                <li class="treeview">
                    <a href="#" id="admin">
                        <i class="fa fa-address-book"></i> <span>Admin</span>
                        <span class="pull-right-container">
            </span>
                    </a>

                </li>
            @endif
            @if(Auth::user()->role == "admin" || Auth::user()->role == "super admin")
                <li class="treeview">
                    <a href="#" id="moderator">
                        <i class="fa fa-magic"></i> <span>Moderator</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="#" id="user">
                        <i class="fa fa-university"></i> <span>User</span>
                        <span class="pull-right-container"></span>
                    </a>

                </li>
            @endif
            <li class="treeview">
                <a href="#" id="hadith">
                    <i class="fa fa-hacker-news"></i> <span>Hadith</span>
                    <span class="pull-right-container">
            </span>
                </a>

            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-question"></i> <span>Question Answer</span>
                    <span class="pull-right-container">
            </span>
                </a>

            </li>

            <li class="treeview">
                <a href="#" id="change-password">
                    <i class="fa fa-product-hunt"></i> <span>Change Password</span>
                    <span class="pull-right-container">
            </span>
                </a>

            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>