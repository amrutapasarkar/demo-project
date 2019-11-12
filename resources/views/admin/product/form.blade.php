<form method="post" enctype="multipart/form-data">
<div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
    <label for="product_name" class="control-label">{{ 'Product Name' }}</label>
    <input class="form-control" name="product_name" type="text" id="product_name" value="{{ isset($product->product_name) ? $product->product_name : ''}}" >
    {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_img') ? 'has-error' : ''}}">
    <label for="product_img" class="control-label">{{ 'Product Image' }}</label>
    <input class="form-control" name="product_img" type="file" id="product_img" value="{{ isset($product->product_img) ? $product->product_img : ''}}" >
    {!! $errors->first('product_img', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_price') ? 'has-error' : ''}}">
    <label for="product_price" class="control-label">{{ 'Product Price' }}</label>
    <input class="form-control" name="product_price" type="number" id="product_price" value="{{ isset($product->product_price) ? $product->product_price : ''}}" >
    {!! $errors->first('product_price', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('color') ? 'has-error' : ''}}">
    <label for="color" class="control-label">{{ 'Product Color' }}</label>
    <div id="cp2" class="input-group colorpicker colorpicker-component"> 
    <input class="form-control" name="color" type="text" id="color" value="{{ isset($product->product_Attributes->color) ? $product->product_Attributes->color : ''}}">
    <span class="input-group-addon"><i></i></span> </div>
    {!! $errors->first('color', '<p class="help-block">:message</p>') !!}

</div>
<div class="form-group {{ $errors->has('product_price') ? 'has-error' : ''}}">
    <label for="quantity" class="control-label">{{ 'Product Quanity' }}</label>
    <input class="form-control" name="quantity" type="number" id="quantity" value="{{ isset($product->product_Attributes->quantity) ?  $product->product_Attributes->quantity: ''}}" >
    {!! $errors->first('product_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('product_price') ? 'has-error' : ''}}">
    <label for="product_description" class="control-label">{{ 'Product Description' }}</label>
    <input class="form-control" name="product_description" type="text" id="quantity" value="{{ isset($product->product_description) ?  $product->product_description: ''}}">
    {!! $errors->first('product_description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    <label for="category" class="control-label">{{ 'Category' }}</label>
    <select name="category" class="form-control" id="category" >
    @if( isset( $product->product_description))
        @foreach($categories as $category)
          @foreach($allCategories as $categories) 
           @if($category->parent_id == $categories->id)
           <option value="{{$categories->id}}" selected>{{ $categories->category}}</option>
           @else
           <option value="{{$categories->id}}" >{{ $categories->category}}</option>
           @endif   
          @endforeach
        @endforeach
    @else
    @foreach($allCategories as $categories) 
    <option value="{{$categories->id}}" >{{ $categories->category}}</option>
    @endforeach
    @endif
    </select>
</div>
    {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    <label for="subcategory" class="control-label">{{ 'Sub Category' }}</label>
    <select name="subcategory" class="form-control" id="subcategory" >
    @if( isset( $product->product_description))
      @foreach($subCategory as $category) 
      @if($product->category->category_id == $category->id)
      <option value="{{$category->id}}" >{{ $category->category}}</option>
      @endif
      @endforeach
    @endif
        
   
    </select>
</div>
<div class="form-group">
<input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</form>