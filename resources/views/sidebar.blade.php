    @section('sidebar')
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset('dist/img/user2.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{Auth::user()->first_name}}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                    <!-- <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button> -->
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="{{ url('/dashboard') }}">
                <i class="fa fa-dashboard"></i> Dashboard
                
              </a>
             </li>
              @can('user-list')
              <li><a href="{{url('users')}}"><i class="fa fa-circle-o"></i>Manage user</a></li>
              @endcan
              @can('role-list')
              <li><a href="{{url('roles')}}"><i class="fa fa-circle-o"></i>Manage roles</a></li>
              @endcan
              @can('config-list')
              <li><a href="{{url('admin/configurations')}}"><i class="fa fa-circle-o"></i>Manage configuration</a></li>
              @endcan
              @can('banner-list')
              <li><a href="{{url('admin/banners')}}"><i class="fa fa-circle-o"></i>Manage Banners</a></li>
              @endcan
               @can('category-list')
              <li><a href="{{url('admin/category')}}"><i class="fa fa-circle-o"></i>Manage category</a></li>
              @endcan
              @can('product-list')
              <li><a href="{{url('admin/product')}}"><i class="fa fa-circle-o"></i>Manage Product</a></li>
              @endcan
              @can('coupon-list')
              <li><a href="{{url('admin/coupon')}}"><i class="fa fa-circle-o"></i>Manage coupon</a></li>
              @endcan
              @if(Auth::user()->hasRole('admin'))
              <li><a href="{{url('admin/contact-us')}}"><i class="fa fa-circle-o"></i>Manage User Contacts</a></li>
              @endif
              @if(Auth::user()->hasRole('admin'))
              <li><a href="{{url('/indextemplate')}}"><i class="fa fa-circle-o"></i>Manage Mail Template</a></li>
              @endif
              @if(Auth::user()->hasRole('admin'))
              <li><a href="{{url('/indexorder')}}"><i class="fa fa-circle-o"></i>Order Management</a></li>
              @endif
              @if(Auth::user()->hasRole('admin'))
              <li><a href="{{url('/cms_index')}}"><i class="fa fa-circle-o"></i>CMS</a></li>
              @endif
              
          
            @if(Auth::user()->hasRole('admin'))
            <li class="treeview">
              <a href="#">

               <span>Reports</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('/SalesReport')}}"><i class="fa fa-circle-o"></i>Sales Report</a></li>
                <li><a href="{{url('/CustomerReport')}}"><i class="fa fa-circle-o"></i>Customer Registered</a></li>
                <li><a href="{{url('/CouponReport')}}"><i class="fa fa-circle-o"></i>Coupons Report</a></li>
              </ul>
            </li>
            @endif
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>



    @endsection