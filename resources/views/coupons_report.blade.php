
@extends('master')
@section('title', 'Sales Report')
@section('content')

<div class="container">
  <div class="row">

    <div class="col-md-2"></div>
    <div class="col-md-10">


     <h2 class="title text-center">Coupons report</h2>

     <form name="salesreport" method="get">
       {{ csrf_field() }}


       <div class="row">
        <form method="get" action="" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
          <div class="col-md-3">
            <input type="text" class="form-control" name="name" placeholder="Search..." value="{{ request('search') }}" style="margin-left: -42px;">
          </div>
          <div class="col-md-2">
            <label>Search by date:</label> 
          </div>
          <div class="col-md-3">
            <input type="date" class="form-control" name="from_date" value="{{ request('search') }}">
          </div>
          <div class="col-md-3">
            <input type="date" class="form-control" name="to_date"  >
          </div>
          <div class="col-md-1">
            <span class="input-group-append">
              <button class="btn btn-secondary" type="submit" formaction="{{route('daterange.fetch_coupons_data')}}"><i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>   
      </div>
      <br>

      <table class="table">

        <thead> <th>Customer</th>
         <th>Coupon title</th>
         <th>Discount</th>
         <th>Coupon type</th>

       </thead>

       <tbody class="records">
        @foreach($coupons as $coupon)
        <tr>
          <td>{{$coupon->first_name}} {{$coupon->last_name}}</td>
          <td>{{$coupon->title}} </td>
          <td>{{$coupon->discount}}</td>
          <td>{{$coupon->type}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="pagination" id="pagination_data">
      <div class="pagination-wrapper"> {!! $coupons->appends(['search' => Request::get('search')])->render() !!} </div>
    </div>		           
  </form>
</div>
</div>

</div>  

@endsection