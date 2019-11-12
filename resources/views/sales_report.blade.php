
  @extends('master')
  @section('title', 'Sales Report')
  @section('content')

    	<div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
      				<h2 class="title text-center">Sales report</h2>
      				
  			    	      <form method="get" action="" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="col-md-3">
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
                        <button class="btn btn-secondary" type="submit" formaction="{{route('daterange.fetch_data')}}"><i class="fa fa-search"></i>
                        </button>
                        </span>
                        </div>
                    </form>
  			            <table class="table">
                      <thead> 
                        <th>Product</th>
                        <th>Total Quantity</th>
                        <th>Unit Price</th>
                      </thead>
                      <tbody class="records">
                      @foreach($order as $orders)
                      <tr>

                      <td>{{$orders->product_name}} </td>
                      <td>{{$orders->product_qty}} </td>
                      <td>{{$orders->product_price}}</td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>

                 	<div class="pagination" id="pagination_data">
                    {!! $order->appends(['search' => Request::get('search')])->render() !!}
                  </div>		           
  			       
    			    </div>
  	        </div>
      		  		
         </div>  
            

  @endsection
