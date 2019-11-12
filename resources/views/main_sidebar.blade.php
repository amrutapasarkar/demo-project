@section('sidebar')
  <aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('dist/img/User2.jpg')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
          <p>
                @if (!Auth::guest()) {{Auth::user()->first_name}} @endif
          </p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
      </div>
    </form>
    <!-- /.search form -->    
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">HEADER</li>
      <!-- Optionally, you can add icons to the links -->
      @can('user-list')
        
        <li><a href="{{url('users')}}"><i class="fa fa-link"></i><span>Manage user</span></a>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        </li>
      @endcan
      @can('role-list')
        <li class="treeview">
        <li><a href="{{url('roles')}}"><i class="fa fa-link"></i><span>Manage roles</span></a>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        </li>
      @endcan
      @can('config-list')
        <li class="treeview">
        <li><a href="{{url('admin/configurations')}}"><i class="fa fa-link"></i><span>Manage Configuration</span></a>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        </li>
      @endcan
      @can('banner-list')
        <li class="treeview">
        <li><a href="{{url('admin/banners')}}"><i class="fa fa-link"></i><span>Manage Banners</span></a>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        </li>
      @endcan
      @can('category-list')
        <li class="treeview">
        <li><a href="{{url('admin/category')}}"><i class="fa fa-link"></i><span>Manage category</span></a>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        
        </li>
      @endcan
      @can('product-list')
        <li class="treeview">
        <li><a href="{{url('admin/product')}}"><i class="fa fa-link"></i><span>Manage Product</span></a>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        
        </li>
     
      @endcan
      @can('coupon-list')
        
        <li class="treeview">
        <li><a href="{{url('admin/coupon')}}"><i class="fa fa-link"></i><span>Manage coupon</span></a>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        
        </li>
      @endcan
      @if (!Auth::guest())  
      @if(Auth::user()->hasRole('admin'))         
        <li class="treeview">
         <li><a href="{{url('admin/contact-us')}}"><i class="fa fa-link"></i><span>Manage User Contacts</span></a>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        
        </li>
      @endif
      @endif
      @if (!Auth::guest()) 
      @if(Auth::user()->hasRole('admin'))         
        <li class="treeview">
         <li><a href="{{url('/indextemplate')}}"><i class="fa fa-link"></i><span>Manage Mail Template</span></a>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        
        </li>
      @endif
      @endif

      @if (!Auth::guest()) 
      @if(Auth::user()->hasRole('admin'))         
      <li class="treeview">
         <li><a href="{{url('/indexorder')}}"><i class="fa fa-link"></i><span>Order Management</span></a>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        
      </li>
      @endif
      @endif
    @if (!Auth::guest()) 
    @if(Auth::user()->hasRole('admin'))         
      <li class="treeview">
         <li><a href="{{url('/CMSindex')}}"><i class="fa fa-link"></i><span>CMS</span></a>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        
      </li>
      @endif
      @endif
      @if (!Auth::guest()) 
      @if(Auth::user()->hasRole('admin'))         
      <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Reports</span>
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
      @endif

    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>


@endsection