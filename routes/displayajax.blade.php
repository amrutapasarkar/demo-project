<!DOCTYPE html>
<html>
<head>
	<title>Insert data in MySQL database using Ajax</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div style="margin: auto;width: 60%;">
	<h4>Product list </h4>
	
		
		<input type="button" name="save" class="btn btn-primary" value="Save to database" id="butsave">
	
</div>

<!--wrapper-starts-->




<script type="text/javascript">
$(document).ready(function(){
 

	$('#butsave').click(function(){
	  var Productname = $('#Productname').val();
	  var Productprice = $('#Productprice').val();

	if( Productname != '' &&  Productprice != '' )
	{		  
  	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
    });

    $.ajax({
     url:'{{url("/savetodb")}}',
     method:'POST',
     data:{'Productname':Productname,'Productprice':Productprice,'_token':'{{ csrf_token() }}'},
     
     success:function(result){ 	
			$("#success").show();
			$('#success').html('Data added successfully !');			
     }

	// } 
	  
	 });
}

});
});
</script>
</body>
</html>
