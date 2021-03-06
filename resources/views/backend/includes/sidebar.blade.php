<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/user_icon.png" class="img-circle" alt="User Image" />
            </div><!--pull-left-->
            <div class="pull-left info">
                <p>{{ access()->user()->full_name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div><!--pull-left-->
        </div><!--user-panel-->

        <!-- search form (Optional) -->
        {{ Form::open(['route' => 'admin.search.index', 'method' => 'get', 'class' => 'sidebar-form']) }}
        <div class="input-group">
            {{ Form::text('q', Request::get('q'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('strings.backend.general.search_placeholder')]) }}

            <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span><!--input-group-btn-->
        </div><!--input-group-->
    {{ Form::close() }}
    <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <li class="{{ active_class(Active::checkUriPattern('admin/dashboard')) }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.sidebar.dashboard') }}</span>
                </a>
            </li>

            <li class="header">{{ trans('menus.backend.sidebar.system') }}</li>

            @role(1)
            <li class="{{ active_class(Active::checkUriPattern('admin/access/*')) }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>{{ trans('menus.backend.access.title') }}</span>

                    @if ($pending_approval > 0)
                        <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                    @else
                        <i class="fa fa-angle-left pull-right"></i>
                    @endif
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/access/*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/access/*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/access/user*')) }}">
                        <a href="{{ route('admin.access.user.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.users.management') }}</span>

                            @if ($pending_approval > 0)
                                <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/access/role*')) }}">
                        <a href="{{ route('admin.access.role.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.roles.management') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            
             <li class="{{ active_class(Active::checkUriPattern('admin/customer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.customer.title') }}</span>

                    @if ($pending_approval > 0)
                        <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                    @else
                        <i class="fa fa-angle-left pull-right"></i>
                    @endif
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/customer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/customer*'), 'display: block;') }}">
                  @if(request()->route()->uri !== 'admin/customer/create')
                    <li class="{{ active_class(Active::checkUriPattern('admin/customer*')) }}">
                       @else 
                       <li>
                       @endif
                        <a href="{{ route('admin.customer.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.customer.list') }}</span>

                            @if ($pending_approval > 0)
                                <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                            @endif
                        </a>
                    </li>
                  
                    <li class="{{ active_class(Active::checkUriPattern('admin/customer/create*')) }}">
                        <a href="{{ route('admin.customer.create') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.customer.create') }}</span>
                        </a>
                    </li>
                     
                </ul>
            </li>
            
             <li class="{{ active_class(Active::checkUriPattern('admin/product*')) }} treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.product.title') }}</span>

                    @if ($pending_approval > 0)
                        <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                    @else
                        <i class="fa fa-angle-left pull-right"></i>
                    @endif
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/product*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/product*'), 'display: block;') }}">
                  @if(request()->route()->uri !== 'admin/product/create')
                    <li class="{{ active_class(Active::checkUriPattern('admin/product*')) }}">
                       @else 
                       <li>
                       @endif
                        <a href="{{ route('admin.product.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.product.list') }}</span>

                            @if ($pending_approval > 0)
                                <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                            @endif
                        </a>
                    </li>
                  
                    <li class="{{ active_class(Active::checkUriPattern('admin/product/create*')) }}">
                        <a href="{{ route('admin.product.create') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.product.create') }}</span>
                        </a>
                    </li>
                     
                </ul>
            </li>
            
             <li class="{{ active_class(Active::checkUriPattern('admin/order*')) }} treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.order.title') }}</span>

                    @if ($pending_approval > 0)
                        <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                    @else
                        <i class="fa fa-angle-left pull-right"></i>
                    @endif
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/order*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/order*'), 'display: block;') }}">
                  @if(request()->route()->uri !== 'admin/order/create')
                    <li class="{{ active_class(Active::checkUriPattern('admin/order*')) }}">
                       @else 
                       <li>
                       @endif
                        <a href="{{ route('admin.order.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.order.list') }}</span>

                            @if ($pending_approval > 0)
                                <span class="label label-danger pull-right">{{ $pending_approval }}</span>
                            @endif
                        </a>
                    </li>
                  
                    <li class="{{ active_class(Active::checkUriPattern('admin/order/create*')) }}">
                        <a href="{{ route('admin.order.create') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.order.create') }}</span>
                        </a>
                    </li>
                     
                </ul>
            </li>
            
         @endauth
           
           

            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('log-viewer::dashboard') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.dashboard') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('log-viewer::logs.list') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.logs') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>