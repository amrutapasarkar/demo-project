@section('sidebar')
<div class="sidebar">
  <a class="active" href="{{route('showAccountForm')}}"><i class="fa fa-user"></i> My Account</a>
  <a href="{{route('showOrdersForm')}}"><i class="fa fa-address-card"></i> My Orders</a>
  <a href="{{url('TrackOrders')}}"><i class="fa fa fa-train"></i> Track Order</a>
  <a href="{{url('/address')}}"><i class="fa fa-address-book"></i> My Address</a>
</div>
@endsection
      

