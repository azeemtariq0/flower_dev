



<aside id="aside">
                <!--
                    Always open:
                    <li class="active alays-open">

                    LABELS:
                        <span class="label label-danger pull-right">1</span>
                        <span class="label label-default pull-right">1</span>
                        <span class="label label-warning pull-right">1</span>
                        <span class="label label-success pull-right">1</span>
                        <span class="label label-info pull-right">1</span>
                    -->
                    <nav id="sideNav"><!-- MAIN MENU -->
                        <ul class="nav nav-list">
                            <li class="{{ in_array(\Request::segment(1),array('home')) ? 'active' : '' }}"><!-- dashboard -->
                                <a class="dashboard" href="{{ url('admin/home') }}"><!-- warning - url used by default by ajax (if eneabled) -->
                                    <i class="main-icon fa fa-dashboard"></i> <span>Dashboard



                                    </span>
                                </a>
                            </li>
                           
                            @can('permission-list')
                            <li class="{{ in_array(\Request::segment(1),array('users', 'roles', 'permissions')) ? 'active' : '' }}">
                                <a href="#">
                                    <i class="fa fa-menu-arrow pull-right"></i>
                                    <i class="main-icon fa fa-users"></i> <span>Permissions</span>
                                </a>
                                <ul><!-- submenus -->
                                    <li class="{{ \Request::segment(1) == 'permissions' ? 'active' : '' }}"><a href="{{ route('permissions.index') }}">Manage Permission</a></li>
                                    <li class="{{ \Request::segment(1) == 'roles' ? 'active' : '' }}"><a href="{{ route('roles.index') }}">Manage Role</a></li>
                                    <li class="{{ \Request::segment(1) == 'users' ? 'active' : '' }}"><a href="{{ route('users.index') }}">Manage Users</a></li>
                                </ul>
                            </li>
                            @endcan
                           
                             <li class="{{ in_array(\Request::segment(2),array(
                             'colors',
                             'products',
                              'product-sub-categories',
                              'product-categories',
                              )) ? 'active' : '' }}">
                                <a href="#">
                                    <i class="fa fa-menu-arrow pull-right"></i>
                                    <i class="main-icon fa fa-cogs"></i> <span>General Setup</span>
                                </a>
                                <ul><!-- submenus -->
                                   
                           
                                      <li class="{{ \Request::segment(2) == 'colors' ? 'active' : '' }}">
                                        <a href="{{ route('colors.index') }}">Color</a></li>

                                      <li class="{{ \Request::segment(2) == 'product-categories' ? 'active' : '' }}">
                                        <a href="{{ route('product-categories.index') }}">Product Category</a></li>


                                        <li class="{{ \Request::segment(2) == 'product-sub-categories' ? 'active' : '' }}">
                                        <a href="{{ route('product-sub-categories.index') }}">Product Sub  Category</a></li>

                                      <!-- <li class="#"><a href="#">Product Categories</a></li> -->
                                     
                                  <li class="{{ \Request::segment(2) == 'products' ? 'active' : '' }}">
                                        <a href="{{ route('products.index') }}">Product</a></li>
                                </ul>
                            </li>




                            <li class="{{ in_array(\Request::segment(2),array(
                             'orders',
                             'order-confirm',
                             'order-dispatch',
                             'order-delivered',
                              )) ? 'active' : '' }}">
                                <a href="#">
                                    <i class="fa fa-menu-arrow pull-right"></i>
                                    <i class="main-icon fa fa-cogs"></i> <span>Order Management</span>
                                </a>
                                <ul><!-- submenus -->
                                   
                           
                                      
                                <li class="{{ \Request::segment(2) == 'orders' ? 'active' : '' }}">
                                        <a href="{{ url('admin/orders') }}">Receive</a></li>

                                <li class="{{ \Request::segment(2) == 'order-confirm' ? 'active' : '' }}">
                                        <a href="{{ url('admin/order-confirm') }}">Confirm</a></li>

                                        <li class="{{ \Request::segment(2) == 'order-dispatch' ? 'active' : '' }}">
                                        <a href="{{ url('admin/order-dispatch') }}">Dispatch</a></li>

                                <li class="{{ \Request::segment(2) == 'order-delivere' ? 'active' : '' }}">
                                        <a href="{{ url('admin/order-delivered') }}">Delivered</a></li>
                                   
                                     
                                  
                                </ul>
                            </li>

                  


                           
                             <li ><!-- dashboard -->
                                <a class="dashboard" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><!-- warning - url used by default by ajax (if eneabled) -->
                                    <i class="main-icon fa fa-power-off"></i> <span>Logout



                                    </span>
                                </a>
                            </li>
                        </ul>

                    </nav>

                    <span id="asidebg"><!-- aside fixed background --></span>
                </aside>