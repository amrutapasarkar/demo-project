<!DOCTYPE html>
<html>
<head>
	<title>Insert data in MySQL database using Ajax</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<form id="upload-form" method="post" enctype="multipart/form-data">
{{csrf_field()}}
<div style="margin: auto;width: 60%;">
	<h4>Create new product </h4>
	<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	 
	</div>
	<div class="form-group">
		<label for="Product">Product Name</label>
		<input type="text" class="form-control" id="Productname" placeholder="Product Name" name="Productname">
	</div>
	<div class="form-group">
		<label for="Price">Product Price</label>
		<input type="text" class="form-control" id="Productprice" placeholder="Product Price" name="Productprice">
	</div>
	<div class="form-group">
		<label for="Image">Product Image</label>
		<input type="file" class="form-control" id="Productimage" placeholder="Product Image" name="Productimage">
	</div>
	
	<input type="submit" name="save" class="btn btn-primary" value="Save to database" id="butsave">
	
</div>
</form>
<!--wrapper-starts-->




<script type="text/javascript">
$(document).ready(function(){
 
	$('#upload-form').on('submit',function(event){
		event.preventDefault();
		$.ajaxSetup({
			headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`). attr("content")}
		});
		$.ajax({
     		url:'{{url("/savetodb")}}',
     		method:'POST',	
     		data: new FormData(this),
     		dataType: 'Json',
     		contentType: false,
     		cache:false,
     		processData: false,
     		success:function(data){
			 	
     		}
     	});
	});	
});
</script>
</body>
</html>
