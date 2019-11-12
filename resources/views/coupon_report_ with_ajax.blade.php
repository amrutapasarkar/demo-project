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
            <div class="col-md-4">
              <input type="text" name="search_name" id="search_name" placeholder="search by name" class="form-control" />
            </div>
            <div class="col-md-2">
                <label>Search by date:</label>
            </div>
            <div class="col-md-6">
              <div class="input-group input-daterange">
                <input type="text" name="from_date" id="from_date"  class="form-control" />
                <div class="input-group-addon">to</div>
                <input type="text"  name="to_date" id="to_date"  class="form-control" />
                </div>
                <div style="margin-left:320px;"> <br>
                    <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
                    <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
                </div>
            </div>
          </div>
  				                  <table class="table">
                             <thead> <th>Customer</th>
                                     <th>Coupon title</th>
                                     <th>Discount</th>
                                     <th>Coupon type</th>

                             </thead>
                              <tbody class="records">
                              
                              </tbody>
                              </table>

                               	<div class="pagination" id="pagination_data">
                                <div class="pagination-wrapper"> 

                                </div>
                                </div>		           
  				        </form>
      			    </div>
  		        </div>
  	    		  		
  	       </div>  
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
   <script>
  $(document).ready(function(){

   var date = new Date();

   $('.input-daterange').datepicker({
    todayBtn: 'linked',
    format: 'yyyy-mm-dd',
    autoclose: true
   });

   var _token = $('input[name="_token"]').val();

   fetch_data();

   function fetch_data(from_date = '', to_date = '', search_name='')
   {
    $.ajax({
     url:"{{ route('daterange.fetch_coupons_data') }}",
     method:"POST",
     data:{from_date:from_date, to_date:to_date, search_name:search_name, _token:_token},
     dataType:"json",
     success:function(data)
     { var data1= data;
      var output = '';
      $('#total_records').text(data.length);
      if(data.length==0){
        $('.records').html("<br><h3>No records found</h3>");
      }else{
      for(var count = 0; count < data.length; count++)
      {
       output += '<tr>';
       output += '<td>' + data[count].first_name + '</td>';
       output += '<td>' + data[count].title + '</td>';
       output += '<td>' + data[count].discount+ '</td>';
       output += '<td>' + data[count].type+ '</td></tr>';

      }
      $('.records').html(output);
    }
     }
    });

  }
  $('#filter').click(function(){
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var search_name = $('#search_name').val();
    if((from_date != '' &&  to_date != '' )||(search_name != ''))
    {
     fetch_data(from_date,to_date,search_name);
    }
    
  });


  $('#refresh').click(function(){
    $('#from_date').val('');
    $('#to_date').val('');
    $('#search_name').val('');
    fetch_data();
   
  });


  });
  </script>
  @endsection
