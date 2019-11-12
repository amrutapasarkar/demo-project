  @extends('master')

  @section('content')

  <div class="form-group row">
  <div class="col-sm-2"></div>
  <div class="col-sm-10">
    <div class="pull-left">
      <h2>Edit Product </h2>
    </div>

    <br>
    <div class="pull-right">
      <a href="{{ url('/admin/product') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
    </div>
    <br />
    <br />

    @if ($errors->any())
    <ul class="alert alert-danger">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
    @endif

    <form method="POST" action="{{ url('/admin/product/' . $product->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
      {{ method_field('PATCH') }}
      {{ csrf_field() }}
      <br>
      @include ('admin.product.form', ['formMode' => 'edit'])

    </form>

  </div>
  </div>

  @endsection
  @section('scripts')
  <script type="text/javascript">
  $(document).ready(function() {
    $('select[name="category"]').on('change', function() {
      var category = $(this).val();
      if(category) {
        $.ajax({
          url: '/category-dropdown/'+category,
          type: "GET",
          dataType: "json",
          success:function(data) {

            $('select[name="subcategory"]').empty();
            $.each(data, function(key, value) {
              $('select[name="subcategory"]').append('<option value="'+ value.id +'">'+ value.category +'</option>');
            });
          }
        });
      }else{
        $('select[name="subcategory"]').empty();
      }
    });
  });
  </script>
  @endsection